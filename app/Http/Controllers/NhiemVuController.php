<?php

namespace App\Http\Controllers;

use App\Models\NhiemVu;
use App\Models\Vitri;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class NhiemVuController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listNhiemVu = NhiemVu::all();
        return view('back-end.nhiem-vu.index',[
            'listNhiemVu' => $listNhiemVu
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listViTri = Vitri::select(['id','ten_vi_tri'])->get();
        return view('back-end.nhiem-vu.create',[
            'listViTri' => $listViTri
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
        $validate = $this->__validate($request->all());
         NhiemVu::create($validate);
        return redirect()->route('nhiem-vu.index')->with('success','Thêm nhiệm vụ thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NhiemVu $nhiemVu)
    {
        return view('back-end.nhiem-vu.show',[
            'nhiemVu' =>$nhiemVu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NhiemVu $nhiemVu)
    {
        $listViTri = Vitri::select(['id','ten_vi_tri'])->get();
        return view('back-end.nhiem-vu.edit',[
            'listViTri' => $listViTri,
            'nhiemVu' => $nhiemVu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,NhiemVu $nhiemVu)
    {
        $validate = $this->__validate($request->all());
        $nhiemVu->update($validate);
        return redirect()->route('nhiem-vu.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NhiemVu $nhiemVu)
    {
        $nhiemVu->delete();
    }

    public function __validate($data){
        $validate = Validator::make($data,[
            'ten_nhiem_vu' => 'required|unique:Nhiem_Vu',
            'id_vi_tri' => 'required',
            
        ],[
            'ten_nhiem_vu.required' => 'Tên nhiệm vụ không được bỏ trống',
            'ten_nhiem_vu.unique' => 'Nhiệm vụ bị trùng',
            'id_vi_tri.required' => 'Vị trí không được bỏ trống',
        ])->validate();
        return $validate;
    }
}
