<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestStoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'method',
        'header',
        'body'
    ];
}
