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
        'id_user',
        'trang_thai',
        'stroke'
    ];

    const TT_KHOA = 1;
    const TT_MO_KHOA = 0;


    protected static function booted()
    {
        static::creating(function ($viTri) {
            if ($viTri->id_user == 0) 
                $viTri->id_user = null;
                // $viTri->save();
            } );

        static::updating(function ($viTri) {
            if ($viTri->id_user == 0) 
                $viTri->id_user = null;
                // $viTri->save();
            } );
    }
    
    public function capQuanLy(){
        return $this->belongsTo(Vitri::class,'id_vi_tri_quan_ly','id');
    }

    public function capDuoi(){
        return $this->hasMany(Vitri::class,'id_vi_tri_quan_ly','id')->orderBy('stt_cap_bac');
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
                            'name' => $item->user != null ? $item->user->name :'Đang cập nhật',
                            'title' => $item->ten_vi_tri,
                            'contact' => $item->user != null ? $item->user->sdt :'Đang cập nhật'
                        ],
                        'stackChildren' => $item->hien_thi_nhanh,
                        'image' => asset('storage/'.($item->user != null ? $item->user->profile_photo_path:'')),
                        'HTMLid'=>'nhan-vien-'.$item->id,
                        'target' => 123,
                        'children' =>[]
    
                    ];

                }else{
                    $mang1[] = [
                        'text' => [
                            'name' => $item->user != null ? $item->user->name :'Đang cập nhật',
                            'title' => $item->ten_vi_tri,
                            'contact' => $item->user ? $item->user->sdt :'Đang cập nhật'
                        ],
                        'stackChildren' => $item->hien_thi_nhanh,
                        'image' => asset('storage/'.($item->user != null ? $item->user->profile_photo_path:'')),
                        'HTMLid'=>'nhan-vien-'.$item->id,
                        'target' => 123,
                        'children' =>$item->soDoToChucCapDuoi($item)
    
                    ];
                }
            }
        $nodeStructure = $mang1;
        return $nodeStructure;
    }


    public function soDoToChucCapDuoi2($viTri){
        $nodeStructure=[];
        $mang1 = [];
     
          foreach($viTri->capDuoi as $item){
            if($viTri->capDuoi->isEmpty()){
            
                    $mang1 = [
                        'text' => [
                            'name' => $item->user != null ? $item->user->name :'Đang cập nhật',
                            // 'title' => $item->ten_vi_tri,
                            // 'contact' => $item->user ? $item->user->sdt :'Đang cập nhật'
                        ],
                        // 'stackChildren' => $item->hien_thi_nhanh,
                        'pseudo' =>'true',
                        'connectors'=>[
                            'type'=>$item->type,
                            'style' => [
                                'stroke' => $item->stroke,
                                'arrow-end' => $item->arrow_end,
                                // 'arrow-start' => $item->arrow_start,
                                'stroke-dasharray' =>$item->stroke_dasharray
                            ],
                            'stackIndent'=>$item->stackIndent
                       ],
    
                    ];

                }else{
                    $mang1[] = [
                        'text' => [
                            'name' => $item->user != null ? $item->user->name :'Đang cập nhật',
                            'title' => $item->ten_vi_tri,
                            // 'contact' => $item->user ? $item->user->sdt :'Đang cập nhật'
                        ],
                        // 'stackChildren' => $item->hien_thi_nhanh,
                        'connectors'=>[
                            'type'=>$item->type,
                            'style' => [
                                'stroke' => $item->stroke,
                                'arrow-end' => $item->arrow_end,
                                // 'arrow-start' => $item->arrow_start,
                                'stroke-dasharray' =>$item->stroke_dasharray
                            ],
                            'stackIndent'=>$item->stackIndent
                       ],
                        // 'image' => asset('storage/'.($item->user != null ? $item->user->profile_photo_path:'')),
                        'HTMLid'=>'nhan-vien-'.$item->id,
                        // 'target' => 123,
                        'children' =>$item->soDoToChucCapDuoi2($item)
    
                    ];
                }
            }
        $nodeStructure = $mang1;
        return $nodeStructure;
    }
}
