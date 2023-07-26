<?php

namespace App\Models\Thuong;

use App\Models\CongThuc\ChiTieuCaNhanThoiGian;
use App\Models\CongThuc\CongThucThuongThoiGian;
use App\Models\CongThuc\DanhSachChiTieu;
use App\Models\DanhMucThangNam;
use App\Models\DonHang\DonHang;
use App\Models\DonHang\DonHangTinhThuong;
use App\Traits\ThuocNhanVien;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ThuongKhoangThoiGian extends Model
{
    use HasFactory;
    use ThuocNhanVien;

    CONST LOAI_THUONG_QUY = 1;
    CONST LOAI_THUONG_NAM = 2;

    protected $table = "cms___thuong_khoang_thoi_gian";

    protected $fillable = [
        'id_nhan_vien',
        'nam',
        'thang_bat_dau',
        'thang_ket_thuc',
        'tong_ngan_sach_thuong',
        'tong_tien_thuong_dat_duoc',
        'tong_tien_thuong_da_nhan',
        'ngay_khoa_phat_thuong',
        'loai',
        'tien_no_xau_phai_tru',
        'tong_tien_thuong_con_lai',
        'tong_no_xau_phai_tru'
        

    ];


    protected static function booted()
    {
        parent::boot();
        // static::creating(function ($thuongThoiGian) {
        //     $quy = $this->_thang
        // });

       static::deleting(function($thuongThoiGian) {
            
            if($thuongThoiGian->chiTieuCaNhanTheoThoiGian->isNotEmpty())
            {
                foreach($thuongThoiGian->chiTieuCaNhanTheoThoiGian as $chiTieuCaNhan) {
                    $chiTieuCaNhan->delete();
                }
            }
            if($thuongThoiGian->congThucThuongTheoThoiGian->isNotEmpty())
            {
                foreach($thuongThoiGian->congThucThuongTheoThoiGian as $congThuc) {
                    $congThuc->delete();
                }
            }

            if($thuongThoiGian->donHangThuongNams->isNotEmpty()) {
                $thuongThoiGian->donHangThuongNams()->detach();
            }
            
       });
    }
    


    public function chiTieuCaNhanTheoThoiGian() : HasMany
    {
        return $this->hasMany(ChiTieuCaNhanThoiGian::class,'id_thuong_thoi_gian','id');
    }

    public function congThucThuongTheoThoiGian() : HasMany
    {
        return $this->hasMany(CongThucThuongThoiGian::class,'id_thuong_thoi_gian','id');
    }

    /**
     * don hang duoc tinh thuong trong thang
     */
    public function donHangThuongNams() : BelongsToMany
    {
        return $this->belongsToMany(DonHang::class,'cms___don_hang_thuong_nam','id_thuong_thoi_gian','id_don_hang');
    }

    /**
     * lay no xau da tru 
     * chi dung cho thuong nam
     */
    public function noXauDaTru() : HasMany
    {
        return $this->hasMany(ChiTietNoXauDaTru::class,'id_thuong_thoi_gian','id');
    }

    /**
     * lay quy hien tai
     */
    public function getQuyAttribute() : string 
    {
        if($this->loai == self::LOAI_THUONG_NAM) {
            return "";
        }
        return $this->getQuyTheoThang($this->thang_ket_thuc);
    }
    
    public function getQuyTheoThang(int $thang) : int 
    {
        if($thang < 1 || $thang > 12) {
            return 0;
        }

        return ceil($thang/3);
    }


    /**
     * lay thong tin thang bat dau, ket thuc cua quy theo thang duoc tinh thuong
     */
    private function _thangBatDauKetThucQuy(int $thang) : array
    {
        if($thang < 1 || $thang > 12) {
            return [0,0];
        }

        $thangBatDau = (int) (3 * floor(($thang-1)/3) + 1);
        return [$thangBatDau,$thangBatDau+2];   
    }

    /**
     * lay thang bat dau ket thuc Quy
     */
    public function getThangBatDauKetThucQuy(int $thang) : array 
    {
        return $this->_thangBatDauKetThucQuy($thang);
    }

    /**
     * lay thong tin thang bat dau, ket thuc cua quy theo thang duoc tinh thuong
     */
    static public function thangBatDauKetThucThuocQuy(int $quy) : array
    {
        if($quy < 1 || $quy > 4) {
            return [0,0];
        }

        $thangBatDau = ($quy - 1)*3 + 1;
        return [$thangBatDau,$thangBatDau+2];   
    }

    


    /**
     * lay thong tin quy can tinh dua vao thang
     */
    public function getQuyCanTinh(int $thang,int $nam,int $idNhanVien) : ?ThuongKhoangThoiGian
    {
        $dsThang = $this->_thangBatDauKetThucQuy($thang);
        // dd([$thang,$nam,$idNhanVien]);
        return self::where([
            ['thang_bat_dau','=',$dsThang[0]],
            ['thang_ket_thuc','=',$dsThang[1]],
            ['nam','=',$nam],
            ['id_nhan_vien','=',$idNhanVien],
            ['loai','=',self::LOAI_THUONG_QUY]
        ])->first();
    }

    /**
     * lay chi tieu thuoc thuong theo thoi gian theo id chi tieu va thuong model
     */
    private function _layChiTieuThuocThuongTheoIDChiTieu(int $idChiTieu) : ?ChiTieuCaNhanThoiGian
    {
        $chiTieu = $this->chiTieuCaNhanTheoThoiGian()->where('id_chi_tieu',$idChiTieu)->first();
        return $chiTieu;
    }

    /**
     * lay muc tieu doanh so quy
     */
    private function _layMucTieuDoanhSoQuy(int $idChiTieu) : float
    {
        $chiTieuDoanhSoQuy = $this->_layChiTieuThuocThuongTheoIDChiTieu($idChiTieu);
        if($chiTieuDoanhSoQuy == null) {
            return 0;
        }
        
        return $chiTieuDoanhSoQuy->muc_tieu;

    }

    /**
     * lay thong tin doanh so quy
     */
    static public function getMucTieuDoanhSoQuy(int $idNhanVien,int $thang,int $nam,int $idNhomNhanVien) : float
    {

        $idChiTieuDoanhSo = DanhSachChiTieu::getIdChiTieuDoanhSoTheoNhom($idNhomNhanVien);
        $thuong = (new ThuongKhoangThoiGian())->getQuyCanTinh($thang,$nam,$idNhanVien);
        // dd([$idChiTieuDoanhSo,$thuong]);
        if($thuong==null || $idChiTieuDoanhSo==0) {
            return 0;
        }
        
        return $thuong->_layMucTieuDoanhSoQuy($idChiTieuDoanhSo);
    }
 
    /**
     * check xem thuong nay da khoa lai chua (da phat chua)
     */
    public function daKhoa() : bool 
    {
        if($this->ngay_khoa_phat_thuong==null)
            return false; 
        return true;
    }



    /**
     * ngan sach thuong quy bang tong ngan sach thuong 3 thang
     * cap nhat tong ngan sach thuong 
     * va tien thuong da nhan
     */
    public function thongTinTienThuongThoiGian() : array 
    {
        $dsThangTinhThuong = self::getDanhSachThangTinhThuong($this->thang_bat_dau,$this->thang_ket_thuc);
        $dsThangNamID = self::getDanhSachIDThangNam($dsThangTinhThuong,$this->nam);
        $dsThuongNhanVien = static::getDanhSachThuongThang($dsThangNamID,$this->id_nhan_vien);
        // dd($this->id_nhan_vien);
        $tienThuongNhanVien = $this->_tinhTienThuongCacThang($dsThuongNhanVien);
        return $tienThuongNhanVien;
    }

    private function _tinhTienThuongCacThang($dsThuongNhanVien) : array 
    {
        $tongNganSachThuong = 0;
        $tongTienThuongDaNhan = 0;
        foreach($dsThuongNhanVien as $thuongNhanVien) {
            if(!$thuongNhanVien->daKhoa()) {
                $thuongNhanVien->tinhNganSachThuong();
                $thuongNhanVien->tinhTongTienThuong();
                $thuongNhanVien->refresh();
            }            
            $tongNganSachThuong+=$thuongNhanVien->ngan_sach_thuong;
            $tongTienThuongDaNhan+=$thuongNhanVien->tong_tien_thuong_dat_duoc;    
                    
        }
        return [
            'tong_ngan_sach_thuong'=>$tongNganSachThuong,
            'tong_tien_thuong_da_nhan'=>$tongTienThuongDaNhan
        ];        
    }

    /**
     * danh sach thuong thang cua nhan vien trong khoang thoi gian
     */
    static public function getDanhSachThuongThang($dsThangNamID,$nhanVienID) : Collection
    {
        return ThuongNhanVien::whereIn('id_thang_nam',$dsThangNamID)->where('id_nhan_vien',$nhanVienID)->get();
    } 

    /**
     * danh sach thang trong quy, tra ve array thang
     */
    static public function getDanhSachThangTinhThuong($batDau,$ketThuc) : array 
    {
        $dsThang = [];
        for($i=$batDau;$i<=$ketThuc;$i++) {
            $dsThang[] = $i;
        }
        return $dsThang;
    }

    /**
     * lay ds thang thuoc quy dang duoc tinh
     */
    public function getDsThangThuocQuyDangTinh() : array
    {
        // if($this->thang_ket_thuc == "") {
        //     return [];
        // }

        return self::getDanhSachThangTinhThuong($this->thang_bat_dau,$this->thang_ket_thuc);
    }

    /**
     * danh sach thang id 
     * tra ve mang id DanhMucThangNam
     */
    static public function getDanhSachIDThangNam($dsThang = [], $nam) : array
    {
        $dsThangID = DanhMucThangNam::select(['id'])->where([
            'nam'=>$nam 
        ])->whereIn('thang',$dsThang)->get()->pluck('id')->toArray();
        return $dsThangID;        
    }


    /**
     * danh sach thang nam cua thuong dang itnh
     */
    public function getDanhSachIDThangNamThuong() : array
    {
        $dsThangTinhThuong = ThuongKhoangThoiGian::getDanhSachThangTinhThuong($this->thang_bat_dau,$this->thang_ket_thuc);
        return ThuongKhoangThoiGian::getDanhSachIDThangNam($dsThangTinhThuong,$this->nam);
    }

    /**
     * cap nhat chi tieu cong don thuoc thuong
     */
    public function capNhatChiTieuThuong() : void 
    {
        $dsThangNamID = $this->getDanhSachIDThangNamThuong();
        foreach($this->chiTieuCaNhanTheoThoiGian as $chiTieu) {
           $chiTieu->capNhatChiTieuCongDon($dsThangNamID,$this->id_nhan_vien);
        }
    }

    
    public function chiTieuDoanhSo() : ?ChiTieuCaNhanThoiGian 
    {
        $idChiTieuDoanhSo = DanhSachChiTieu::getIdChiTieuDoanhSoTheoNhom($this->nhanVien->id_nhom_nhan_vien);
        return $this->chiTieuCaNhanTheoThoiGian()->where([
            'id_chi_tieu'=>$idChiTieuDoanhSo
        ])->first();
    }


    /**
     * lay danh sach don hang torng thoi gian tinh thuong
     */
    public function getDSDonHangTinhThuong() : Collection
    {
        $dsThang = self::getDanhSachThangTinhThuong($this->thang_bat_dau, $this->thang_ket_thuc);
        $dsThangNamID = self::getDanhSachIDThangNam($dsThang,$this->nam);
        $dsThuongNhanVienThang = self::getDanhSachThuongThang($dsThangNamID,$this->id_nhan_vien);
        
        $dsThuongNhanVienID = $dsThuongNhanVienThang->pluck('id')->toArray();
        
        if(empty($dsThuongNhanVienID))
        {
            $dsThuongNhanVienID = [0];
        } 
        // dd($dsThuongNhanVienID);
        // $donHang = DonHang::whereHas('donHangTinhThuongs',function ($query) use ($dsThuongNhanVienID) {
        //     $query->whereIn('id',$dsThuongNhanVienID);
        // })->toSql();
        $donHang = DonHang::whereRelation('donHangTinhThuongs',function ($query) use ($dsThuongNhanVienID) {
            $query->whereIn('id',$dsThuongNhanVienID);
        })->get();
        // dd($donHang);
        
        return $donHang;
        
    }

    /**
     * thuogn nam tuong ung
     */
    public function thuongNamTuongUng() : ?ThuongKhoangThoiGian
    {
        if($this->loai == self::LOAI_THUONG_NAM) {
            return $this;
        }

        $thuongNam = self::where([
            'id_nhan_vien'=>$this->id_nhan_vien,
            'nam'=>$this->nam,
            'loai'=>self::LOAI_THUONG_NAM
        ])->first();
        return $thuongNam;
    }

    public function getHoTenAttribute() {
        if($this->id_nhan_vien != "") {
            return $this->nhanVien->ho_ten;
        }
        return "";
    }

    /**
     * 
     */
    public function getTongQuyRuiRo() : float 
    {
        $nam = $this->nam;
        $donHangTrongNam = DonHang::where([
            ['da_thanh_toan','=',DonHang::DA_THANH_TOAN_DU],
            ['quy_rui_ro','>',0],
            ['id_nhan_vien','=',$this->id_nhan_vien]
        ])->whereYear('ngay_tao_don',$nam)->sum('quy_rui_ro');

        return $donHangTrongNam;
    }

    

}



