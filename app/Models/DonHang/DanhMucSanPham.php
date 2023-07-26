<?php

namespace App\Models\DonHang;

use App\Models\ThuongKyThuat\SoTienThuongKyThuat;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;
use App\Traits\ThuocLoaiSanPham;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DanhMucSanPham extends Model
{
    use HasFactory;
    use ThuocLoaiSanPham;

    protected $table = 'cms___danh_muc_san_pham';

    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'mo_ta',
        'ti_le_thuong',
        'ti_le_thuong_bd',
        'ti_le_thuong_sale',
        'thue_vat',
        'da_cap_nhat',
        'dong_san_pham',
        'id_loai_san_pham'
    ];  

    
    const DONG_ENTRY = "ENTRY_LEVEL";
    const DONG_ADVANCE = "ADVANCE_LEVEL";
    const DONG_HIGH_END = "HIGH_END";
    const DONG_RONG = "";

    CONST DANH_MUC_MASTERCAM = 9;

    CONST MA_DAO_TAO_CONG_NGHE = 'DV.20';

    CONST ID_DICH_VU = 19;
    
    /**
     * danh muc san pham chua cac san pham nao thuoc don hang nao
    */
    public function sanPhams() : HasMany 
    {
        return $this->hasMany(SanPhamThuocDonHang::class,'id_san_pham','id');
    }

    public function tienThuongTheoSanPhams() : BelongsToMany
    {
        return $this->belongsToMany(SoTienThuongKyThuat::class,'kt___so_tien_thuong_ky_thuat_theo_san_pham','id_san_pham','id_so_tien_thuong');
    }

    /**
     * Check don hang dich vu
     * neu level == 1 mà id loại khác DỊCH VỤ thì return false
     * nguoc lại return true
     */
    // public function checkDHDV($loaiSanPham){
    //     $idSanPhamDichVu = config('services.san-pham-dich-vu.id_san_pham_dich_vu');
    //     if($loaiSanPham != null && $loaiSanPham->level>1){
    //         return $this->checkDHDV($loaiSanPham->parent);
    //     } else if($loaiSanPham != null && $loaiSanPham->id != $idSanPhamDichVu){
    //         return false;
    //     }
    //     return true;
        
    // }

    /**
     * Check don hang dich vu
     * neu level == 1 mà id loại khác DỊCH VỤ thì return false
     * nguoc lại return true
     */
    public function checkDHDV() : bool
    {
        $idSanPhamDichVu = config('services.san-pham-dich-vu.id_san_pham_dich_vu');        
        return $this->checkSanPhamTheoLoaiID($idSanPhamDichVu,$this->loaiSanPham);
    }

     // Check ngày nghiệm thu
    public function checkNgayNghiemThu()
    {
        $idSanPhamDichVu = config('services.san-pham-dich-vu.id_san_pham_dich_vu');
       if($this->checkSanPhamTheoLoaiID($idSanPhamDichVu,$this->loaiSanPham) == false){
            if($this->checkSanPhamNguyenVatLieu() == true){
                return true;
            }else{
                return $this->checkSanPhamPhuKien();
            }
        }
    }
    public function checkSanPhamPM(){
        $idSanPhamPM=config('services.san-pham-phan-mem.id_san_pham_phan_mem');
        return $this->checkSanPhamTheoLoaiID($idSanPhamPM,$this->loaiSanPham);
       
    }

    public function checkSanPhamNguyenVatLieu(){
        $dSidSanPhamNguyenVatLieu=config('services.san-pham-nguyen-vat-lieu');
        $result=false;
        foreach($dSidSanPhamNguyenVatLieu as $id){
            if($this->checkSanPhamTheoLoaiID($id,$this->loaiSanPham) == true){
                $result = true;
                break;
            }
        }
        return $result;
       
    }

    // Check sản phẩm có thuộc danh mục phụ kiện không
    public function checkSanPhamPhuKien(){
        $dSidSanPhamPhuKien=config('services.san-pham-phu-kien');
        $result=false;
        foreach($dSidSanPhamPhuKien as $id){
            if($this->checkSanPhamTheoLoaiID($id,$this->loaiSanPham) == true){
                $result = true;
                break;
            }
        }
        return $result;
       
    }

    public function checkSanPhamTheoLoaiID($idLoaiCanCheck, $loaiSanPham) : bool 
    {
        //null return false
        if($loaiSanPham == null) {
            return false;
        }
        
        if($loaiSanPham->id == $idLoaiCanCheck) {
            return true;
        }

        if($loaiSanPham->level > 1) {
            return $this->checkSanPhamTheoLoaiID($idLoaiCanCheck, $loaiSanPham->parent);
        }

        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($sanPham) {
            
            $sanPham->mo_ta = "";
            $sanPham->ti_le_thuong = 0;
            $sanPham->da_cap_nhat = 0;
            $sanPham->thue_vat = 0;
            $sanPham->ti_le_thuong_sale = 0;
            $sanPham->ti_le_thuong_bd = 0;
        });

       
    }

    /**
     * tim id dich vu dao tao cong nghe
     */
    static public function getIDDaoTaoCongNghe() : int 
    {
        return DanhMucSanPham::where('ma_san_pham',DanhMucSanPham::MA_DAO_TAO_CONG_NGHE)->first()->id;
    }

    /**
     * check san pham thuoc dong san pham thuong geomagic
     */
    public function checkThuongGeomagic() : bool 
    {
        return (bool)in_array($this->dong_san_pham,ThuongKyThuatDonHang::LOAI_GEOMAGIC);
    }
}
