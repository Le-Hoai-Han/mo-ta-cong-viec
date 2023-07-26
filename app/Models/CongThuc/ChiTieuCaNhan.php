<?php

namespace App\Models\CongThuc;

use App\Models\DanhMucThangNam;
use App\Models\DonHang\DonHang;
use App\Models\User;
use App\Traits\CongThucTuongUngTrait;
use App\Traits\CoNguoiTao;
use App\Traits\CoThangNam;
use App\Traits\ThuocNhanVien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChiTieuCaNhan extends Model
{
    use HasFactory;
    use ThuocNhanVien;
    use CoThangNam;
    use CoNguoiTao;
    use CongThucTuongUngTrait;
    
    CONST CHI_TIEU_DOANH_SO = [7,28,21,34];
    CONST CHI_TIEU_SO_DON_HANG = [12];
    CONST CHI_TIEU_TRAINING = [5,27,20,33];
    CONST CHI_TIEU_REORDER = [11];

    protected $table = 'cms___chi_tieu_ca_nhan';

    protected $fillable = [
        'id_thang_nam',
        'id_nhan_vien',
        'id_chi_tieu',
        'id_nguoi_tao',
        'muc_tieu',
        'ket_qua_dat_duoc',
        'ti_le_dat_duoc'
    ];

    public function chiTieu(){
        return $this->belongsTo(DanhSachChiTieu::class,'id_chi_tieu','id');
    }
    //loi
    // public function thangNam()
    // {
    //     return $this->hasMany(DanhMucThangNam::class,'id','id_thang_nam');
    // }

    protected static function booted() {
        static::creating(function ($chiTieuCaNhan) { 
            $chiTieuCaNhan->id_nguoi_tao = auth()->user()->id;

            if($chiTieuCaNhan->ket_qua_dat_duoc == "") {
                $chiTieuCaNhan->ket_qua_dat_duoc = 0;
            }

            $chiTieuCaNhan->capNhatTiLeDatDuoc();
            $chiTieuCaNhan->capNhatCongThucCongDon();

        });
        static::updating(function($chiTieuCaNhan) {
            if($chiTieuCaNhan->isDirty('ket_qua_dat_duoc')) {
                $chiTieuCaNhan->capNhatTiLeDatDuoc();
                
            }
            $chiTieuCaNhan->capNhatCongThucCongDon();
            
        });
    }

    /**
     * tinh % của mỗi bật cho tỉ lệ giảm dần
     * bắt đầu từ 100% ở 0 về 0% ở mức giới hạn
     */
    public function tinhPhanTramMoiBacGiam() : float
    {
        $mucTieu = $this->muc_tieu;
        if($mucTieu == 0) {
            $mucTieu = 1;
        }
        return (100/$this->muc_tieu)/100;
    }

    /**
     * ket qua dat duoc cua ti le giam dan
     */
    private function _tinhTiLeChieuHuongGiam() : float
    {
        if($this->ket_qua_dat_duoc <= $this->tinhPhanTramMoiBacGiam()){
            return 100;
        }else{
            return 0;
        }
        // return max(1-($this->tinhPhanTramMoiBacGiam()*$this->ket_qua_dat_duoc),0)*100;
    }


    /**
     * tinh ti le tang dan, toi da 100%
     */
    private function _tinhTiLeChieuHuongTang() : float 
    {
        if($this->muc_tieu == 0) 
            return 0;
        return min((double) ($this->ket_qua_dat_duoc/$this->muc_tieu),1)*100;
    }

    /**
     * tinh ti le dat duoc, toi da 100%
     */
    private function _tinhTileDatDuoc() : float
    {
        $chiTieu = $this->chiTieu;
        if($chiTieu->chieu_huong_tot == $chiTieu::CHIEU_HUONG_TOT_TANG) {                
            return $this->_tinhTiLeChieuHuongTang();
        }

        return $this->_tinhTiLeChieuHuongGiam();        
    }

    /**
     * cap nhat ti le dat duoc
     */
    public function capNhatTiLeDatDuoc() : void
    {
        $this->ti_le_dat_duoc = $this->_tinhTiLeDatDuoc();
    }
   
    

    /**
     * tinh ket qua cong don theo thang
     */
    private function _tinhKetQuaCongDon(array $dsThang) : float
    {
        return self::where([
            ['id_nhan_vien','=',$this->id_nhan_vien],
            ['id_chi_tieu','=',$this->id_chi_tieu],
            ['id_thang_nam','<>',$this->id_thang_nam]
        ])
        ->whereIn('id_thang_nam',$dsThang)
        ->sum('ket_qua_dat_duoc')+$this->ket_qua_dat_duoc;
    }
    
    /**
     * tinh ket qua cong don theo thang
     */
    private function _tinhMucTieuCongDon(array $dsThang) : float
    {
        return self::where([
            ['id_nhan_vien','=',$this->id_nhan_vien],
            ['id_chi_tieu','=',$this->id_chi_tieu],
            ['id_thang_nam','<>',$this->id_thang_nam]
        ])
        ->whereIn('id_thang_nam',$dsThang)
        ->sum('muc_tieu')+$this->muc_tieu;
    }

    /**
     * tinh ket qua dat duoc trong thang
     */
    public function _tinhTiLeCongDon() : float
    {   
        $chiTieu = $this->chiTieu;
        if($chiTieu->chieu_huong_tot == $chiTieu::CHIEU_HUONG_TOT_TANG) {   
            if($this->muc_tieu_cong_don == 0) 
                return 0;
            return min(($this->ket_qua_cong_don/$this->muc_tieu_cong_don),1)*100;
        } else if($this->muc_tieu_cong_don >= $this->ket_qua_cong_don) {
            return 100;
        } else {
            return 0;
        }

        
    }

    /**
     * cap nhat cac thong so cong don
     * 
     */
    
    public function capNhatCongThucCongDon() : void 
    {
        $dsThangDenHienTai = DanhMucThangNam::dsIDThangCungNamDen($this->id_thang_nam);
        $this->muc_tieu_cong_don = $this->_tinhMucTieuCongDon($dsThangDenHienTai);
        $this->ket_qua_cong_don = $this->_tinhKetQuaCongDon($dsThangDenHienTai);
        $this->ti_le_cong_don = $this->_tinhTiLeCongDon();
        // dump($this->muc_tieu_cong_don);
        // dump($this->ket_qua_cong_don);
        // dd($this->ti_le_cong_don);
        // dd($this);
    }

    public function getTyTrongToiDaAttribute() {
        if($this->chiTieu->congThucThuocNhomHienTai()->first())
            return $this->chiTieu->congThucThuocNhomHienTai()->first()->mo_ta;
            else {
                return "Không có công thức thuộc nhóm chỉ tiêu;";
            }
    }

    /**
     * khong su dung
     * 
     */
    
    static public function getDoanhSoCongDonTheoThang($idThangNam,$idNhanVien,$idNhomNhanVien) : float 
    {
        $idChiTieuDoanhSo = DanhSachChiTieu::getIdChiTieuDoanhSoTheoNhom($idNhomNhanVien);
       
        
        $chiTieuCaNhan = self::select(['ket_qua_cong_don'])->where([
            ['id_thang_nam','=',$idThangNam],
            ['id_nhan_vien','=',$idNhanVien],
            ['id_chi_tieu','=',$idChiTieuDoanhSo],
        ])->first();

        if($chiTieuCaNhan == null) 
            return 0;
        return (float) $chiTieuCaNhan->ket_qua_cong_don;
    }
}
