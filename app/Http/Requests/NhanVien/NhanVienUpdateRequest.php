<?php

namespace App\Http\Requests\NhanVien;

use Illuminate\Foundation\Http\FormRequest;

class NhanVienUpdateRequest extends FormRequest
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
            'name'=>'required|string',
            'email'=>'required|email',
            'group'=>'nullable',
            'da_xoa'=>'numeric|min:0|max:1',
            'id_nhom_nhan_vien'=>'nullable|exists:App\Models\NhanVien\NhomNhanVien,id'
        ];
    }
}
