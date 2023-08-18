<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitri extends Model
{
    use HasFactory;
    protected $table = 'vi_tri';
    protected $fillable = [
        'ten_vi_tri',
        'id_vi_tri_quan_ly',
        'phong_ban',
        'noi_lam_viec',
        'muc_dich',
        'id_user'
    ];

    public function capQuanLy(){
        return $this->belongsTo(Vitri::class,'id_vi_tri_quan_ly','id');
    }

    public function capDuoi(){
        return $this->hasMany(Vitri::class,'id_vi_tri_quan_ly','id');
    }

    

    public function user(){
        return $this->hasOne(User::class,'id','id_user');
    }

    public function nhiemVu(){
        return $this->hasMany(NhiemVu::class,'id_vi_tri','id');
    }

    public function thamQuyen(){
        return $this->hasMany(ThamQuyen::class,'id_vi_tri','id');
    }

    public function quanHe(){
        return $this->hasMany(QuanHe::class,'id_vi_tri','id');
    }

    public function tieuChuan(){
        return $this->hasMany(TieuChuanTuyenChon::class,'id_vi_tri','id');
    }

    


    /**
     * dung hien thi so do
     */
    public function soDoToChucCapDuoi($viTri){
        $nodeStructure=[];
        $mang1 = [];
     
          foreach($viTri->capDuoi as $item){
            if($viTri->capDuoi->isEmpty()){
            
                    $mang1 = [
                        'text' => [
                            'name' => $item->user->name,
                            'title' => $item->ten_vi_tri,
                            'contact' => $item->user->sdt
                        ],
                        'stackChildren' => $item->hien_thi_nhanh,
                        'image' => asset('storage/'.$item->user->profile_photo_path),
                        'HTMLid'=>'nhan-vien-'.$item->id,
                        'target' => 123,
                        'children' =>[]
    
                    ];

                }else{
                    $mang1[] = [
                        'text' => [
                            'name' => $item->user->name,
                            'title' => $item->ten_vi_tri,
                            'contact' => $item->user->sdt
                        ],
                        'stackChildren' => $item->hien_thi_nhanh,
                        'image' => asset('storage/'.$item->user->profile_photo_path),
                        'HTMLid'=>'nhan-vien-'.$item->id,
                        'target' => 123,
                        'children' =>$item->soDoToChucCapDuoi($item)
    
                    ];
                }
            }
        $nodeStructure = $mang1;
        return $nodeStructure;
    }
}
