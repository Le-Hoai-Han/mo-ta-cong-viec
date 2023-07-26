<?php

namespace App\Models\DonHang;

use App\Models\KhachHang;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\NhanVien;
use Illuminate\Database\Eloquent\Model;
use App\Models\NhatKyCapNhatHeThong;
use App\Models\Thuong\DonHangThuongMoMoi;
use App\Models\Thuong\SanPhamThuongMoMoi;
use App\Models\Thuong\ThuongMoMoi;
use App\Models\Thuong\NoXauThuocNhanVien;
use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Models\Thuong\ThuongNhanVien;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;
use App\Traits\DonHang\GuiMailDonDaDuyet;
use App\Traits\GetflyApi;
use App\Traits\ParseDataKH;
use FuncInfo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;

class DonHang extends Model
{
    use HasFactory;
    use GetflyApi;
    use GuiMailDonDaDuyet; 
    use ParseDataKH;

    protected $table = 'cms___don_hang';

    const TT_MOI = 0;
    const TT_DUYET = 1;
    const TT_THANH_TOAN = 2;
    const TT_HUY = 3;
    const TT_DA_XUAT_HET = 4;

    const CHUA_THANH_TOAN = 0;
    const DA_THANH_TOAN = 1;
    const DA_THANH_TOAN_MOT_PHAN = 1;
    const DA_THANH_TOAN_DU = 2;
    const TT_NO_XAU =3;

    const KHONG_TINH_THUONG = 0;
    const DUOC_TINH_THUONG = 1;

    const LOAI_DON_HANG_THUONG = 0;
    const LOAI_MAY_THANH_LY = 1;

    const NGUON_TU_TIM = 0;
    const NGUON_MARKETING = 1;

    CONST KHONG_LA_NO_XAU = 0;
    CONST LA_NO_XAU = 1;

    //thay doi tu 90 sang 120
    CONST SO_NGAY_NO_XAU = 120;

    CONST TI_LE_THUONG_DH_DICH_VU = 0.03;

    CONST ID_USER_3DS= 107;
    CONST ID_USER_3DM= 900;
    CONST ID_USER_ROOT= 0;

    CONST TT_VAT_DA_XAC_NHAN=1;
    CONST TT_VAT_CHUA_XAC_NHAN=0;
    CONST TT_VAT_CHO_XAC_NHAN=2;

    /**
     * trang thai don hang
     */
    public $danhSachTrangThai = [
        self::TT_MOI => 'Chưa duyệt',
        self::TT_DUYET => 'Đã duyệt',
        self::TT_THANH_TOAN => 'Đã thanh toán',
        self::TT_HUY => 'Đã hủy',
        self::TT_DA_XUAT_HET => 'Đã xuất hết'
    ];

    /**
     * don hang co nguon tu dau
     */
    public $danhSachNguonDonHang = [
        self::NGUON_TU_TIM=>'Nguồn tự tìm',
        self::NGUON_MARKETING=>'Nguồn Marketing'
    ];

    /**
     * don hang thanh ly hoac khong
     */
    public $danhSachLoaiDonHang = [
        self::LOAI_DON_HANG_THUONG=>'Đơn hàng thường',
        self::LOAI_MAY_THANH_LY=>'Đơn hàng thanh lý'
    ];

    /**
     * trang thai thanh toan
     */
    public $danhSachTrangThaiThanhToan = [
        self::CHUA_THANH_TOAN=>'Chưa thanh toán',
        self::DA_THANH_TOAN_MOT_PHAN=>'Đã thanh toán một phần',
        self::DA_THANH_TOAN_DU=>'Đã thanh toán đủ'
    ];

    /**
     * trang thai tinh thuong
     */
    public $danhSachTrangThaiTinhThuong = [
        self::KHONG_TINH_THUONG=>'Không được tính thưởng',
        self::DUOC_TINH_THUONG=>'Được tính thưởng'
    ];

    /**
     * trang thai no xau
     */
    public $danhSachTrangThaiNoXau = [
        self::KHONG_LA_NO_XAU => 'Không là nợ xấu',
        self::LA_NO_XAU => 'Đang là nợ xấu'
    ];

    /**
     * check don hang da tung co no xau hay chua
     */
    public function coLichSuNoXau() : bool 
    {
        if($this->noXauThuocDonHang != null) {
            return true; 
        }
        return false;
    }
    public function noXauThuocDonHang() :HasOne 
    {
        return $this->hasOne(NoXauThuocNhanVien::class,'id_don_hang','id');
    }

    public function linkNoXau() : string 
    {
        if($this->noXauThuocDonHang() != null) {
            return route('no-xau.show',['noXau'=>$this->noXauThuocDonHang]);
        }
        return "";
    }
    

