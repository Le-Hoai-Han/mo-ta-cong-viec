<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserThuocPhongBan extends Model
{
    use HasFactory;
    protected $table = "tochuc___user_thuoc_phong_bans";
    protected $fillable = [
        'id_user',
        'id_phong_ban',
    ];
}
