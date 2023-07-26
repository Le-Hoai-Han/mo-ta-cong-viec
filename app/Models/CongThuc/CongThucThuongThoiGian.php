<?php

namespace App\Models\CongThuc;

use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Traits\CongThucTuongUngTrait;
use App\Traits\SuDungCongThuc;
use App\Traits\SuDungCongThucThoiGianTrait;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CongThucThuongThoiGian extends Model
{
    use HasFactory;
    use SuDungCongThucThoiGianTrait;

    protected $table = 'cms___cong_thuc_thuong_theo_thoi_gian';


    public $fillable = [
        'id_thuong_thoi_gian',
        'id_cong_thuc_tinh',
        'mo_ta',
        'noi_dung_cong_thuc',
        'noi_dung_tinh',
        'ket_qua_tinh'
    ];


    public function congThucTinh() : BelongsTo
    {
        return $this->belongsTo(CongThucTinh::class,'id_cong_thuc_tinh','id');
    }

    public function thuongThoiGian() : BelongsTo
    {
        return $this->belongsTo(ThuongKhoangThoiGian::class,'id_thuong_thoi_gian','id');
    }

    static protected function booted() {
        parent::booted();
        self::created(function($congThucThoiGian) {
            $congThucTinh = $congThucThoiGian->congThucTinh;
            foreach($congThucTinh->congThucCon as $congThuc) {
                self::createCongThucThoiGian($congThuc,$congThucThoiGian->id_thuong_thoi_gian);
            }
        });

    }

    static public function createCongThucThoiGian(CongThucTinh $congThuc,int $idThuongThoiGian) : void 
    {
        $thuongThoiGian=ThuongKhoangThoiGian::find($idThuongThoiGian);
        $congThucThoiGian = self::firstOrNew([
            'id_thuong_thoi_gian'=>$idThuongThoiGian,
            'id_cong_thuc_tinh'=>$congThuc->id
        ],[
            'mo_ta'=>$congThuc->mo_ta,
            'noi_dung_cong_thuc'=>$congThuc->noi_dung,
            'noi_dung_tinh'=>'',
            'ket_qua_tinh'=>0
        ]);
        $congThucThoiGian->save();
    }


    //cach tinh dua vao noi dung cong thuc
    public function suDungCongThuc()
    {
        // $dsChiTieu = [];
        $noiDungCongThuc = $this->congThucTinh->noi_dung;
        // $idNhanVien = $this->thuongNhanVien->id_nhan_vien;
        // $idNhomNhanVien = $this->thuongNhanVien->nhanVien->id_nhom_nhan_vien;
        // $thangNam = $this->thuongNhanVien->thangNam;
        // $idNamThang = $this->thuongNhanVien->id_thang_nam;
        
        //thay the {congthuc:x} thanh gia tri
        $noiDungCongThuc = $this->_thayTheCongThucCon($noiDungCongThuc,$this->id_thuong_thoi_gian);    
        

        //thay the {chitieu:x} thanh gia tri
        $noiDungCongThuc = $this->_thaytheChiTieuCongThuc($noiDungCongThuc,$this->congThucTinh,$this->id_thuong_thoi_gian);

        //thay the {bienso:x} thanh gia tri
        $noiDungCongThuc = $this->_thayTheBienSoCongThuc($noiDungCongThuc,$this->congThucTinh);

        //thay the case
        $noiDungCongThuc = $this->_thayTheCongThucDieuKien($noiDungCongThuc,$this->id_thuong_thoi_gian);
      

        /**
         * thay the cong thuc con cua k2
         */
        $noiDungCongThuc = $this->_thayTheCongThucCongDon($noiDungCongThuc,$this->thuongThoiGian);

        
       $noiDungCongThuc = $this->_thayTheCongThucChinh($noiDungCongThuc,$this->congThucTinh,$this->thuongThoiGian);

        $this->_luuNoiDungTinh($noiDungCongThuc);
        
        try{
            $evaluator = new \Matex\Evaluator;
            $ketQua = $evaluator->execute($noiDungCongThuc);
            // dd($ketQua);
            return $ketQua;
        }catch(Exception $e) {
            echo "error: ";
            echo $e->getMessage();
            
            echo "Nội dung công thức: $noiDungCongThuc";
            echo 1;
        }
    }

    

    /**
     * dung để luu ket qua vao db
     */
    public function tinhKetQua() : CongThucThuongThoiGian
    {
        $ketQuaTinh = round($this->suDungCongThuc(),3);
        $this->ket_qua_tinh = $ketQuaTinh;
        $this->save();

        if($this->congThucTinh->la_cong_thuc_chinh) {
            // dd($thuongHangMuc);
            $this->thuongThoiGian->tong_tien_thuong_dat_duoc = $ketQuaTinh;
            $this->thuongThoiGian->save();
        } 

        $this->refresh();

        return $this;
        
    }

    

    // tinh ham case trong cong thuc K2
    // public function _tinhDieuKien($chuoiDieuKien, $idNhanVien, $idNamThang)
    // {
    //     // if(preg_match(self::CASE_REG,$noiDung,$match)) {
    //     //     $chuoiDieuKien = $match[0];

    //     $giaTriCongThuc = 0;
    //     $giaTriDieuKien = 0;
           

    //     if (preg_match("/case:\d+/", $chuoiDieuKien, $idDieuKien)) {
    //         $idCongThuc = str_replace("case:", "", $idDieuKien[0]);
    //         // var_dump($idCongThuc);


    //         $congThucThoiGian = $this->_loadCongThucThoiGian($idCongThuc,)
    //         // dd($ketQuaCongThuc);
    //         if ($ketQuaCongThuc !== null) {
    //             $ketQuaCongThuc->tinhKetQua();
    //             $ketQuaCongThuc->refresh();
    //             $giaTriCongThuc = $ketQuaCongThuc->ket_qua_tinh;
    //         } else {
    //             $giaTriCongThuc = 0;
    //         }

    //         // echo $idCongThuc . " - " . $ketQuaCongThuc->noi_dung_cong_thuc . " - " . $giaTriCongThuc . ";";
    //     }
        
    //     if (preg_match_all("/(\d+):(\d+)/", $chuoiDieuKien, $mangDieuKienGoc)) {
    //         $mangDieuKien = array_combine($mangDieuKienGoc[1], $mangDieuKienGoc[2]);
    //         foreach ($mangDieuKien as $ketQua => $dieuKien) {
    //             if (($giaTriCongThuc) >= $dieuKien) {
    //                 $giaTriDieuKien = $ketQua ;
    //                 break;
    //             }
    //         }
    //     }
    //     // dd($giaTriDieuKien);
    //     // echo $giaTriDieuKien;
    //     // dd($giaTriDieuKien);
    //     return $giaTriDieuKien;
    //     // return $caseArray;
    //     // }

    // }

    
}
