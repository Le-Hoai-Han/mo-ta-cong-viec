<?php

namespace App\Http\Requests\ThuongKyThuat;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatLoaiThuongKyThuatRequest extends FormRequest
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
            'ma_loai' => 'required|string|unique:App\Models\ThuongKyThuat\LoaiThuongKyThuat,ma_loai,'.$this->loaiThuongKyThuat->id,
            'ten_loai' => 'required|string',
            'mo_ta'=>'nullable|string'
        ];
    }
}
