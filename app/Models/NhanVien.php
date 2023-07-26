<?php

namespace App\Models;

use App\Models\CongThuc\ChiTieuCaNhan;
use App\Models\CongThuc\DanhSachChiTieu;
use App\Models\DonHang\DonHang;
use App\Models\NhanVien\NhomNhanVien;
use App\Models\Thuong\DonHangThuongMoMoi;
use App\Models\Thuong\NoXauThuocNhanVien;
use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Models\Thuong\ThuongMoMoi;
use App\Models\Thuong\ThuongNhanVien;
use App\Models\ThuongQuanLy\ThuongSanPhamQuanLy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Traits\ThuocNhomNhanVien;
use App\Traits\ThuongMoMoiTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NhanVien extends Model
{
    // use HasFactory;
    use ThuocNhomNhanVien;
    use ThuongMoMoiTrait;
    
    CONST TEAM_SALE = 'Sale';
    CONST TEAM_BD = 'BD';
    CONST TEAM_AE = 'AE';
    CONST TEAM_PD = 'PD';
    CONST TEAM_DESIGN = 'Design';
    CONST TEAM_GENERAL = 'Chung';  

    protected $table = 'cms___nhan_viens';

    public $fillable = [
        'id_nhom_nhan_vien',
        'user_id',
        'getfly_id',
        'ho_ten'
    ];

    CONST TT_DA_XOA = 1;
    CONST TT_KO_XOA = 0;

    public $dsTrangThaiXoa = [
        self::TT_DA_XOA => 'Đã xóa',
        self::TT_KO_XOA => 'Đang hoạt động'
    ];

     /**
     * check xem nhan vien da xoa hay chua
     */
    public function checkNhanVienDaXoa() : bool
    {
        return $this->da_xoa;
    }

    /**
     * tao label cho trang thai nhan vien da xoa/chua xoa
     */
    public function getTrangThaiXoaLabelAttribute() {
        if($this->checkNhanVienDaXoa()) {
            $colorClass = 'danger';
        } else {
            $colorClass = 'primary';
        }
        return "<span class='badge bg-gradient-".$colorClass."'>".$this->dsTrangThaiXoa[$this->da_xoa]."</span>";
    }


    public function thuongNhanVienTheoThang()
    {
        return $this->belongsToMany(DanhMucThangNam::class, 'cms___thuong_nhan_vien', 'id_nhan_vien', 'id_thang_nam')->withTimestamps();
    }

    public function thuongNhanVien()
    {
        return $this->hasMany(ThuongNhanVien::class, 'id_nhan_vien', 'id');
    }
    public function thuongNhanVienTheoThoiGian()
    {
        return $this->hasMany(ThuongKhoangThoiGian::class, 'id_nhan_vien', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function donHangs() 
    {
        return $this->hasMany(DonHang::class,'id_nhan_vien','id');
    }

    public function chiTieuCaNhans() {
        return $this->hasMany(ChiTieuCaNhan::class,'id_nhan_vien','id');
    }

    public function chiTieus() {
        return $this->belongsToMany(DanhSachChiTieu::class,'cms___chi_tieu_ca_nhan','id_nhan_vien','id_chi_tieu')->withTimestamps();
    }

    public function chiTieuThangs() {
        return $this->belongsToMany(DanhSachChiTieu::class,'cms___chi_tieu_ca_nhan','id_nhan_vien','id_chi_tieu')->withTimestamps();
    }


    public function noXauThuocNhanVien() : HasMany
    {
        return $this->hasMany(NoXauThuocNhanVien::class,'id_nhan_vien','id');
    }    

    /**
     * quản lý nhóm nhân viên relation
     */
    public function quanLy() : HasOne
    {
        return $this->hasOne(NhomNhanVien::class,'id_quan_ly','id');
    }


    /**
     * thuong san pham quan ly
     */
    public function thuongSanPhamQuanLy() : HasMany
    {
        return $this->hasMany(ThuongSanPhamQuanLy::class,'id_nhan_vien','id');
    }

    // public $ds_team = [
    //     self::TEAM_GENERAL=>'',
    //     self::TEAM_SALE => 'Sale Engineer (Sale)',
    //     self::TEAM_BD=>"Project Manager (PM)",
    //     self::TEAM_AE=>"Application Engineer (AE)",
    //     self::TEAM_PD=>'Production Engineer (PE)',
    //     self::TEAM_DESIGN=>'Design',
    //     ''=>'Chưa cập nhật'
        
    // ];

    public function getTeamAttribute() : ?string
    {
        // if(isset($this->ds_team[$this->group])) {
        //     return $this->ds_team[$this->group];
        // } else {
        //     return $this->group;
        // }
        if($this->id_nhom_nhan_vien=="") {
            return "";
        }
        
        return $this->nhomNhanVien->ten_nhom;
        
    }


    /**
     * get tong no xau nhan vien chua tru het
     */
    public function tongNoXauCanTru() : float
    {
        $tongNoXau = NoXauThuocNhanVien::where([
            ['id_nhan_vien','=',$this->id],
            ['tien_con_lai','<>',0]
        ])->sum('tien_con_lai');
        return $tongNoXau;
    }

    /**
     * tong doanh thu nhan vien
     */
    public function getTongDoanhThu($dsDonHang) : float 
    {
        $tongDoanhThu = $dsDonHang->sum('doanh_thu');

        return $tongDoanhThu;
    }

    /**
     * so luong don hang
     */
    public function getSoLuongDonHang($dsDonHang) : int 
    {
        return $dsDonHang->count();
    }

    /**
     * ds don hang duoc tinh (da duyet/ da thanh toan)
     */
    public function dsDonHangDuocTinhTrongNam($nam) : Collection 
    {
        $dsDonHang = DonHang::where([
                ['trang_thai','<>',DonHang::TT_HUY],
                ['trang_thai','<>',DonHang::TT_MOI],
                ['id_nhan_vien','=',$this->id],
                
            ])->whereYear('ngay_tao_don',$nam)->get();
        return $dsDonHang;

    }

    /**
     * kiểm tra nhân viên có phải quản lý hay không
     */
    public function laQuanLy() : bool{
        if($this->quanLy) {
            return true;
        } 
        return false;
    }

    /**
     * scope nhan vien chua xoa
     */
    public function scopeHoatDong($query) {
        return $query->where('da_xoa',self::TT_KO_XOA);
    }

    /**
     * scope nhan vien khong la quan ly
     */
    public function scopeDsKhongLaQuanLy($query) {
        return $query->doesnthave('quanLy');
    }

    /**
     * scope nhan vien la quan ly
     */
    public function scopeDsLaQuanLy($query) {
        return $query->has('quanLy');
    }




    CONST NHOM_KY_THUAT = ["AE","SUPERVISOR_CNC","SUPERVISOR_PRODUCTION"];
    CONST NHOM_THUONG_MASTERCAM = ["SUPERVISOR_CNC"];
    CONST NHOM_THUONG_AE = ["AE"];

    /**
     * lay ds nhan vien ky thuat
     */
    public function scopeNhomKyThuat($query) 
    {
        return $query->whereHas('nhomNhanVien',function($query){
            $query->whereIn('ma_nhom',self::NHOM_KY_THUAT);
        });
    } 

    /**
     * check nhan vien co thuoc nhom ky thuat khong
     */
    public function laKyThuat() : bool 
    {
        /**
         * không có nhóm nhân viên thì false
         */
        if(empty($this->id_nhom_nhan_vien))
            return false;

        /**
         * thuộc nhóm ky thuat thi true
         */
        if(in_array($this->nhomNhanVien->ma_nhom,self::NHOM_KY_THUAT)) {
            return true;
        }

        /**
         * khac thi false
         */
        return false;
    }

    /** 
     * * team lap day may
     */
    public function laTeamLapDatThietBi() : bool 
    {
        // if(!empty($this->id_nhom_nhan_vien) && $this->nhomNhanVien->ma_nhom == self::TEAM_AE) 
        //     return true; 
        // return false;
        return $this->thuocNhomThuongLapDat();
    }

    /**
     * kiem tra co thuoc nhom lap dat hay khong
     */
    public function thuocNhomThuongLapDat() : bool
    {
        $dsNhomLapDat = NhomNhanVien::whereIn('ma_nhom',self::NHOM_THUONG_AE)->pluck('id')->toArray();
        return (bool) in_array($this->id_nhom_nhan_vien,$dsNhomLapDat);
    }

    /**
     * kiem tra co thuoc nhom lap dat hay khong
     */
    public function thuocNhomThuongMastercam() : bool
    {
        $dsNhomMastercam = NhomNhanVien::whereIn('ma_nhom',self::NHOM_THUONG_MASTERCAM)->pluck('id')->toArray();
        return (bool) in_array($this->id_nhom_nhan_vien,$dsNhomMastercam);
    }

    
    // lấy list đơn hàng thưởng mở mới
    public function listDonHangThuongMoMoi(){
        return $this->hasMany(DonHangThuongMoMoi::class,'id_nhan_vien','id');
    }

     // thưởng mở mới
     public function thuongMoMoi(){
        return $this->hasMany(ThuongMoMoi::class,'id_nhan_vien','id');
    }

    public function getIDNhanVienThuocTeam(){
        return $this->nhomNhanVien->nhanVienThuocNhom->where('da_xoa',NhanVien::TT_KO_XOA)->pluck('id');
    }

    public function getTongNganSachThuongCuaTeam(){
        if($this->laQuanLy()){
            $tongNganSachThuong=0;
            $listIdNhanVienThuocTeam = $this->getIDNhanVienThuocTeam();
            $listNhanVienThuocTeam=NhanVien::whereIn('id',$listIdNhanVienThuocTeam)
            ->whereNotIn('id',[$this->id])
            ->where('id_nhom_nhan_vien',$this->id_nhom_nhan_vien)
            ->get();
            foreach($listNhanVienThuocTeam as $nhanVien){
               $tongNganSachThuong += $nhanVien->thuongNhanVienTheoThoiGian()
               ->where('loai',ThuongKhoangThoiGian::LOAI_THUONG_NAM)->sum('tong_ngan_sach_thuong');
            }
            return $tongNganSachThuong;
        }
        return 0;
    }

    public function getTongNoXauCuaTeam(){
        if($this->laQuanLy()){
            $tongNoXau=0;
            $listIdNhanVienThuocTeam = $this->getIDNhanVienThuocTeam();
            $listNhanVienThuocTeam=NhanVien::whereIn('id',$listIdNhanVienThuocTeam)
            ->whereNotIn('id',[$this->id])
            ->where('id_nhom_nhan_vien',$this->id_nhom_nhan_vien)
            ->get();
            foreach($listNhanVienThuocTeam as $nhanVien){
                $tongNoXau += $nhanVien->tongNoXauCanTru();
            }
            return  $tongNoXau;
        }
        return 0;
    }

}
