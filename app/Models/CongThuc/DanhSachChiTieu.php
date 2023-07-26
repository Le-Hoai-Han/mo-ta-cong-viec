<?php

namespace App\Models\CongThuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CoThangNam;
use App\Traits\ThuocNhanVien;
use App\Traits\ThuocNhomNhanVien;
use Illuminate\Database\Eloquent\Collection;

// use Illuminate\Database\Eloquent\Collection;

class DanhSachChiTieu extends Model
{
    use HasFactory;
    use ThuocNhanVien;
    use CoThangNam;
    use ThuocNhomNhanVien;


    CONST CHIEU_HUONG_TOT_TANG = 1;
    CONST CHIEU_HUONG_TOT_GIAM = 0;

    // CONST NHOM_SALE = 0;
    // CONST NHOM_TELESALE = 1;
    // CONST NHOM_SALE_MANAGER = 2;

    protected $table = 'cms___danh_sach_chi_tieu';

    protected $fillable = [
        'ten_chi_tieu',
        'loai_chi_tieu',
        'muc_tieu_mac_dinh',
        'chieu_huong_tot',
        'mo_ta',
        'id_nhom_nhan_vien',
        'thu_tu_sap_xep'
    ];

    public function danhSachChiTieuCaNhan() {
        return $this->hasMany(ChiTieuCaNhan::class,'id_chi_tieu','id');
    }

    public function danhSachChiTieuThuongThoiGian() {
        return $this->hasMany(ChiTieuCaNhanThoiGian::class,'id_chi_tieu','id');
    }

    public function danhSachCongThuc() {
        return $this->belongsToMany(CongThucTinh::class,'cms___chi_tieu_thuoc_cong_thuc','id_chi_tieu','id_cong_thuc');
    }

    protected static function booted()
    {
        // 
        parent::booted();
        static::deleting(function($chiTieu) {
            $chiTieu->danhSachCongThuc()->detach();
            if(!empty($chiTieu->danhSachChiTieuCaNhan)) {
                foreach($chiTieu->danhSachChiTieuCaNhan as $chiTieuCaNhan) {
                    $chiTieuCaNhan->delete();
                }
                foreach($chiTieu->danhSachChiTieuThuongThoiGian as $chiTieuThoiGian) {
                    $chiTieuThoiGian->delete();
                }
            }
        });
        
    }

    /**
     * @var interger $idNhomNhanVien
     * @return Collection
     */
    public function congThucThuocNhom($idNhomNhanVien) : ?Collection
    {
        // if($this->id == 39) {
        //     dd($this->danhsachCongThuc()->thuocNhom($idNhomNhanVien)->get());
        // }
        return $this->danhsachCongThuc()->thuocNhom($idNhomNhanVien)->get();
    }



    public function congThucThuocNhomHienTai() : ?Collection
    {
        return $this->congThucThuocNhom($this->id_nhom_nhan_vien);
    }

    // public $dsNhomChiTieu = [
    //     null=>'Chưa cập nhật',
    //     self::NHOM_SALE=>'Kinh doanh (Sale)',
    //     self::NHOM_TELESALE=>'CSKH (Telesale)',
    //     self::NHOM_SALE_MANAGER=>'Quản lý kinh doanh (Sale Manager)'
    // ];

    // public function getNhomChiTieuLabelAttribute() : string {
    //     return $this->dsNhomChiTieu[$this->nhom_chi_tieu];
    // }
    

    // public $mucTieuMacDinh = [
    //     7=>550000000,
    //     8=>10,
    //     9=>50,
    //     10=>4,
    //     11=>10,
    //     12=>1
    // ];

        //them la cot trong db luon ko dung nua
    // public function getMucTieuMacDinhAttribute() {
    //     return $this->mucTieuMacDinh[$this->id];
    // }

    
    static public function getIdChiTieuDoanhSoTheoNhom($idNhomNhanVien) : int 
    {
        $chiTieuDoanhSo = self::getChiTieuDoanhSoTheoNhom($idNhomNhanVien);
        if($chiTieuDoanhSo == null) 
            return 0;
        return $chiTieuDoanhSo->id;

    }

    static public function getChiTieuDoanhSoTheoNhom($idNhomNhanVien) : ?DanhSachChiTieu 
    {
        $thuTuChiTieuDoanhSo = config('services.3ds.thu_tu_chi_tieu_doanh_so');
        return DanhSachChiTieu::where('thu_tu_sap_xep',$thuTuChiTieuDoanhSo)->where('id_nhom_nhan_vien',$idNhomNhanVien)->first();;

    }
}
