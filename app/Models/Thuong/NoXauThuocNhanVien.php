<?php

namespace App\Models\Thuong;

use App\Models\DonHang\DonHang;
use App\Traits\ThuocNhanVien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NoXauThuocNhanVien extends Model
{
    use HasFactory;
    use ThuocNhanVien;

    CONST NGAY_BAT_DAU_TINH = "2022-09-01";

    public $table = 'cms___no_xau_thuoc_nhan_vien';


    public $fillable = [
        'id_nhan_vien',
        'id_don_hang',
        'tong_so_tien',
        'tien_da_tru',
        'tien_con_lai',
        'ngay_bat_dau',
        'ngay_ket_thuc'
    ];

    public function donHang() : BelongsTo
    {
        return $this->belongsTo(DonHang::class,'id_don_hang','id');
    }

    public function noXauDaTru() : HasMany
    {
        return $this->hasMany(ChiTietNoXauDaTru::class,'id_no_xau','id');
    }

    /**
     * check xem no xau da thanh toan du hay chua
     */
    public function daXuLy() : bool
    {
        if($this->ngay_ket_thuc!=null)
            return true; 
        return false;
    }

    /**
     * scope thanh toan du
     */
    public function scopeDaXuLy($query) 
    {
        $query->whereNotNull('ngay_ket_thuc');
    }

    /**
     * label trang thai
     */
    public function labelTrangThai() : string
    {        
        if ($this->daXuLy()) {
            $status = "success";
            $label = "Đã xử lý";
        } else {
            $status = "warning";
            $label = "Đang xử lý";
        }

        return "<span class='badge bg-gradient-".$status."'>".$label."</span>";

    }

    /**
     * cap nhat so tien no
     */
    public function capNhatTienNo() : void 
    {
        $this->tien_da_tru = $this->noXauDaTru->sum('so_tien');
        $this->capNhatTienConLaiVaXuLy();
        $this->save();
    }

    protected static function booted() 
    {
        parent::booted();
        self::saving(function($noXau) {
            $noXau->capNhatTienConLaiVaXuLy();
        });
        self::deleting(function($noXau) {
            foreach($noXau->noXauDaTru as $chiTietNoXauDaTru) {
                $chiTietNoXauDaTru->delete();
            }
        });
    }

    /**
     * gan gia tri cho tien con lai va ngay ket thuc
     */
    public function capNhatTienConLaiVaXuLy() : void {
        $this->tien_con_lai = max(0,$this->tong_so_tien - $this->tien_da_tru);
        if($this->tien_con_lai <= 0) {
            
            $this->ngay_ket_thuc = $this->noXauDaTru->max('ngay_tru_no');
            // $donHang = $this->donHang;
            // $donHang->la_no_xau = DonHang::KHONG_LA_NO_XAU;
            // $donHang->save();

        } else {
            $this->ngay_ket_thuc = null;
        }
    }

   
    
    
}
