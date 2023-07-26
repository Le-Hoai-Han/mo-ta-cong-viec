<?php

namespace Tests\Feature\Thuong\ThuongTheoThoiGian;

use App\Models\User;
use App\Services\Thuong\ThuongThoiGianService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use ReflectionClass;
use Tests\TestCase;

class LuuThuongTheoThoiGianTest extends TestCase
{
    use DatabaseTransactions;
    protected $user;
    protected function setUp() : void
    {
        parent::setUp();        
        $this->user = User::where([
            'email'=>"khanh.tran@3ds.vn"
        ])->first();
        $this->actingAs($this->user);
    }

    /**
     * test trang create
     */
    public function test_create_page()
    {        
        $response = $this->get('/thuong-thoi-gian/create');
        $response->assertViewIs('front.thuong.thoigian.create');
        $response->assertViewHasAll([
            'thuongThoiGian',
            'dsNhanVien',
            'dsChiTieu',
            'dsNhomNhanVien'
        ]);
    }
    /**
     * test co nhap du lieu
     */
    
    public function test_submit_fake_data()
    {
        // $this->assertTrue(true);
        //data quý 2 để ko trùng với unit test
        $response = $this->post(route('thuong-thoi-gian.store'),[
            // '_token'=>csrf_token(),
            'id_nhom_nhan_vien'=>1,
            'nhan_vien'=>[4,10,15],
            'chi_tieu'=>[
                3=>36,
                4=>12,
                5=>12,
                7=>6600000,
                8=>48,
                10=>60,
                11=>24
            ],
            'nam'=>date('Y'),
            'quy'=>2
        ]);

        // $response->dump();
        // dd($response);
        $response->assertValid([
            'nam',
            'quy',
            'chi_tieu',
            'nhan_vien',
            // 'cong_thuc_tinh' => 'required',
            'id_nhom_nhan_vien'
        ]);
        $response->assertRedirect(route('thuong-thoi-gian.index'));

    }

   
}
