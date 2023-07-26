<?php 
namespace App\Traits;


use App\Jobs\GuiMailChoAdmin;
use App\Jobs\GuiMailXacNhanVATJob;
use App\Mail\GuiMailVeAdmin;
use App\Models\DonHang\DanhMucSanPham;
use App\Models\DonHang\DonHang;
use App\Models\DonHang\LoaiSanPham;
use App\Models\DonHang\SanPhamThuocDonHang;
use App\Models\TiLeThuongTheoNhomSP;
use App\Services\DonHang\DonHangService;
use App\Traits\DonHang\GetDataDHGetfly;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Traits\hasHash;

trait SanPham
{

    use hasHash;
    use GetDataDHGetfly;

    /**
     * load danh muc san pham
     */
    private function _loadDanhMucSanPham($maSanPham,$tenSanPham) : DanhMucSanPham
    {
        $danhMucSanPham = DanhMucSanPham::firstOrNew([
            'ma_san_pham'=>$maSanPham
        ],[
            'id_loai_san_pham' => DanhMucSanPham::ID_DICH_VU
        ]);
        $danhMucSanPham->ten_san_pham = $tenSanPham;
        $danhMucSanPham->save();
        return $danhMucSanPham;
    }

    /**
     * lay ti le tinh thuong san pham theo nhom san pham
     */
    private function _tinhTiLeThuong($donHang,$idNhomNhanVien,$idLoaiSanPham) : float 
    {
        
        if($idNhomNhanVien == null ||  $idLoaiSanPham == null){ 
            return 0;
        }
        // Nếu sản phẩm thuộc Mastercam,khách hàng thuộc nhóm mastercam và mối quan hệ là đại lý thì tỉ lệ thưởng bằng 1%
        $moiQuanHe=$donHang->khachHang->chiTietKhachHang->moiQuanHe;
        $arrIdNhomKH= $donHang->khachHang->chiTietKhachHang->danhSachNhomKH->pluck('id')->toArray();
        $idNhomKHMastercam = config('services.nhom-khach-hang.id_mastercam');
        $idMoiQuanHeDaiLy = config('services.moi-quan-he.id_dai_ly');
        $checkKHMastercam = array_search($idNhomKHMastercam,$arrIdNhomKH);
        if($checkKHMastercam !== false && $moiQuanHe->id == $idMoiQuanHeDaiLy && $idLoaiSanPham == LoaiSanPham::ID_LOAI_MASTERCAM){
            return 1;
        }
        $tiLeTinhThuongSanPham = TiLeThuongTheoNhomSP::where('id_loai_sp',$idLoaiSanPham)->where('id_nhom_nv',$idNhomNhanVien)->first();
        if($tiLeTinhThuongSanPham){
            return $tiLeTinhThuongSanPham->ti_le_thuong;
        }

        return 0;
        
    }

    private function _themSanPham($dsSpThuocDonHang,$donHang){
        
        foreach( $dsSpThuocDonHang as $sanPham){
                $VATSanPham=0;
                $giaVATSP= 0;
            $giaVATSP= $VATSanPham * $sanPham->price /100;
            $arrSP=[
                'product_name'=>$sanPham->product_name,
                'product_code'=>$sanPham->product_code,
                'quantity'=>$sanPham->quantity,
                'price'=>$sanPham->price,
                'vat'=> $VATSanPham,
                'vat_amount'=> $giaVATSP,
                'discount'=>$sanPham->discount,
                'discount_amount'=>$sanPham->discount_amount,
                'amount'=>$sanPham->amount
            ];

            $validate=$this->validateProduct($arrSP);
            // check Sản phẩm xem có chưa,chưa có thì tạo, có rồi thì return ra sản phẩm
            $danhMucSanPham = $this->_loadDanhMucSanPham($validate['product_code'],$validate['product_name']);
            $tiLeTinhThuong = $this->_tinhTiLeThuong($donHang,$donHang->nhanVien->id_nhom_nhan_vien,$danhMucSanPham->id_loai_san_pham);


            $productData = [
                'gia_san_pham' => (float)$validate['price'],
                'gia_ban' => (float)$validate['amount'],
                'so_luong' => $validate['quantity'],
                'id_don_hang'=>$donHang->id,
                'id_san_pham'=>$danhMucSanPham->id,
                'ti_le_thuong'=>$tiLeTinhThuong
            ];
            
            // dd($sanPham);

            $sanPhamThuocDonHang = new SanPhamThuocDonHang();
            $sanPhamThuocDonHang->create($productData);
        }
       
    }

