<?php 

namespace App\Services\DonHang;

use App\Models\DonHang\DanhMucSanPham;
use App\Models\DonHang\DonHangGetFly;
use App\Models\DonHang\SanPhamThuocDonHang;
use App\Models\DonHang\ThanhToanThuocDonHang;
use App\Models\NhanVien;
use App\Traits\ParseDataKH;

class DonHangGetFlyService 
{
use ParseDataKH;
    /**
     * format du lieu tu getfly
     */
    public function getDataFromGetfly($dataGetfly) 
    {
       // don hang
        $orderInfo = $dataGetfly['order_info'];
        $orderCode= $orderInfo['order_code'];

        // san pham
        $productInfo = $dataGetfly['products'];

        // thanh toan 
        $payments = $dataGetfly['payments'];

        // khách hàng
        $idKhachHang=$orderInfo['account_id'];
        $khachHang=$this->getDataShowKH( $idKhachHang);

        // Tính doanh so; 
        $doanhSo =0;
        $tongVAT = 0;
        $tongChietKhau = 0;
        $tongThanhToan = 0;
        
        foreach($productInfo as $product){
            //    $doanhSo +=$product['amount'];
            $doanhSo += $product['price']*(int)$product['quantity'];
            $tongVAT += $product['vat_amount'];
            $tongChietKhau += $product['discount_amount'];
        }
        foreach($payments as $pay){
            $tongThanhToan+= $pay['amount'];
        }

        $orderInfo['tong_vat']=$tongVAT;
        $orderInfo['tong_chiet_khau']=$tongChietKhau;
        //    $orderInfo['doanh_so']=$doanhSo - $orderInfo['tong_vat']+$orderInfo['tong_chiet_khau'];
        $orderInfo['doanh_so'] = $doanhSo;  

        return [
            'orderInfo' =>  $orderInfo,
            'productInfo' =>$productInfo,
            'doanhSo' =>$orderInfo['doanh_so'],
            'tongVAT' =>$orderInfo['tong_vat'],
            'orderCode'=> $orderCode,
            'payments'=> $payments,
            'tongThanhToan'=> $tongThanhToan,
            'khachHang'=>$khachHang['khachHang']
        ];

    }

    

    /**
     * them mới thong tin san pham thuoc don hang
     */
    public function themMoiSanPhamThuocDonHang(DonHangGetFly $donHang, array $danhSachSanPham) : void 
    {
        $this->_luuSanPhamThuocDonHang($donHang,$danhSachSanPham);        
    }

    /**
     * luu thong tin cap nhat san pham thuoc don hang
     */
    public function capNhatSanPhamThuocDonHang(DonHangGetFly $donHang, array $danhSachSanPham) : void 
    {
        $this->_xoaSanPhamThuocDonHang($donHang);
        $this->_luuSanPhamThuocDonHang($donHang,$danhSachSanPham);        
    }

    private function _luuSanPhamThuocDonHang(DonHangGetFly $donHang, array $danhSachSanPham) : void 
    {
        // Lưu thông tin sản phẩm
        foreach($danhSachSanPham as $sanPham){
            // $sanPhamThuocDanhMuc = DanhMucSanPham::where('ma_san_pham',$product['product_code'])->first();
            $sanPhamThuocDanhMuc = $this->_layThongTinSanPhamTrongDanhMuc($sanPham['product_code']);
            if(empty($sanPhamThuocDanhMuc)){
                $sanPhamThuocDanhMuc = $this->_themSanPhamThuocDanhMuc($sanPham['product_code'],$sanPham['product_name']);
            }

            // Lưu sản phẩm thuộc đơn hàng
            $this->_themSanPham($donHang->id, $sanPhamThuocDanhMuc->id, $sanPham['price'], $sanPham['amount'],$sanPham['quantity']);
            
        }
    }

    private function _xoaSanPhamThuocDonHang(DonHangGetfly $donHang) : void 
    {
        //xoa cac san pham cu thuoc don hang
        foreach($donHang->sanPhams as $sanPham){
            $sanPham->delete();
            // $sanPham->save();
        }
    }

    /**
     * them moi thong tin thanh toan thuoc don hang
     */
    public function themMoiThanhToanThuocDonHang(DonHangGetFly $donHang, array $danhSachThanhToan) : void 
    {
        
        $this->_luuThanhToanThuocDonHang($donHang,$danhSachThanhToan);
    }

    /**
     * luu thong tin cap nhat thanh toán thuộc đơn hàng
     */
    public function capNhatThanhToanThuocDonHang(DonHangGetFly $donHang, array $danhSachThanhToan) : void 
    {
        
        $this->_xoaThanhToanThuocDonHang($donHang);
        $this->_luuThanhToanThuocDonHang($donHang,$danhSachThanhToan);
    }

