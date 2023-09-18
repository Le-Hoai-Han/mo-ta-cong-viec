<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\TieuChuanTuyenChon;
use App\View\Components\TieuChuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Validator;

class FrontTieuChuanController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->__validate($request->all());

        TieuChuanTuyenChon::create($validate);
        return redirect()->back()->with('Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tieuChuan = TieuChuanTuyenChon::find($id);
        $validate = $this->__validate($request->all());
        $tieuChuan->update($validate);
        return redirect()->back()->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function __validate($data){
        $validate = Validator($data, [
            'id_vi_tri' =>'required',
            'gioi_tinh' => 'required',
            'tuoi' => 'required',
            'hoc_van' => 'required',
            'chuyen_mon' => 'required',
            'vi_tinh' => 'required',
            'anh_ngu' => 'required',
            'kinh_nghiem' => 'required',
            'ky_nang' => 'required',
            'to_chat' => 'required',
            'ngoai_hinh' => 'required',
            'suc_khoe' => 'required',
            'ho_khau' => 'required',
            'uu_tien' => 'required',
        ],[
            'id_vi_tri.required' => 'Vui lòng chọn vị trí',
            'gioi_tinh.required' => 'Vui lòng nhập giới tính',
            'tuoi.required' => 'Vui lòng nhập tuổi',
            'hoc_van.required' => 'Vui lòng nhập học ván',
            'chuyen_mon.required' => 'Vui lòng nhập chuyên môn',
            'vi_tinh.required' => 'Vui lòng nhập vi tính',
            'anh_ngu.required' => 'Vui lòng nhập anh ngữ',
            'kinh_nghiem.required' => 'Vui lòng nhập kinh nghiệm',
            'ky_nang.required' => 'Vui lòng nhập kỹ năng',
            'to_chat.required' => 'Vui lòng nhập tố chất ',
            'ngoai_hinh.required' => 'Vui lòng nhập ngoại hình',
            'suc_khoe.required' => 'Vui lòng nhập tình trạng sức khỏe',
            'ho_khau.required' => 'Vui lòng nhập hộ khẩu',
            'uu_tien.required' => 'Vui lòng nhập ưu tiên',
            
        ]);


        return $validate->validate();
    }

    public function __getTieuChuan(Request $request){
        $tieuChuan = TieuChuanTuyenChon::find($request->idTieuChuan);
        return [$tieuChuan,$tieuChuan->viTri];
    }
}