    public function capNhatSanPham($idDonHang){
        $donHang = DonHang::find($idDonHang);
        $donHang->sanPhams()->delete();

        $donHang = DonHang::find($idDonHang);
        $jsonData = $this->getDonHangTuGetFly($donHang->ma_don_hang);

        $dataDonHang=$jsonData->order_info;
        $dataSP=$jsonData->products;

         // Lưu tạm sản phẩm
        $this->_themSanPham($dataSP,$donHang);
        $tongTiLeThuongSanPham=$donHang->sanPhams()->where('gia_san_pham','!=',0)->sum('ti_le_thuong');
        $giaBanTongDonHang=$donHang->sanPhams()->where('gia_san_pham','!=',0)->sum('gia_ban');
        $doanhThuDonHang = $donHang->doanh_thu;

        //  Nếu tổng tỉ lệ thưởng băng 0 thì gửi mail về cho Admin
        if( $tongTiLeThuongSanPham == 0){
            GuiMailChoAdmin::dispatch($donHang);
        }
        
         // Xóa sản phẩm trong đơn hàng chỉ lấy tổng tỉ lệ tính thưởng
        $donHang->sanPhams()->delete();

        
        $phiVanChuyenSauThue=$dataDonHang->transport_amount;
        foreach( $dataSP as $sanPham){
            // Trường hợp nhập VAT ở trên thì lấy theo VAT ở trên

            $giaBanKhongVAT=$sanPham->price *$sanPham->quantity;
            if($sanPham->vat > 0){
                $VATSanPham= $sanPham->vat;
                $giaVATSP = $sanPham->vat_amount;

                $tiLeChietKhau=0;
                $chietKhau=0;
            }else{ 
                // Tránh trường hợp đơn gía = 0
                if($giaBanKhongVAT == 0) {
                    $tiLeChietKhau = 0;
                } else {
                    $tiLeChietKhau = ($giaBanKhongVAT -$sanPham->amount) /$giaBanKhongVAT *100;
                    
                }
                $chietKhau=$tiLeChietKhau * $giaBanKhongVAT / 100;

                // Tìm VAT 
                if($doanhThuDonHang > $giaBanTongDonHang){
                    $VATSanPham = min(10,($doanhThuDonHang - $giaBanTongDonHang -$phiVanChuyenSauThue)/$giaBanTongDonHang *100);
                    
                }else{
                    $VATSanPham = 0;
                }
                $giaVATSP=$VATSanPham * $sanPham->price * $sanPham->quantity /100;
            }

            // Nếu đơn hàng đã xác nhận VAT thì VAT = 0
            // if($donHang->xac_nhan_vat == DonHang::TT_VAT_DA_XAC_NHAN){
            //     $VATSanPham=0;
            //     $giaVATSP= 0;
            // }else{
            //     $VATSanPham=$this->_kiemTraVATSanPham($sanPham);
            //     $giaVATSP= $VATSanPham * $sanPham->price /100;
            // }
            $arrSP=[
                'product_name'=>$sanPham->product_name,
                'product_code'=>$sanPham->product_code,
                'quantity'=>$sanPham->quantity,
                'price'=>$sanPham->price,
                'vat'=> $VATSanPham,
                'vat_amount'=> $giaVATSP,
                'discount'=>$tiLeChietKhau,
                'discount_amount'=>$chietKhau,
                'amount'=>$sanPham->amount
            ];
            
            $validate=$this->validateProduct($arrSP);
            $productData = [
                'gia_san_pham' => (float)$validate['price'],
                'gia_ban' => (float)$validate['amount'],
                'so_luong' => $validate['quantity'],
                'gia_ban_khong_vat'=> (float)$validate['price'] * $validate['quantity'],
                'ti_le_vat'=> (float)$validate['vat'],
                'thue_vat'=> (float)$validate['vat_amount'],
                'ti_le_chiet_khau'=> (float)$validate['discount'],
                'chiet_khau'=> (float)$validate['discount_amount'],
                
                
            ];
           
            // check Sản phẩm xem có chưa,chưa có thì tạo, có rồi thì return ra sản phẩm
            $danhMucSanPham = $this->_loadDanhMucSanPham($validate['product_code'],$validate['product_name']);
            
            // chi phí phát sinh tổng của đơn hàng
            $tongChiPhiPhatSinhTong=$donHang->chi_phi_phat_sinh + $donHang->chi_phi_khac + $donHang->quy_rui_ro;
            $phiVanChuyenCuaDonHang=$donHang->phi_van_chuyen_cua_don_hang;
            
            $tiLeTinhThuong = $this->_tinhTiLeThuong($donHang,$donHang->nhanVien->id_nhom_nhan_vien, $danhMucSanPham->id_loai_san_pham);

            
            $productData['id_san_pham'] =  $danhMucSanPham->id;
            $productData['ti_le_thuong'] = $tiLeTinhThuong;
            $productData['id_don_hang'] =  $idDonHang;

            $sanPham = new SanPhamThuocDonHang();
            $sanPhamThuocDonHang=$sanPham->create($productData);
    
            if($tongTiLeThuongSanPham ==0){
                //
            }else{

                if($sanPhamThuocDonHang->gia_san_pham == 0){
                     $sanPhamThuocDonHang->chi_phi_phat_sinh=0;
                 }else{
                     $sanPhamThuocDonHang->chi_phi_phat_sinh = (float)(($tongChiPhiPhatSinhTong - $phiVanChuyenCuaDonHang ) * $productData['ti_le_thuong'] / $tongTiLeThuongSanPham);
                 }
            }
            
            $sanPhamThuocDonHang->so_tien_tinh_thuong=(float)($productData['gia_ban_khong_vat'] -  $sanPhamThuocDonHang->chi_phi_phat_sinh-$productData['chiet_khau']);
            $sanPhamThuocDonHang->save();
            
            
        }

        // Nếu đơn hàng có VAT bằng 0 thì gửi mail cho Sale xác nhận
        // if($donHang->donHangNotVAT()){
        //     $checkDHPM=false;
        //     // check đơn hàng dịch vụ
        //     foreach($donHang->sanPhams as $sanPham){
        //         if($sanPham->danhMucSanPham->checkSanPhamPM($sanPham->parent)==true){
        //             $checkDHPM =true;
        //         }
        //     }
        //     if($checkDHPM == false && $donHang->xac_nhan_vat == DonHang::TT_VAT_CHUA_XAC_NHAN){
        //         $emailSale=$donHang->nhanVien->user->email;
        //         $token=$donHang->token;
        //         $link=url('/xac-nhan-vat').'/'.$donHang->id.'/'. $emailSale.'/'. $token;
        //        GuiMailXacNhanVATJob::dispatch($donHang,'hanhoai08091996@gmail.com',$link)->delay(now()->addMinute(1)); 
        //     //    Đổi đơn hàng trạng thái VAT sang chờ xác nhận
        //         $donHang->xac_nhan_vat = DonHang::TT_VAT_CHO_XAC_NHAN;
        //         $donHang->save();
        //     }
        // }
        // else{
        //     // Đối với đơn hàng đã có VAT thì xác nhận VAT mặc định là 1
        //     $donHang->xac_nhan_vat = DonHang::TT_VAT_DA_XAC_NHAN;
        //     $donHang->save();
        // }
        // return true;
    }

