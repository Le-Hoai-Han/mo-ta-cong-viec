<?php

namespace App\Http\Requests\ThuongKyThuat;

use Illuminate\Foundation\Http\FormRequest;

class ThemLoaiThuongKyThuatRequest extends FormRequest
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
            'ma_loai' => 'required|string|unique',
            'ten_loai' => 'required|string',
            'mo_ta'=>'nullable|string'
        ];
    }
}