    /**
     * xoa tat ca cac thanh toan thuoc don hang
     */
    private function _xoaThanhToanThuocDonHang(DonHangGetfly $donHang) : void 
    {
        // Xóa tất cả các thanh toán để cập nhật mới
        foreach($donHang->thanhToanThuocDonHang as $thanhToan){
            $thanhToan->delete();
        }
    }

    /**
     * luu cac thanh toan vao don hang
     */
    private function _luuThanhToanThuocDonHang(DonHangGetFly $donHang, array $danhSachThanhToan) : void 
    {
        foreach($danhSachThanhToan as $thanhToan){
            ThanhToanThuocDonHang::create([
                'id_don_hang' => $donHang->id,
                'so_tien_thanh_toan' => $thanhToan['amount'],
                'ngay_thanh_toan' => date('Y-m-d',strtotime(str_replace('/','-',$thanhToan['pay_date'])))
            ]);
        }
    }

    /**
     * thêm mới sản phẩm vào đơn hàng
     */
    private function _themSanPham($donHangID,$sanPhamID,$giaSanPham,$giaBan,$soLuong) {
        $sanPham = SanPhamThuocDonHang::create([
                    'id_don_hang' => $donHangID,
                    'id_san_pham' => $sanPhamID,
                    'gia_san_pham' => $giaSanPham,
                    'gia_ban' => $giaBan,
                    'so_luong' => $soLuong
                ]);

                
    }

    /**
     * kiem tra ton tai san pham thuoc danh muc
     */
    private function _layThongTinSanPhamTrongDanhMuc($maSanPham) : ?DanhMucSanPham
    {
        return DanhMucSanPham::where('ma_san_pham',$maSanPham)->first();
    }

    /**
     * them san pham thuoc danh muc neu chua co trong danh muc san pham
     */
    private function _themSanPhamThuocDanhMuc($maSanPham,$tenSanPham) : DanhMucSanPham
    {
        $sanPham = new DanhMucSanPham();
        $sanPham->ma_san_pham = $maSanPham;
        $sanPham->ten_san_pham = $tenSanPham;
        $sanPham->save();

        return $sanPham;
    }



    /**store don hang lay data tu getfly */
    public function storeDonHangGetFly($donHangGetFly,$maDonHang) 
    {
        $url ="/orders/". $maDonHang;
        $jsonData= json_decode( $donHangGetFly->getToGetFly($maDonHang,$url));
        $dataGetFly=json_decode(json_encode($jsonData),true);

       $data= $this->getDataFromGetfly($dataGetFly);
        // dd($data['orderInfo']['order_date']);
        // id nhân viên 
        $nhanVien= NhanVien::where('ho_ten',$data['orderInfo']['assigned_name'])->first();
        // dd($nhanVien);
        if($nhanVien==null) {
            $nhanVienID = 14;
        } else {
            $nhanVienID = $nhanVien->id;
        }
        //Lưu đơn hàng
        if(isset($data['orderInfo']['ngay_nghiem_thu'])) {
            $ngayNghiemThu = $data['orderInfo']['ngay_nghiem_thu'];
        } else {
            $ngayNghiemThu = NULL;
        }
        if( $data['orderInfo']['assigned_name'] != null){
            $tenNguoiTao= $data['orderInfo']['assigned_name'];
        }else{
            $tenNguoiTao="3D SMART SOLUTIONS";
        }
        $donHang = DonHangGetFly::create([
            'ma_don_hang' => $maDonHang,
            'id_nhan_vien' => $nhanVienID,
            'ten_nguoi_tao' => $tenNguoiTao,
            'doanh_so' => $data['doanhSo'],
            'doanh_thu' => $data['orderInfo']['amount'],
            'ngay_tao_don' => date('Y-m-d',strtotime(str_replace('/','-',$data['orderInfo']['order_date']))),
            // 'ngay_bat_dau_tinh_thoi_han' => date('Y-m-d',strtotime(str_replace('/','-',$data['orderInfo']['order_date']))),
            // 'ngay_ket_thuc_tinh_thuong' => date('Y-m-d',strtotime(str_replace('/','-',$data['orderInfo']['order_date']) ." +60 days")),
            'trang_thai_getfly' => $data['orderInfo']['order_status'],
            'ngay_nghiem_thu'=>$ngayNghiemThu,
            'id_khach_hang'=>$data['orderInfo']['account_id']
        ]);

        return $donHang;
    }

    /**
     * update don hang du lieu ty getfly
     */
    
}