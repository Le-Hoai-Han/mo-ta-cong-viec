<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucThangNam extends Model
{
    use HasFactory;
    protected $table = 'cms___danh_muc_thang_nam';
    protected $fillable = [
        'nam','thang'
    ];

    /**
     * lay danh sach id thang thuoc nam
     */
    static public function dsIDThangThuocNam(int $nam) : array
    {
        return self::select('id')->where('nam',$nam)->orderBy('thang','ASC')->get()->pluck('id')->toArray();
    }

    static public function dsIDThangThuocNamHienTai() : array 
    {
        return self::dsIDThangThuocNam(date('Y'));
    }

    /**
     * id thang tu thang 1 cung nam den thang tim kiem
     */
    static function dsIDThangCungNamDen(int $idThangNam) : array
    {
        $thangNam = self::where('id',$idThangNam)->first();
        return self::dsIDThang($thangNam->thang, $thangNam->nam);
    }


    /**
     * ds thang tu 1 den thang tim kiem
     */
    static function dsIDThang(int $thang, int $nam) : array 
    {
        $dsKetQua = [];
        //index bat dau tu 0 => 11, thang tu 1-12        
        $thangIndex = $thang - 1;

        $dsThangTrongNam = self::dsIDThangThuocNam($nam);
        for($i=0;$i<=$thangIndex;$i++) {
            $dsKetQua[] = $dsThangTrongNam[$i];
        }
        return $dsKetQua;
    }
}
