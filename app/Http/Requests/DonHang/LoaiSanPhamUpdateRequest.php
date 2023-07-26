<?php

namespace App\Http\Requests\DonHang;

use Illuminate\Foundation\Http\FormRequest;

class LoaiSanPhamUpdateRequest extends FormRequest
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
            'name'=>'string|required',
            'code'=>'string|required',
            'ti_le_thuong_thanh_ly'=>'nullable|numeric',
            'ti_le_thuong_bd'=>'nullable|numeric',
            'ti_le_thuong_sale'=>'nullable|numeric',
            'ti_le_thuong_sale_nguon_co_san'=>'nullable|numeric',
            'tien_thuong_dich_vu'=>'nullable|numeric',
        ];
    }
}
