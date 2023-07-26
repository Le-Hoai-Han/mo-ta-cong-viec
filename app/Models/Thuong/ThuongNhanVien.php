<?php

namespace App\Models\Thuong;

use App\Interfaces\CheckDeleteInterface;
use App\Models\CongThuc\ChiTieuCaNhan;
use App\Models\CongThuc\CongThucTinh;
use App\Models\CongThuc\DanhSachHangMucThuong;
use App\Models\DanhMucThangNam;
use App\Models\DonHang\DonHang;
use App\Models\DonHang\ThanhToanThuocDonHang;
use App\Models\NhanVien;
use App\Models\Thuong\KetQuaTinhThuong;
use App\Traits\CoThangNam;
use App\Traits\ThuocNhanVien;
use App\Traits\ThuongThangNhanVien;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class ThuongNhanVien extends Model implements CheckDeleteInterface
{
    use HasFactory;
    use ThuocNhanVien;
    use CoThangNam;
    use ThuongThangNhanVien;

    protected $table = "cms___thuong_nhan_vien";

    protected $fillable = [
        'id_nhan_vien',
        'id_thang_nam',
        'ngan_sach_thuong',
        'tong_tien_thuong_dat_duoc',
        'da_nhan_thuong'
    ];

    const TT_CHUA_NHAN_THUONG = 0;
    const TT_DA_NHAN_THUONG = 1;

    // CONST NHOM_THUONG_KY_THUAT = ["AE","SUPERVISOR_CNC","SUPERVISOR_PRODUCTION"];

    public function daNhanThuongBadge() {
        
        switch($this->da_nhan_thuong) {
            case self::TT_CHUA_NHAN_THUONG: {
                $ttClass = 'secondary';
                $title = 'Chưa nhận thưởng';
                break;
            }
          
            default: {
                $ttClass = 'success';
                $title = 'Đã nhận thưởng';
                break;
            }
        }
        return  '<span class="badge bg-gradient-'.$ttClass.'">'.$title.'</span>';
        
    }



    public function thuongTheoHangMuc()
    {
        return $this->hasMany(ThuongNhanVienTheoHangMuc::class, 'id_thuong_nhan_vien', 'id');
    }

    public function danhSachHangMucNhanVien()
    {
        return $this->belongsToMany(DanhSachHangMucThuong::class, 'cms___thuong_nhan_vien_theo_hang_muc', 'id_thuong_nhan_vien', 'id_hang_muc');
    }

    public function ketQuaTinhThuong()
    {
        return $this->hasMany(KetQuaTinhThuong::class, 'id_thuong_nhan_vien', 'id');
    }

    public function congThucTinh()
    {
        return $this->belongsToMany(CongThucTinh::class, 'cms___ket_qua_tinh_thuong', 'id_thuong_nhan_vien', 'id_cong_thuc')->withTimestamps();
    }

    /**
     * don hang duoc tinh thuong trong thang
     */
    public function donHangTinhThuongs() : BelongsToMany
    {
        return $this->belongsToMany(DonHang::class,'cms___don_hang_tinh_thuong','id_thuong_nhan_vien','id_don_hang');
    }

    

    


    public function tinhTongTienThuong() : bool
    {
        if($this->da_nhan_thuong == self::TT_CHUA_NHAN_THUONG) {
            $tongTienThuong = $this->thuongTheoHangMuc()->sum('so_tien_thuong');
            $thuongNhanVien = ThuongNhanVien::find($this->id);
            $thuongNhanVien->update([
                'tong_tien_thuong_dat_duoc' => $tongTienThuong
            ]);
            return true;
        }
        return false;
        
        //tong tien thuong = tong so thuong theo hang muc + lai trong 1 thang

    }

    protected static function booted()
    {
        
        static::creating(function ($thuongNhanVien) {
            $thuongNhanVien->ngan_sach_thuong = 0;
            $thuongNhanVien->tong_tien_thuong_dat_duoc = 0;
        });

       static::deleting(function($thuongNhanVien) {
            $thuongNhanVien->danhSachHangMucNhanVien()->detach();
            $thuongNhanVien->congThucTinh()->detach();
            $thuongNhanVien->donHangTinhThuongs()->detach();
            $dsChiTieuCaNhan = ChiTieuCaNhan::where([
                'id_nhan_vien'=>$thuongNhanVien->id_nhan_vien,
                'id_thang_nam'=>$thuongNhanVien->id_thang_nam
            ])->get();
            foreach($dsChiTieuCaNhan as $chiTieuCaNhan) {
                $chiTieuCaNhan->delete();
            }
       });
    }


    /**
     * tim theo id user, id thang hoac them moi 
     * return model
     */
    public function timHoacThemMoi($idNhanVien, $idThang)
    {
        $thuongNhanVien = self::where([
            'id_thang_nam' => $idNhanVien,
            'id_nhan_vien' => $idThang
        ])->first();
        if ($thuongNhanVien !== null) {
            return $thuongNhanVien;
        } else {
            $thuongNhanVien = self::create([
                'id_thang_nam' => $idThang,
                'id_nhan_vien' => $idNhanVien
            ]);
            return $thuongNhanVien;
        }
    }

    public function checkDelete()
    {
        if ($this->thuongTheoHangMuc->isNotEmpty()) {
            // Xóa hạng mục của NV
            foreach($this->thuongTheoHangMuc as $item){
               $item->delete();
            }
        }

        if ($this->ketQuaTinhThuong->isNotEmpty()) {
            // Xóa kết quả tính thưởng của NV
           foreach($this->ketQuaTinhThuong as $item){
                $item->delete();
           }
        }
        return true;
    }

    // public function ngayThang(){
    //     return $this->hasMany(DanhMucThangNam::class,'id','id_thang_nam');
    // }

    public function doanhThuThang() {
        $thangNam = $this->thangNam;
        
        $donHang = DonHang::where([
            ['id_nhan_vien','=',$this->id_nhan_vien],            
            ['duoc_tinh_thuong','=',DonHang::DUOC_TINH_THUONG]
        ])->whereHas('thanhToanThuocDonHang',function($q) use ($thangNam){
            $q->where([
                [DB::raw('YEAR(ngay_thanh_toan)'),'=',$thangNam->nam],
                [DB::raw('MONTH(ngay_thanh_toan)'),'=',$thangNam->thang]
            ]);
        })->sum('doanh_thu');
        return $donHang;
    }

    public function donHangTrongThang() {
        $thangNam = $this->thangNam;
        
        $soDonHang = DonHang::where([
            ['id_nhan_vien','=',$this->id_nhan_vien],            
            ['duoc_tinh_thuong','=',DonHang::DUOC_TINH_THUONG]
        ])->whereHas('thanhToanThuocDonHang',function($q) use ($thangNam){
            $q->where([
                [DB::raw('YEAR(ngay_thanh_toan)'),'=',$thangNam->nam],
                [DB::raw('MONTH(ngay_thanh_toan)'),'=',$thangNam->thang]
            ]);
        })->count();
        return $soDonHang;
    }

    public function tinhNganSachThuong() {
        return $this->_tinhNganSachThuong($this);
    }

    public function nhanVien(){
        return $this->hasOne(NhanVien::class,'id','id_nhan_vien');
    }

    public function daKhoa() :bool 
    {
        if($this->da_nhan_thuong == self::TT_DA_NHAN_THUONG) {
            return true;
        }
        return false;
    }

    /**
     * lay thong tin thuong quy tuong ung cua thang
     */
    public function thuongQuyTuongUng() : ?ThuongKhoangThoiGian
    {
        $thangNam = $this->thangNam;
        return (new ThuongKhoangThoiGian())->getQuyCanTinh($thangNam->thang,$thangNam->nam, $this->id_nhan_vien);
    }

    /**
     * lay thong tin thuong nam tuong ung cua thang thuong
     */
    public function thuongNamTuongUng() : ?ThuongKhoangThoiGian
    {
        $thangNam = $this->thangNam;
        $thuongNam = ThuongKhoangThoiGian::where([
            'nam'=>$thangNam->nam,
            'loai'=>ThuongKhoangThoiGian::LOAI_THUONG_NAM,
            'id_nhan_vien'=>$this->id_nhan_vien
        ])->first();
        return $thuongNam;
    }

    public function scopeThuongKyThuat($query) {
        return $query->whereHas('nhanVien',function($query) {
            return $query->nhomKyThuat();
        });
    } 

    public function scopeThuongKinhDoanh($query) {
        return $query->whereDoesntHave('nhanVien',function($query) {
            return $query->nhomKyThuat();
        });
    } 

    // public function nhanVienKyThuat() : BelongsTo
    // {
    //     return $this->belongsTo(NhanVien::class,'id_nhan_vien','id')->withDefault()->nhanVienKyThuat();
    // }

}
