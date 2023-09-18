<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Vitri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;

class ViTriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listViTri = ViTri::all();
        return view('back-end.vi-tri.index',[
            'listViTri' => $listViTri
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listViTri = ViTri::select(['id','ten_vi_tri','id_user'])->get();
        $listUser = User::select(['id','name'])->get();
        return view('back-end.vi-tri.create',[
            'listViTri'=>$listViTri,
            'listUser'=>$listUser,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->__validate($request->all());
        Vitri::create($data);
        return redirect()->route('vi-tri.index')->with('Thêm vị trí thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vitri $viTri)
    {
        return view('back-end.vi-tri.show',
    [
        'viTri' =>$viTri
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vitri $viTri)
    {
        $listViTri = ViTri::select(['id','ten_vi_tri','id_user'])->get();
        $listUser = User::select(['id','name'])->get();
        return view('back-end.vi-tri.edit',[
            'listViTri' =>  $listViTri,
            'viTri' => $viTri,
            'listUser'=>$listUser,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Vitri $viTri)
    {
        $data = $this->__validate($request->all());
        $viTri->update($data);
        return redirect()->route('vi-tri.index')->with('Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vitri $viTri)
    {
        dd($viTri);
    }

    public function __validate($data){
        $validate = Validator::make($data,[
            'ten_vi_tri' => 'required',
            'phong_ban' => 'required',
            'noi_lam_viec' => 'required',
            'muc_dich' => 'required',
            'id_vi_tri_quan_ly' => 'required',
            'id_user' =>'required'
        ],[
            'ten_vi_tri.required' => 'Tên vị trí không được bỏ trống',
            'phong_ban.required' => 'Tên phòng ban không được bỏ trống',
            'noi_lam_viec.required' => 'Nơi làm việc không được bỏ trống',
            'muc_dich.required' => 'Mục đích không được bỏ trống',
        ]);

        return $validate->validate();
    }
}
