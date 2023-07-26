<?php

namespace App\Models\CongThuc;

use App\Models\NhanVien;
use Illuminate\Database\Eloquent\Model;
use App\Models\NhatKyCapNhatHeThong;
use App\Models\Thuong\KetQuaTinhThuong;
use App\Models\Thuong\ThuongNhanVien;
use App\Scopes\HaveOrderScope;
use App\Traits\CoNguoiTao;
use App\Traits\ThuocNhomNhanVien;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CongThucTinh extends Model
{
    // use HasFactory;
    use CoNguoiTao;
    use ThuocNhomNhanVien;

    const REG = "/chitieu:\d+|\+|\-|\*|\/|bien:\d+|congthuc:\d+/";
    const CASE_REG = "/case:\d+(?:\(\d+:\d+\))+/";
    CONST MUC_TIEU_DOANH_SO_NAM_REG = "/MUC_TIEU_DOANH_SO_CA_NAM|DOANH_SO_CONG_DON/";
    CONST MUC_TIEU_DOANH_SO_QUY_REG = "/MUC_TIEU_DOANH_SO_QUY|DOANH_SO_CONG_DON/";
    
    const LA_CONG_THUC_CHINH = 1;
    const LA_CONG_THUC_PHU = 0;

    const TT_DANG_SU_DUNG = 1;
    const TT_KHONG_SU_DUNG = 0;

    CONST LOAICT_CHINH = 1;
    CONST LOAICT_CHAN_DOANH_THU = 2;
    CONST LOAICT_DOANH_THU_QUY = 3;
    CONST LOAICT_DOANH_THU_NAM = 4;

    CONST LOAICT_TONG_CHI_TIEU = 8;
    CONST LOAICT_CHI_TIEU = 9;

    public $dsLoaiCongThuc = [
        self::LOAICT_CHINH => 'Công thức chính',
        self::LOAICT_CHAN_DOANH_THU => 'Công thức chặn doanh thu',
        self::LOAICT_DOANH_THU_QUY => 'Công thức tính doanh thu cộng dồn quý',
        self::LOAICT_DOANH_THU_NAM => 'Công thức tính doanh thu cộng dồn năm',
        self::LOAICT_TONG_CHI_TIEU => 'Công thức tổng tỷ trọng của chỉ tiêu',
        self::LOAICT_CHI_TIEU => 'Công thức tính tỷ trọng chỉ tiêu'
    ];

    protected $table = 'cms___cong_thuc_tinh';

    protected $fillable = [
        'ten_cong_thuc',
        'noi_dung',
        'mo_ta',
        'dang_su_dung',
        'id_cong_thuc_cha',
        'la_cong_thuc_chinh',
        'id_nhom_nhan_vien',
        'thu_tu_sap_xep',
        'id_phien_ban_cu',
        'phien_ban',
        'loai'
    ];

    public function danhSachBienSo()
    {
        return $this->belongsToMany(DanhSachBienSo::class, 'cms___bien_so_thuoc_cong_thuc', 'id_cong_thuc', 'id_bien_so');
    }

    public function thongTinCapNhats()
    {
        return $this->morphMany(NhatKyCapNhatHeThong::class, 'thongTinCapNhat', 'ten_model_thay_doi', 'id_model_thay_doi', 'id');
    }


    public function danhSachChiTieu()
    {
        return $this->belongsToMany(DanhSachChiTieu::class, 'cms___chi_tieu_thuoc_cong_thuc', 'id_cong_thuc', 'id_chi_tieu');
    }

    public function congThucCon()
    {
        return $this->hasMany(CongThucTinh::class, 'id_cong_thuc_cha', 'id');
    }

    public function congThucCha()
    {
        return $this->belongsTo(CongThucTinh::class, 'id_cong_thuc_cha', 'id');
    }

    public function ketQuaTinhThuong()
    {
        return $this->hasMany(KetQuaTinhThuong::class, 'cms___ket_qua_tinh_thuong', 'id_cong_thuc', 'id');
    }

    public function hangMucDungCongThuc()
    {
        return $this->belongsToMany(DanhSachHangMucThuong::class, 'cms___ket_qua_tinh_thuong', 'id_cong_thuc', 'id_hang_muc');
    }

    public function thuongNhanVienDungCongThuc()
    {
        return $this->belongsToMany(ThuongNhanVien::class, 'cms___ket_qua_tinh_thuong', 'id_cong_thuc', 'id_thuong_nhan_vien');
    }

   


    protected static function booted()
    {
        // static::addGlobalScope(new HaveOrderScope);
        static::creating(function ($congThucTinh) {
            $congThucTinh->id_nguoi_tao = auth()->user()->id;
            //truong hop cong thuc co ngansachthuong thi la cong thuc chinh
            if (preg_match("/ngansachthuong/", $congThucTinh->noi_dung, $idDieuKien)) {
                $congThucTinh->la_cong_thuc_chinh = self::LA_CONG_THUC_CHINH;
            } else {
                $congThucTinh->la_cong_thuc_chinh = self::LA_CONG_THUC_PHU;
            }
            $congThucTinh->loai = $congThucTinh->_checkLoaiCongThuc();
        });
        

        static::updated(function($congThucTinh) {
            if($congThucTinh->isDirty('id_nhom_nhan_vien')) {
                foreach($congThucTinh->congThucCon as $congThucCon) {
                    $congThucCon->update([
                        'id_nhom_nhan_vien'=>$congThucTinh->id_nhom_nhan_vien
                    ]);
                }
            }
            
        });

        static::deleting(function($congThucTinh) {
            if(!empty($congThucTinh->ketQuaTinhThuong)) {
                foreach($congThucTinh->ketQuaTinhThuong as $ketQuaTinhThuong) {
                    $ketQuaTinhThuong->delete();
                }
            }

            if(!empty($congThucTinh->congThucCon)) {
                foreach($congThucTinh->congThucCon as $congThucCon) {
                    $congThucCon->delete();
                }
            }

            $congThucTinh->danhSachBienSo()->detach();
            $congThucTinh->hangMucDungCongThuc()->detach();
            $congThucTinh->danhSachChiTieu()->detach();
            $congThucTinh->thuongNhanVienDungCongThuc()->detach();
            
        });
    }

   

    /**
     * lay cong thuc tinh phien ban cu
     */
    public function phienBanCu() : BelongsTo
    {
        return $this->belongsTo(CongThucTinh::class,'id_phien_ban_cu','id');
    }

    /**
     * lay cong thuc tinh phien ban moi
     */
    public function phienBanMoi() : HasOne
    {
        return $this->hasOne(CongThucTinh::class,'id_phien_ban_cu','id');
    }
    

    //lấy trạng thái có style
    public function getTrangThai()
    {
        if ($this->dang_su_dung == self::TT_DANG_SU_DUNG) {
            return '<span class="badge bg-gradient-info">Bật</span>';
        } else {
            return '<span class="badge bg-gradient-danger">Tắt</span>';
        }
    }

    /**
     * cap nhat loai cong thuc
     */
    public function setLoaiCongThuc() : void 
    {
        $this->loai = $this->_checkLoaiCongThuc();
        $this->save();
    }

    private function _checkLoaiCongThuc() : int 
    {
        if($this->la_cong_thuc_chinh) {
            return self::LOAICT_CHINH;
        }

        if(strpos($this->noi_dung,'MUC_TIEU_DOANH_SO_QUY')) {
            return self::LOAICT_DOANH_THU_QUY;
        }

        if(strpos($this->noi_dung,'MUC_TIEU_DOANH_SO_QUY')) {
            return self::LOAICT_DOANH_THU_QUY;
        }

        if(strpos($this->noi_dung,'case')) {
            return self::LOAICT_CHAN_DOANH_THU;
        }

        $reg = '/^\{congthuc:\d+\}(\s*[+-]\s*\{congthuc:\d+\})+$/mi';
        if(preg_match($reg,trim($this->noi_dung))) {
            return self::LOAICT_TONG_CHI_TIEU;
        }

        return self::LOAICT_CHI_TIEU;
    }

    //lấy loại công thức chính/phụ có style
    public function getLoaiCongThuc()
    {
        if ($this->la_cong_thuc_chinh == self::LA_CONG_THUC_CHINH) {
            return '<span class="badge bg-gradient-primary">Công thức chính</span>';
        } else {
            return '<span class="badge bg-gradient-secondary">Công thức phụ</span>';
        }
    }

    /**
     * lấy style cho id cong thuc cha
     * null thì hiện là công thức chính
     */
    public function getCongThucChaFormat()
    {
        if ($this->la_cong_thuc_chinh == self::LA_CONG_THUC_CHINH) {
            return '<span class="badge bg-gradient-primary">Công thức chính</span>';
        } else {
            return $this->id_cong_thuc_cha;
        }
    }

    public function checkCongThucTongTyTrong() {
        return $this->loai == self::LOAICT_TONG_CHI_TIEU;
    }
}
