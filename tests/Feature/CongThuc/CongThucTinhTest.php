<?php

namespace Tests\Feature\CongThuc;

use App\Models\CongThuc\CongThucTinh;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;

class CongThucTinhTest extends TestCase
{
    use DatabaseTransactions;

    private function createModel($parentId,$oldVersionId) : CongThucTinh 
    {
        $congThuc = CongThucTinh::firstOrNew([
            'ten_cong_thuc'=>'Test 1',
            'noi_dung'=>'1+1',
            'mo_ta'=>'Mô tả test',
            'dang_su_dung'=>1,
            'id_cong_thuc_cha'=>$parentId,
            'la_cong_thuc_chinh'=>1,
            'id_nhom_nhan_vien'=>1,
            'thu_tu_sap_xep'=>1,
            'id_phien_ban_cu'=>$oldVersionId,
            
        ]);
        $congThuc->save();
        return $congThuc;
       
    }
    protected $user;
    protected function setUp() : void
    {
        parent::setUp();        
        $this->user = User::where([
            'email'=>"khanh.tran@3ds.vn"
        ])->first();
        $this->actingAs($this->user);
    }
    
    public function test_phien_ban_relation() 
    {
        $congThucCu = $this->createModel(null,null);
        $congThucMoi = $this->createModel(null,$congThucCu->id);

        // dump($congThucMoi->phienBanCu);
        //check phien ban cu
        $this->assertInstanceOf(CongThucTinh::class,$congThucMoi->phienBanCu);
        $this->assertEquals($congThucCu->id,$congThucMoi->phienBanCu->id);

        // check phien ban moi
        $this->assertInstanceOf(CongThucTinh::class,$congThucCu->phienBanMoi);
        $this->assertEquals($congThucMoi->id,$congThucCu->phienBanMoi->id);

    }

    // public function test_loai_cong_thuc() 
    // {
    //     $congThuc = 
    // }
}
