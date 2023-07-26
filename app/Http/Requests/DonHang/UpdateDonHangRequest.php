<?php

namespace App\Http\Requests\DonHang;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonHangRequest extends FormRequest
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
            "doanh_so" => "string",
            "doanh_thu" => 'string',
            "ngay_tao_don" => 'string',
            "la_nguon_marketing" => 'min:0|max:1',
            "la_may_thanh_ly" => 'min:0|max:1',
            "chi_phi_phat_sinh" => 'string',
            "tien_thuong_don_hang" => 'string'
        ];
    }
}
