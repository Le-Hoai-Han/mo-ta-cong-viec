<?php

namespace App\Http\Requests\Thuong;

use Illuminate\Foundation\Http\FormRequest;

class ThuongNhanVienRequest extends FormRequest
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
            // 'hang_muc_thuong' => 'required',
            'thang_su_dung' => 'required|array',
            'chi_tieu'=>'required|array',
            'nhan_vien' => 'required|array',
            // 'cong_thuc_tinh' => 'required',
            'id_nhom_nhan_vien' => 'required'
        ];
    }
}