    public function getTrangThaiBadge() : string
    {
        $trangThai = $this->trang_thai;
        $tenTrangThai = $this->danhSachTrangThai[$trangThai];
        switch ($this->trang_thai) {
            case self::TT_MOI:{
                $ttClass = 'warning';
                break;
            }
            case self::TT_DUYET: {
                $ttClass = "primary";
                break;
            }
            case self::TT_THANH_TOAN: {
                $ttClass = "success";
                break;
            }
            default: {
                $ttClass = "secondary";
                break;
            }            
        }
        return  '<span class="badge bg-gradient-'.$ttClass.'">'.$tenTrangThai.'</span>';
    }

    public function duocTinhThuongBadge() : string
    {
        $duocTinhThuong = $this->duoc_tinh_thuong;
        switch($duocTinhThuong) {
            case self::DUOC_TINH_THUONG: {
                $ttClass = 'primary';
                $title = 'Được tính thưởng';
                break;
            }
            default: {
                $ttClass = 'secondary';
                $title = 'Không tính thưởng';
                break;
            }
        }
        return  '<span class="badge bg-gradient-'.$ttClass.'">'.$title.'</span>';
        
    }

    public function daThanhToanBadge()  : string
    {
        $daThanhToan = $this->da_thanh_toan;
        switch($daThanhToan) {
            case self::DA_THANH_TOAN_MOT_PHAN: {
                $ttClass = 'warning';
                $title = 'Thanh toán một phần';
                break;
            }
            case self::DA_THANH_TOAN_DU: {
                $ttClass = 'success';
                $title = 'Đã thanh toán đủ';
                break;
            }           
            default: {
                $ttClass = 'secondary';
                $title = 'Chưa thanh toán';
                break;
            }
        }
        return  '<span class="badge bg-gradient-'.$ttClass.'">'.$title.'</span>';
        
    }

    public function getNoXauBadge() : string
    {
        
        if($this->la_no_xau == self::LA_NO_XAU) {
            return  '<span class="badge bg-gradient-danger">Có nợ xấu</span>';
        }
        return "";
        
    }

    

    public function loaiDonHangBadge() : string
    {
        
        switch($this->la_don_hang_thanh_ly) {
            case self::LOAI_MAY_THANH_LY: {
                $ttClass = 'success';
                $title = 'Đơn hàng thanh lý';
                break;
            }
          
            default: {
                $ttClass = 'primary';
                $title = 'Đơn hàng thường';
                break;
            }
        }
        return  '<span class="badge bg-gradient-'.$ttClass.'">'.$title.'</span>';
        
    }

    public function nguonDonHangBadge() : string
    {
        
        switch($this->la_nguon_marketing) {
            case self::NGUON_MARKETING: {
                $ttClass = 'success';
                $title = 'Nguồn từ marketing';
                break;
            }
          
            default: {
                $ttClass = 'primary';
                $title = 'Nguồn tự tìm';
                break;
            }
        }
        return  '<span class="badge bg-gradient-'.$ttClass.'">'.$title.'</span>';
        
    }


    

    public function getTenTrangThaiAttribute() : string
    {
        return $this->danhSachTrangThai[$this->trang_thai];
    }
    protected $fillable = [
        'ma_don_hang',
        'ten_nguoi_tao',
        'id_nhan_vien',
        'doanh_so',
        'doanh_thu',
        'da_thanh_toan',
        'ngay_tao_don',
        'ngay_bat_dau_tinh_thoi_han',
        'ngay_ket_thuc_tinh_thuong',
        'duoc_tinh_thuong',
        'da_cap_nhat',
        'trang_thai',
        'tien_thuong_don_hang',
        'la_nguon_marketing',
        'la_don_hang_thanh_ly',
        'chi_phi_phat_sinh',
        'chi_phi_khac',
        'dat_lai',
        'ngay_nghiem_thu',
        'id_khach_hang',
        'so_ngay_tinh_cong_no',
        'ten_nguoi_lien_he',
        'xac_nhan_vat',
        'token',
        'quy_rui_ro',
        'phi_van_chuyen_cua_don_hang'
    ];

    /**
     * san pham thuoc don hang
     */
    public function sanPhams() : HasMany
    {
        return $this->hasMany(SanPhamThuocDonHang::class, 'id_don_hang', 'id');
    }

    public function khachHang()
    {
        return $this->hasOne(KhachHang::class, 'id', 'id_khach_hang');
    }

    /**
     * nhan vien ban don hang
     */
    public function nhanVien() : BelongsTo
    {
        return $this->belongsTo(NhanVien::class, 'id_nhan_vien', 'id');
    }

    /**
     * don hang duoc tinh thuong trong thang
     */
    public function donHangTinhThuongs() : BelongsToMany
    {
        return $this->belongsToMany(ThuongNhanVien::class,'cms___don_hang_tinh_thuong', 'id_don_hang','id_thuong_nhan_vien');
    }

    /**
     * don hang duoc tinh thuong trong thang
     */
    public function donHangThuongNams() : BelongsToMany
    {
        return $this->belongsToMany(ThuongKhoangThoiGian::class,'cms___don_hang_tinh_thuong','id_don_hang','id_thuong_thoi_gian');
    }

