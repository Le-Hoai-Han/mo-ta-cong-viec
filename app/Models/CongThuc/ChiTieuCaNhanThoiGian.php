<?php

namespace App\Models\CongThuc;

use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Traits\CongThucTuongUngTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTieuCaNhanThoiGian extends Model
{
    use HasFactory;

    protected $table = 'cms___chi_tieu_ca_nhan_thoi_gian';

    public $fillable = [
        'id_thuong_thoi_gian',
        'id_chi_tieu',
        'muc_tieu',
        'ket_qua',
        'ti_le_dat_duoc',
        'id_nguoi_cap_nhat'
    ];

    public function thuongThoiGian() : BelongsTo
    {
        return $this->belongsTo(ThuongKhoangThoiGian::class,'id_thuong_thoi_gian','id');
    }

    public function chiTieu() : BelongsTo
    {
        return $this->belongsTo(DanhSachChiTieu::class,'id_chi_tieu','id');
    }

    protected static function booted() {
        parent::booted();
        self::creating(function($chiTieu){
            $chiTieu->setTiLeDatDuoc();
        });
        self::updating(function($chiTieu) {
            $chiTieu->setTiLeDatDuoc();
        });

    }

    /**
     * set ti le dat duoc
     * chua save
     */
    public function setTiLeDatDuoc() : void 
    {
        if($this->chiTieu->chieu_huong_tot == DanhSachChiTieu::CHIEU_HUONG_TOT_TANG){
            $this->ti_le_dat_duoc = min($this->ket_qua/max($this->muc_tieu,1),1);
        } else {
            if($this->ket_qua > $this->muc_tieu) {
                $this->ti_le_dat_duoc = 0;
            } else {
                $this->ti_le_dat_duoc = 1;
            }
        }
        //cho thanh %
        $this->ti_le_dat_duoc = $this->ti_le_dat_duoc*100;
    }

   

    
    /**
     * cap nhat 1 chi tieu cong don
     */
    public function capNhatChiTieuCongDon($dsThangNamID,$idNhanVien) : void 
    {

        $this->muc_tieu = max(1,$this->_getMucTieuCongDonThoiGian($dsThangNamID,$idNhanVien,$this->id_chi_tieu));
        $this->ket_qua = $this->_getKetQuaCongDonThoiGian($dsThangNamID,$idNhanVien,$this->id_chi_tieu);
        
        // $this->ket_qua = 4;
        $this->save();
        // dd($this);
    }

    /**
     * mục tieu cong don thoi gian
     */
    private function _getMucTieuCongDonThoiGian($dsThangNamID,$idNhanVien,$idChiTieu) : float
    {
        $mucTieu = ChiTieuCaNhan::whereIn('id_thang_nam',$dsThangNamID)
            ->where('id_nhan_vien',$idNhanVien)
            ->where('id_chi_tieu',$idChiTieu)
            ->sum('muc_tieu');
            // ->get();
        return $mucTieu;
    }
    /**
     * ket qua cong don cua 1 loai chi tieu theo thoi gian
     */
    private function _getKetQuaCongDonThoiGian($dsThangNamID,$idNhanVien,$idChiTieu) : float 
    {
        
        $ketQua = ChiTieuCaNhan::whereIn('id_thang_nam',$dsThangNamID)
            ->where('id_nhan_vien',$idNhanVien)
            ->where('id_chi_tieu',$idChiTieu)
            ->sum('ket_qua_dat_duoc');
            // ->get();
        return $ketQua;
    }

    /**
     * tim cong thuc thuong tuong ung voi chi tieu nay theo thoi gian dang tinh
     */
    public function getCongThucTuongUng() : int
    {
        $congThucTuongUngChiTieu = $this->chiTieu->congThucThuocNhom($this->chiTieu->id_nhom_nhan_vien);
        
        if($congThucTuongUngChiTieu!=null) {
           
            return $congThucTuongUngChiTieu->first()->id;
        }
        return 0;
    }

    public function getTyTrongToiDaAttribute() {
        if($this->chiTieu->congThucThuocNhomHienTai()->first())
            return $this->chiTieu->congThucThuocNhomHienTai()->first()->mo_ta;
            else {
                return "Không có công thức thuộc nhóm chỉ tiêu;";
            }
    }

}
