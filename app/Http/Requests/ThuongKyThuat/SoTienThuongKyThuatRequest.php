<?php

namespace App\Http\Requests\ThuongKyThuat;

use Illuminate\Foundation\Http\FormRequest;

class SoTienThuongKyThuatRequest extends FormRequest
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
            "mo_ta" => "required",
            "tien_thuong_co_ban" => "required",
            "tien_thuong_vuot_muc" => "required",
            "so_luong_gioi_han" => "required",
            "phien_ban" => "string",
            "id_phien_ban_cu" => "nullable|exists:App\Models\ThuongKyThuat\SoTienThuongKyThuat,id",
            'dang_su_dung'=>'numeric|min:0|max:1'
        ];
    }
}
