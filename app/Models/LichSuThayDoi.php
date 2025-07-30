<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuThayDoi extends Model
{
    use HasFactory;
    protected $table = 'tochuc___lich_su_thay_doi';

    /**
     * Các thuộc tính có thể được gán hàng loạt.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'loggable_id',
        'loggable_type',
        'action',
        'before',
        'after',
    ];

    /**
     * Tự động chuyển đổi các cột JSON thành array.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'before' => 'array',
        'after' => 'array',
    ];

    /**
     * Định nghĩa quan hệ đa hình "loggable".
     * Giúp lấy được model gốc (Vị trí, Nhiệm vụ, ...) từ log.
     */
    public function loggable()
    {
        return $this->morphTo();
    }

    /**
     * Lấy thông tin người dùng đã thực hiện thay đổi.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
