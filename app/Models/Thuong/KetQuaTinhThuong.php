<?php

namespace App\Models\Thuong;

use App\Models\CongThuc\ChiTieuCaNhan;
use App\Models\CongThuc\CongThucTinh;
use App\Models\DanhMucThangNam;
use App\Models\Thuong\ThuongNhanVien;
use App\Traits\ThuocCongThuc;
use App\Traits\ThuocHangMuc;
use App\Traits\ThuongMoMoiTrait;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class KetQuaTinhThuong extends Model
{
    use HasFactory;
    use ThuocCongThuc;
    use ThuocHangMuc;
    use ThuongMoMoiTrait;

    protected $table = "cms___ket_qua_tinh_thuong";
    protected $fillable = [
        'id_cong_thuc',
        'id_thuong_nhan_vien',
        'id_hang_muc',
        'noi_dung_cong_thuc',
        'ket_qua_tinh'
    ];

    public function thuongNhanVien()
    {
        return $this->belongsTo(ThuongNhanVien::class, 'id_thuong_nhan_vien', 'id');
    }

    protected static function booted()
    {
        /**
         * dung thay cho truong hop created va updated vi ca 2 deu chay lai phan nay
         * updated khi khong thay doi attribute (dirty) thi se khong chay duoc
         */
        static::saved(function($ketQuaTinhThuong) {
            
            $congThucGoc = $ketQuaTinhThuong->congThuc;
            $ketQuaTinhThuong->_themCongThucCon($ketQuaTinhThuong, $congThucGoc);
        });
    }

    private function _themCongThucCon($ketQuaTinhThuong, $congThucGoc) : void
    {
        $congThucCon = $congThucGoc->congThucCon;
        // Log::debug("ketquatinhthuong:" . $ketQuaTinhThuong->id . "- cong thuc goc: " . $congThucGoc->id);

        if ($congThucCon->isNotEmpty()) {
            foreach ($congThucCon as $congThuc) {
                
                //check va them cong thuc con cua cong thuc hien tai
                $ketQuaTinhThuongMoi = KetQuaTinhThuong::firstOrNew([
                    'id_thuong_nhan_vien'=>$ketQuaTinhThuong->id_thuong_nhan_vien,
                    'id_hang_muc'=>$ketQuaTinhThuong->id_hang_muc,
                    'id_cong_thuc'=>$congThuc->id
                ]);
                
                $ketQuaTinhThuongMoi->saveQuietly();

                $ketQuaTinhThuongMoi->_themCongThucCon($ketQuaTinhThuongMoi, $congThuc);
            }
        }
    }

    // private function _tinhCongThucCon($congThucTinh)
    // {
    //     if ($congThucTinh->congThucCon->isNotEmpty()) {
    //         $congThucCon = $congThucTinh->congThucCon;
    //         foreach ($congThucCon as $congThuc) {
    //             $idCongThuc = $congThuc->id;
    //             // $giaTriCongThuc = $congThuc->suDungCongThuc();
    //             $ketQuaCongThucCon = KetQuaTinhThuong::where([
    //                 'id_cong_thuc' => $idCongThuc,
    //             ])->whereHas('thuongNhanVien', function ($query) use ($idNhanVien, $idNamThang) {
    //                 $query->where([
    //                     'id_nhan_vien' => $idNhanVien,
    //                     'id_thang_nam' => $idNamThang
    //                 ]);
    //             })->first();
    //             $ketQuaCongThucCon->tinhKetQua();
    //             $ketQuaCongThucCon->refresh();

    //             $giaTriCongThuc = $ketQuaCongThucCon->ket_qua_tinh;

    //             $noiDungCongThuc = str_replace('{congthuc:' . $idCongThuc . '}', $giaTriCongThuc, $noiDungCongThuc);
    //         }
    //     }
    // }

    //cach tinh dua vao noi dung cong thuc
    public function suDungCongThuc()
    {
        // $dsChiTieu = [];
        $noiDungCongThuc = $this->congThuc->noi_dung;
        $idNhanVien = $this->thuongNhanVien->id_nhan_vien;
        $idNhomNhanVien = $this->thuongNhanVien->nhanVien->id_nhom_nhan_vien;
        $thangNam = $this->thuongNhanVien->thangNam;
        $idNamThang = $this->thuongNhanVien->id_thang_nam;
        
            if (preg_match_all('/congthuc:\d+/', $noiDungCongThuc, $congThucCon)) {
                $congThucConID = str_replace('congthuc:', '', $congThucCon[0]);
                $congThucCon = CongThucTinh::whereIn('id', $congThucConID)->get();

                if ($congThucCon !== null) {
                    foreach ($congThucCon as $congThuc) {
                        $idCongThuc = $congThuc->id;
                        // $giaTriCongThuc = $congThuc->suDungCongThuc();
                        $ketQuaCongThucCon = KetQuaTinhThuong::where([
                            'id_cong_thuc' => $idCongThuc,
                        ])->whereHas('thuongNhanVien', function ($query) use ($idNhanVien, $idNamThang) {
                            $query->where([
                                'id_nhan_vien' => $idNhanVien,
                                'id_thang_nam' => $idNamThang
                            ]);
                        })->first();
                        try{
                            if ($ketQuaCongThucCon !== null) {
                                $ketQuaCongThucCon->tinhKetQua();
                                $ketQuaCongThucCon->refresh();

                                $giaTriCongThuc = $ketQuaCongThucCon->ket_qua_tinh;

                            } else {
                                $giaTriCongThuc = 0;
                            }
                        }catch(Exception $e) {
                            echo "error: ".$e->getMessage();
                            
                            dd($ketQuaCongThucCon);
                        }


                        $noiDungCongThuc = str_replace('{congthuc:' . $idCongThuc . '}', $giaTriCongThuc, $noiDungCongThuc);
                        // echo $idCongThuc . " - " . $congThuc->noi_dung . " - " . $giaTriCongThuc . ";";
                    }
                }
            }
        




        if ($this->congThuc->danhSachChiTieu->isNotEmpty()) {
            foreach ($this->congThuc->danhSachChiTieu as $chiTieu) {
                $chiTieuCaNhan = $chiTieu->danhSachChiTieuCaNhan()->where([
                    'id_nhan_vien' => $idNhanVien,
                    'id_thang_nam' => $idNamThang
                ])->first();
                // $dsChiTieu[$chiTieu->id] = "chitieu:".$chiTieu->id.".";
                $noiDungCongThuc = str_replace("{chitieu:" . $chiTieu->id . "}", $chiTieuCaNhan->ti_le_dat_duoc, $noiDungCongThuc);
            }
        }


        if ($this->congThuc->danhSachBienSo->isNotEmpty()) {
            foreach ($this->congThuc->danhSachBienSo as $bienSo) {
                $noiDungCongThuc = str_replace("{bien:" . $bienSo->id . "}", $bienSo->gia_tri, $noiDungCongThuc);
                // $dsBienSo[$bienSo->id] = "bien:".$bienSo->id;
            }
        }

        //neu trong cong thuc co case
        if (preg_match(CongThucTinh::CASE_REG, $noiDungCongThuc, $mangDieuKien)) {
            $chuoiDieuKien = $mangDieuKien[0];
            $giaTriDieuKien = $this->_tinhDieuKien($chuoiDieuKien, $idNhanVien, $idNamThang);
            $noiDungCongThuc = str_replace("{" . $chuoiDieuKien . "}", $giaTriDieuKien, $noiDungCongThuc);
        }
        // return $noiDungCongThuc;

        //tinh doanh so cong don ca nam
        // if(preg_match(CongThucTinh::MUC_TIEU_DOANH_SO_NAM_REG,$noiDungCongThuc)) {
        //     ddd('loi ket qua tinh thuong cong don');
        //     // can edit cho này
        //     $mucTieuNam = ThuongNamNhanVien::getMucTieuDoanhSoNam($idNhanVien,$this->thuongNhanVien->thangNam->nam,$idNhomNhanVien);

        //     $doanhSoCongDon = ChiTieuCaNhan::getDoanhSoCongDonTheoThang($idNamThang,$idNhanVien,$idNhomNhanVien);
        //     // echo "thangNam $idNamThang";
        //     // echo "Mục tieu: $mucTieuNam - doanh so cong don: $doanhSoCongDon";
        //     $noiDungCongThuc = str_replace('{MUC_TIEU_DOANH_SO_CA_QUY}',$mucTieuNam,$noiDungCongThuc);
        //     $noiDungCongThuc = str_replace('{DOANH_SO_CONG_DON}',$doanhSoCongDon,$noiDungCongThuc);
        // }

        //thay cong thuc tinh doanh so cong don theo quy
       /*if(preg_match(CongThucTinh::MUC_TIEU_DOANH_SO_QUY_REG,$noiDungCongThuc)) {
            // can edit cho này
            $mucTieuNam = ThuongKhoangThoiGian::getMucTieuDoanhSoQuy($idNhanVien,$thangNam->thang, $thangNam->nam,$idNhomNhanVien);

            // $doanhSoCongDon = ChiTieuCaNhan::getDoanhSoCongDonTheoThang($idNamThang,$idNhanVien,$idNhomNhanVien);
            // // echo "thangNam $idNamThang";
            // // echo "Mục tieu: $mucTieuNam - doanh so cong don: $doanhSoCongDon";
            // $noiDungCongThuc = str_replace('{MUC_TIEU_DOANH_SO_QUY}',$mucTieuNam,$noiDungCongThuc);
            // $noiDungCongThuc = str_replace('{DOANH_SO_CONG_DON}',$doanhSoCongDon,$noiDungCongThuc);
        }*/
        $noiDungCongThuc = KetQuaTinhThuong::thayCongThucTinhDoanhSoCongDonTheoQuy($noiDungCongThuc,$idNhanVien,$idNhomNhanVien,$thangNam);
        if ($this->congThuc->la_cong_thuc_chinh) {
            if (preg_match('/ngansachthuong/', $noiDungCongThuc)) {
                $thuongNhanVien = $this->thuongNhanVien;
                $noiDungCongThuc = str_replace('{ngansachthuong}', $thuongNhanVien->ngan_sach_thuong, $noiDungCongThuc);
            }

            if (preg_match('/thuongmomoi/', $noiDungCongThuc)) {
                $thuongNhanVien = $this->thuongNhanVien;
                $idThangNamBatDau=$this->__idThangNamBDThuongMoMoi();
                $thuongMoMoi=0;
               
                if($idThangNamBatDau != null){
                    $thuongMoMoi = $this-> __tienThuongMoMoiCaNhan($thuongNhanVien,$thuongNhanVien->nhanVien,'thang');
                }

                $noiDungCongThuc = str_replace('{thuongmomoi}',$thuongMoMoi, $noiDungCongThuc);
            }
            // dd($noiDungCongThuc);
        }
        // echo "Nội dung công thức: $noiDungCongThuc";
        $this->_luuNoiDungTinh($noiDungCongThuc);
        try{
            $evaluator = new \Matex\Evaluator;
            
            return $evaluator->execute($noiDungCongThuc);
        }catch(Exception $e) {
            echo "error: ";
            echo $e->getMessage();
            
            echo "Nội dung công thức: $noiDungCongThuc";
            echo 1;
        }
    }

    /**
     * luu them cot noi dung tinh
     */
    private function _luuNoiDungTinh($noiDungCongThuc) : void
    {
        $this->noi_dung_tinh = $noiDungCongThuc;
        $this->saveQuietly();
    }

    /**
     * tach phan thay cong thuc cong don quy ra rieng
     */
    static public function thayCongThucTinhDoanhSoCongDonTheoQuy(string $noiDungCongThuc,int $idNhanVien,int $idNhomNhanVien,DanhMucThangNam $thangNam) : string
    {
        if(preg_match(CongThucTinh::MUC_TIEU_DOANH_SO_QUY_REG,$noiDungCongThuc)) {
            // can edit cho này
            $mucTieuNam = ThuongKhoangThoiGian::getMucTieuDoanhSoQuy($idNhanVien,$thangNam->thang, $thangNam->nam,$idNhomNhanVien);
            $doanhSoCongDon = ChiTieuCaNhan::getDoanhSoCongDonTheoThang($thangNam->id,$idNhanVien,$idNhomNhanVien);
            // $doanhSoCongDon = ChiTieuCaNhan::getDoanhSoCongDonTheoThang($idNamThang,$idNhanVien,$idNhomNhanVien);
            // // echo "thangNam $idNamThang";
            // // echo "Mục tieu: $mucTieuNam - doanh so cong don: $doanhSoCongDon";
            $noiDungCongThuc = str_replace('{MUC_TIEU_DOANH_SO_QUY}',$mucTieuNam,$noiDungCongThuc);
            $noiDungCongThuc = str_replace('{DOANH_SO_CONG_DON}',$doanhSoCongDon,$noiDungCongThuc);         
            // dd($mucTieuNam);     
        }
        
        return $noiDungCongThuc;

    }

    //dung để luu ket qua vao db
    public function tinhKetQua()
    {
        // dd($this);
       
            $ketQuaTinh = KetQuaTinhThuong::find($this->id);

            $ketQuaTinh->noi_dung_cong_thuc = $this->congThuc->noi_dung;
            // try{
                $ketQuaTinh->ket_qua_tinh = round($ketQuaTinh->suDungCongThuc(),3);
            // }catch(Exception $e) {
            //     echo $e->getMessage();
            //     dd($this);
            // }
            $ketQuaTinh->save();
            if($ketQuaTinh->congThuc->la_cong_thuc_chinh) {
                $thuongHangMuc = ThuongNhanVienTheoHangMuc::where([
                    ['id_hang_muc','=',$ketQuaTinh->id_hang_muc],
                    ['id_thuong_nhan_vien','=',$ketQuaTinh->id_thuong_nhan_vien],
                ])->first();
                // dd($thuongHangMuc);
                $thuongHangMuc->so_tien_thuong = $ketQuaTinh->ket_qua_tinh;
                $thuongHangMuc->save(); 
                
            
        } 

        //$ketQuaTinh->refresh();
        // dd($ketQuaTinh);
        // dd($ketQuaTinh);
    }

    //tinh ham case trong cong thuc
    public function _tinhDieuKien($chuoiDieuKien, $idNhanVien, $idNamThang)
    {
        // if(preg_match(self::CASE_REG,$noiDung,$match)) {
        //     $chuoiDieuKien = $match[0];

        $giaTriCongThuc = 0;
        $giaTriDieuKien = 0;
           

        if (preg_match("/case:\d+/", $chuoiDieuKien, $idDieuKien)) {
            $idCongThuc = str_replace("case:", "", $idDieuKien[0]);
            // var_dump($idCongThuc);


            $ketQuaCongThuc = KetQuaTinhThuong::where([
                'id_cong_thuc' => $idCongThuc,
            ])->whereHas('thuongNhanVien', function ($query) use ($idNhanVien, $idNamThang) {
                $query->where([
                    'id_nhan_vien' => $idNhanVien,
                    'id_thang_nam' => $idNamThang
                ]);
            })->first();
            // dd($ketQuaCongThuc);
            if ($ketQuaCongThuc !== null) {
                $ketQuaCongThuc->tinhKetQua();
                $ketQuaCongThuc->refresh();
                $giaTriCongThuc = $ketQuaCongThuc->ket_qua_tinh;
            } else {
                $giaTriCongThuc = 0;
            }

            // echo $idCongThuc . " - " . $ketQuaCongThuc->noi_dung_cong_thuc . " - " . $giaTriCongThuc . ";";
        }
        
        if (preg_match_all("/(\d+):(\d+)/", $chuoiDieuKien, $mangDieuKienGoc)) {
            $mangDieuKien = array_combine($mangDieuKienGoc[1], $mangDieuKienGoc[2]);
            foreach ($mangDieuKien as $ketQua => $dieuKien) {
                if (($giaTriCongThuc) >= $dieuKien) {
                    $giaTriDieuKien = $ketQua ;
                    break;
                }
            }
        }
        // dd($giaTriDieuKien);
        // echo $giaTriDieuKien;
        // dd($giaTriDieuKien);
        return $giaTriDieuKien;
        // return $caseArray;
        // }
    }
}