    /**
     * thuong ky thuat don hang
     */
    public function thuongKyThuatDonHang() : HasMany
    {
        return $this->hasMany(ThuongKyThuatDonHang::class,'id_don_hang','id');
    }



    /**
     * cap nhat trang thai don hang
     */
    public function updateStatus($orderCode, $status) : bool
    {
        $donHang = self::where([
            'ma_don_hang' => $orderCode
        ])->first();
        if ($donHang !== null) {
            $donHang->trang_thai = $status;
            if ($donHang->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Thông tin cập nhật đơn hàng
     */
    public function thongTinCapNhats() : MorphMany
    {
        return $this->morphMany(NhatKyCapNhatHeThong::class, 'thongTinCapNhat', 'ten_model_thay_doi', 'id_model_thay_doi', 'id');
    }


    /**
     * don hang da duyet
     */
    public function donDaDuyet() : HasOne
    {
        return $this->hasOne(DonHangDaDuyet::class,'id_don_hang','id');
    }

    /**
     * Danh mục thanh toán thuộc đơn hàng
     */
    public function thanhToanThuocDonHang() : HasMany
    {
        return $this->hasMany(ThanhToanThuocDonHang::class, 'id_don_hang', 'id');
    }


    /**
     * Hiển thị thông tin thanh toan của đơn hàng
     */
    public function thongTinThanhToan() : string
    {
        $thongTin = "Số tiền:<br>" . thuGonSoLe($this->thanhToanThuocDonHang()->sum('so_tien_thanh_toan')) . " (VNĐ) <br>";
        $ngayThanhToan = [];

        foreach ($this->thanhToanThuocDonHang as $thanhToan) {
            $ngayThanhToan[] = "Ngày: " . formatNgayDMY($thanhToan->ngay_thanh_toan);
        }

        $thongTin .= implode("<br>", $ngayThanhToan);
        return $thongTin;
    }

    /**
     * Tổng số tiền thanh toán thuộc đơn hàng
     */
    public function tongTienThanhToan() : float
    {
        $tongTienThanhToan = $this->thanhToanThuocDonHang()->sum('so_tien_thanh_toan');
        return $tongTienThanhToan;
    }

    // Check đơn hàng có ngày tạo đơn bắt đầu vào ngày quy định

    public function donHangBDTuNgay($ngay){
        $ngayTaoDon=date('Y-m-d',strtotime($this->ngay_tao_don));
        $ngayQuiDinh=date('Y-m-d',strtotime($ngay));
        if($ngayTaoDon >= $ngayQuiDinh){
            return true;
        }else{
            return false;
        }
    }

    public function donHangNotVAT(){
        if($this->doanh_so+$this->doanh_so*10/100 > $this->doanh_thu){
            return true;
        }
        return false;
    }

    /**
     * so tien tinh thuong trong don hang
     */
    public function getSoTienTinhThuongAttribute() : float
    {
        if($this->sanPhams->isNotEmpty())
            return $this->sanPhams()->sum('so_tien_tinh_thuong');
        return 0;
    }

    public static function trangThaiDonThuongKyThuat()
    {
        return [
            self::TT_DUYET,
            self::TT_THANH_TOAN,
            self::TT_DA_XUAT_HET
        ];
    }

    /**
     * tao showlink theo mã đơn hàng (mặc định)
     */
    public function showLink($label="ma_don_hang"): string {
        $link = "<a href='".route('don-hang.show',$this)."' class='text-primary'>" . $this->$label . "</a>";
        return $link;
    }

    /**
     * don hang da thanh toan du va khong phai don huy
     */
    public function scopeDaThanhToanDu($query) {
        return $query->where([
            ['trang_thai','<>',self::TT_HUY],
            ['da_thanh_toan','=',self::DA_THANH_TOAN_DU]
        ]);
    }
    public function donHangThuongMoMoi(){
        return $this->belongsTo(DonHangThuongMoMoi::class,'id','id_don_hang');
    }

    public function checkDonHangThanhToanDu()
    {
        if($this->tongTienThanhToan() == $this->doanh_thu){
            return true;
        }
        return false;
    }

    public function layDonHangDauTienDeLuu()
    {
        $order = DonHang::where('id_khach_hang', '=', ($this->khachHang? $this->khachHang->id:'' ))
        ->where('trang_thai', '!=', DonHang::TT_HUY)
        // ->where('id_nhan_vien', '!=', config('services.3ds.id_nguoi_tao'))
        ->orderBy('ngay_tao_don', 'ASC')
        ->first();
        return $order;
        if($order != null){
            return $order;
        }
        
        return $this;
    }

    public function donHangDauTien(){
        return $this->hasOne(DonHangDauTien::class,'id_don_hang','id');
    }


      /**
     * san pham thuong mo moi
     */
    public function sanPhamThuongMoMoi() : HasMany
    {
        return $this->hasMany(SanPhamThuongMoMoi::class, 'id_don_hang', 'id');
    }

}
