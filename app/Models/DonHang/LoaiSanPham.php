<?php

namespace App\Models\DonHang;

use App\Models\NhanVien\NhomNhanVien;
use App\Traits\ThuongQuanLy\LoaiSanPhamQuanLyTrait;
use App\Models\Thuong\TiLeThuongMoMoi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoaiSanPham extends Model
{
    use HasFactory;
    use LoaiSanPhamQuanLyTrait;

    CONST TI_LE_THUONG_THANH_LY = 3;
    CONST CAP_NHAT_TI_LE_CHO_LOP_CON = 1;
    CONST ID_LOAI_MASTERCAM = 9;

    CONST ID_SCAN_ONLY = 49 ;
    CONST ID_THIET_KE_KHUON = 30 ;
    CONST ID_THIET_KE_NGUOC = 27 ;
    CONST ID_THIET_KE_KIEU_DANG = 26 ;

    protected $table = "cms___loai_san_pham";

    public $timestamps = false;
    
    public function parent() : BelongsTo
    {
        return $this->belongsTo(LoaiSanPham::class, 'parent_id','id');
    }

    public function children() : HasMany
    {
        return $this->hasMany(LoaiSanPham::class, 'parent_id','id');
    }

    public function sanPhamThuocLoai() : HasMany
    {
        return $this->hasMany(DanhMucSanPham::class,'id_loai_san_pham','id');
    }

    public function tiLeThuongThuocLoai(){
     return $this->belongsToMany(NhomNhanVien::class,'cms___ti_le_thuong_theo_nhom','id_loai_sp','id_nhom_nv');
    }

    public function tiLeThuongMoMoi(){
        return $this->hasMany(TiLeThuongMoMoi::class,'id_loai_san_pham','id');
    }

    public function queryTree($array){
        $collection=LoaiSanPham::whereIn('parent_id',$array)->select('id','level')->get();
        if($collection->isEmpty()){
           return $array;
        }

        $dsCon = [];

        foreach($collection as $item){
            if($item->level < 4){
                $dsCon = array_merge($dsCon, $item->queryTree($item->children()->where('id', '<>', $item->id)->pluck('id')->toArray()));
            }else{
                array_push($dsCon, $item->id);
            }
        }
        
        return array_unique(array_merge($dsCon, $collection->pluck('id')->toArray(), $array));
    }

    public $fillable = [
        'id', //cho nhap id de giong getfly
        'code',
        'name',
        'parent_id',
        'level',
        'ti_le_thuong_sale',
        'ti_le_thuong_sale_co_nguon',
        'ti_le_thuong_bd'
    ];
}
