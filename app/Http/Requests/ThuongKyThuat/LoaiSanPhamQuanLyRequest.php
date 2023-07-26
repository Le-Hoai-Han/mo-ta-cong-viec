<?php

namespace App\Http\Requests\ThuongKyThuat;

use Illuminate\Foundation\Http\FormRequest;

class LoaiSanPhamQuanLyRequest extends FormRequest
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
            'id_nhom_nhan_vien' => 'required|exists:App\Models\NhanVien\NhomNhanVien,id',
            'id_loai_san_pham' => 'required|exists:App\Models\DonHang\LoaiSanPham,id',
        ];
    }
}