    protected function validateProduct($data){
        $validate = Validator::make($data, [
            'product_name' => 'required',
            'product_code' => 'required',
            'quantity' => "required",
            'price' => 'required',
            'vat'=>'required',
            'vat_amount'=>'required',
            'discount'=>'required',
            'discount_amount'=>'required',
            'amount' => 'required'
        ])->validated();
        return $validate;
    }

    // protected function _loadSanpham($maSanPham){
    //     $sanPham = DanhMucSanPham::where([
    //         'ma_san_pham' => $maSanPham
    //     ])->first();

    //     return $sanPham;
    // }

    protected function _kiemTraVATSanPham($sanPham){
        if($sanPham->vat == config('services.san-pham.vat_sp_co_dinh')){
            $VATSanPham=$sanPham->vat;
            return $VATSanPham;
        }else{
            //Tìm sản phẩm trong danh mục sản phẩm
            $findSanPham=DanhMucSanPham::where('ma_san_pham',$sanPham->product_code)->first();
            // check xem sản phẩm cho thuộc loại phần mềm không??
            $checkSanPhamPM=($findSanPham->checkSanPhamPM());
            if($checkSanPhamPM){
                $VATSanPham=0;
                return $VATSanPham;
            }else{
                $VATSanPham=10;//VAT sp theo năm
                return $VATSanPham;
            }
        }
    }
}