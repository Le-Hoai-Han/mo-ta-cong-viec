<?php

namespace App\Http\Requests\DonHang;

use Illuminate\Foundation\Http\FormRequest;

class DanhMucSanPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ma_san_pham'=>'required',
            'ten_san_pham'=>'required',
            'thue_vat'=>'nullable',
            'ti_le_thuong_thanh_ly' => 'nullable|numeric|between:0,100',
            'ti_le_thuong_bd' => 'nullable|numeric|between:0,100',
            'ti_le_thuong_sale' => 'nullable|numeric|between:0,100',
            'ti_le_thuong_sale_nguon_co_san' => 'nullable|numeric|between:0,100',
            'tien_thuong_dich_vu' => 'nullable|numeric',
            'id_loai_san_pham' => 'nullable|exists:App\Models\DonHang\LoaiSanPham,id',
            'dong_san_pham'=>'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'ma_san_pham.required' => 'Mã sản phẩm không được bỏ trống',
            'ten_san_pham.required' => 'Tên sản phẩm không được bỏ trống',
            'thue_vat.required' => 'Thuế VAT không được bỏ trống',
            'ti_le_thuong_sale.between' => 'Tỉ lệ tính thưởng SALE phải là số dương và nhỏ hơn 100',
            'ti_le_thuong_sale.required' => 'Tỉ lệ tính thưởng SALE không được bỏ trống',
            'ti_le_thuong_bd.between' => 'Tỉ lệ tính thưởng BD phải là số dương và nhỏ hơn 100',
            'ti_le_thuong_bd.required' => 'Tỉ lệ tính thưởng BD không được bỏ trống'
        ];
    }
}
