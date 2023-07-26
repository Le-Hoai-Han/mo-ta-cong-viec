<?php

namespace App\Models\requestStoring;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestStoring extends Model
{
    use HasFactory;
    protected $table = 'request_storings';
    protected $fillable=[
        'method',
        'action',
        'header',
        'body'
    ];
}
