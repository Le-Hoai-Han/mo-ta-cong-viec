<?php 

namespace App\Services\DonHang;

use App\Models\DonHang\LoaiSanPham;

class LoaiSanPhamService 
{

    //luu tat ca loai san pham voi chuoi json xuat tu getfly
    public function storeJson($dsLoaiSanPham): bool
    {
        LoaiSanPham::where('id','>',0)->delete();
        foreach($dsLoaiSanPham as $index=>$loaiSanPham) {
            LoaiSanPham::create([
                'id'=>$loaiSanPham->category_id,
                'code'=>$loaiSanPham->category_code,
                'name'=>$loaiSanPham->category_name,
                'parent_id'=>$loaiSanPham->parent_id,
                'level'=>$loaiSanPham->level
            ]);
        }

        return true;
    }

    //update loai san pham, ti le thuong cho san pham thuoc loai
    public function update($loaiSanPham,$name,$code,$tiLeThanhLy,$tiLeThuongBD,$tiLeThuongSale,$tiLeThuongSaleCoNguon,$thuongDichVu) {
        //cap nhat ti le tinh thuong cho cac san pham thuoc loai nay
        $loaiSanPham->name = $name;
        $loaiSanPham->code = $code;
        if($loaiSanPham->save())
        {
            return $this->_capNhatTiLeThuong($loaiSanPham->sanPhamThuocLoai,$tiLeThanhLy,$tiLeThuongBD,$tiLeThuongSale,$tiLeThuongSaleCoNguon,$thuongDichVu); 
        } 
        return false;        
    }

    /**
     * cap nhat ti le tinh thuong cho cac san pham thuoc loai khi cap nhat loai san pham
     */
    private function _capNhatTiLeThuong($dsSanPham,$tiLeThanhLy,$tiLeThuongBD,$tiLeThuongSale,$tiLeThuongSaleCoNguon,$thuongDichVu) : bool 
    {
        foreach($dsSanPham as $sanPham) {
            $sanPham->ti_le_thuong_thanh_ly = (float)$tiLeThanhLy;
            $sanPham->ti_le_thuong_bd = (float)$tiLeThuongBD;
            $sanPham->ti_le_thuong_sale = (float)$tiLeThuongSale;
            $sanPham->ti_le_thuong_sale_nguon_co_san = (float)$tiLeThuongSaleCoNguon;
            $sanPham->tien_thuong_dich_vu = (double)$thuongDichVu;
            $sanPham->save();
        }
        return true;
    }

    public function capNhatTiLeThuongSanPham(LoaiSanPham $loaiSanPham) : bool 
    {
        if($loaiSanPham->ti_le_thuong_sale != 0 || $loaiSanPham->ti_le_thuong_bd != 0) {
            $tiLeThanhLy = $loaiSanPham::TI_LE_THUONG_THANH_LY;
        } else {
            $tiLeThanhLy = 0;
        }
        return $this->_capNhatTiLeThuong($loaiSanPham->sanPhamThuocLoai,$tiLeThanhLy,$loaiSanPham->ti_le_thuong_bd,$loaiSanPham->ti_le_thuong_sale,$loaiSanPham->ti_le_thuong_sale_co_nguon,0);
    }
}
