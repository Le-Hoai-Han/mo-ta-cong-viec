<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'getfly'=>[
        'key'=>env('GETFLY_KEY'),
        'url'=>env('GETFLY_URL')
    ],

    'phong-hop'=>[
        'token_key'=> env('TOKEN_KEY'),
        'url'=>env('URL_PHONG_HOP')

    ],
    'khach-hang'=>[
        'key'=>env('KEY_KHACH_HANG'),
        'url-index'=>env('URL_KHACH_HANG_INDEX'),
        'url-show'=>env('URL_KHACH_HANG_SHOW'),
        'id_khach_hang_khong_tinh_thuong'=>env('ID_KHACH_HANG_KHONG_TINH_THUONG')
    ],
    '3dm'=>[
        'ma_don_hang'=>env('3DM_MA_DH'),
        'ten_nguoi_tao'=>env('3DM_NGUOI_TAO')
    ],
    '3ds'=>[
        'id_nguoi_tao'=>env('3DS_ID_NGUOI_TAO'),
        'thu_tu_chi_tieu_doanh_so'=>env('3DS_CHI_TIEU_DOANH_SO',0)
    ],
    'san-pham-dich-vu'=>[
        'id_san_pham_dich_vu'=>env('ID_LOAI_SAN_PHAM_DICH_VU')
    ],
    'san-pham-phan-mem'=>[
        'id_san_pham_phan_mem'=>env('ID_LOAI_SAN_PHAM_PHAN_MEM')
    ],
    'san-pham-nguyen-vat-lieu'=>[
        env('ID_LOAI_SAN_PHAM_NGUYEN_VAT_LIEU_MAY_IN'),
        env('ID_LOAI_SAN_PHAM_NGUYEN_VAT_LIEU_MAY_SCAN')
    ],
    'san-pham-phu-kien'=>[
        env('ID_LOAI_SAN_PHAM_PHU_KIEN_MAY_IN',0),
        env('ID_LOAI_SAN_PHAM_PHU_KIEN_MAY_SCAN',0),
        env('ID_LOAI_SAN_PHAM_PHU_KIEN_MAY_CNC',0),
        env('ID_LOAI_SAN_PHAM_PHU_KIEN_MAY_DO_KIEM',0),
    ],
    'san-pham'=>[
        'vat_sp_co_dinh'=>env('VAT_SP')
    ],
    'thuong-mo-moi'=>[
        'id_thang_nam_bat_dau' => env('ID_THANG_NAM_BAT_DAU_THUONG_MO_MOI')
    ],
    'moi-quan-he'=>[
        'id_khong_tinh_thuong_mo_moi'=>env('ID_MOI_QUAN_HE_KHONG_TINH_THUONG_MO_MOI'),
        'id_dai_ly' =>env('ID_MOI_QUAN_HE_DAI_LY')
    ],
    'nhom-khach-hang' => [
        'id_mastercam' => env('ID_NHOM_KHACH_HANG_MASTERCAM')
    ],
    'drive' => [
        'url' => env('URL_DRIVE'),
        'key' =>env('KEY_DRIVE')
    ]

];
