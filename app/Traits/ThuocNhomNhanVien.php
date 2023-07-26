<?php

namespace App\Traits;

use App\Models\NhanVien\NhomNhanVien;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ThuocNhomNhanVien
{
    /**
     * thuộc nhóm nhân viên để áp dụng công thức và chỉ tiêu
     */
    public function nhomNhanVien() : BelongsTo
    {
        return $this->belongsTo(NhomNhanVien::class,'id_nhom_nhan_vien','id');
    }

    /**
     * tao mang du lieu group theo nhom nhan vien
     */
    static public function duLieuTheoNhomNhanVien() : array 
    {
        $modelList = self::whereNotNull('id_nhom_nhan_vien')->get()->flatten()->toArray();
        $data = [];
        if(empty($modelList)) {
            return $data;
        }

        foreach($modelList as $model) {
            $data[$model['id_nhom_nhan_vien']][$model['id']] = $model;
        }
        
        return $data;
        

    }

     /**
     * lay query thuoc nhom
     * @var integer $idNhom
     */
    public function scopeThuocNhom($query, $idNhom) {
        return $query->where('id_nhom_nhan_vien',$idNhom);
    }
}
