<?php

namespace App\Models\Thuong;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietNoXauDaTru extends Model
{
    public $table = 'cms___chi_tiet_no_xau_da_tru';
    
    public $fillable = [
        'id_no_xau',
        'so_tien',
        'ngay_tru_no',
        'id_thuong_thoi_gian'
    ];

    public $timestamps = false;

    /**
     * relation thong tin no xau
     */
    public function noXau() : BelongsTo 
    {
        return $this->belongsTo(NoXauThuocNhanVien::class,'id_no_xau','id');
    }

    public function thuongThoiGian() : BelongsTo 
    {
        return $this->belongsTo(ThuongKhoangThoiGian::class,'id_thuong_thoi_gian','id');
    }

    protected static function booted() 
    {
        parent::booted();
        self::saved(function($chiTietNoXauDaTru) {
            $chiTietNoXauDaTru->noXau->capNhatTienNo();
        });
    }

    /**
     * tao link thuong nam lien quan
     */
    public function createThuongThoiGianLink() : string 
    {
        if($this->id_thuong_thoi_gian != null) {
            return "<a class='text-primary' href='".route('thuong-nam.show',[
                'thuongNam'=>$this->thuongThoiGian
            ])."' >Năm ".$this->thuongThoiGian->nam."</a>";
        } 

        return "";
        
    }
}
