<?php

namespace App\Http\Controllers;

use App\Models\QuanHe;
use App\Models\Vitri;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class QuanHeController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listQuanHe = QuanHe::all();
        return view('back-end.quan-he.index',[
            'listQuanHe' =>$listQuanHe
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
        return view('back-end.quan-he.create',[
            'listViTri'=>$listViTri
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
        $validate = $this->__validate($request);
        QuanHe::create($validate);
        return redirect()->route('quan-he.index')->with('success','Thêm thành công');
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
    public function edit(QuanHe $quanHe)
    {
        $listViTri = Vitri::select(['id','ten_vi_tri'])->get();
        return view('back-end.quan-he.edit',[
            'listViTri'=>$listViTri,
            'quanHe'=>$quanHe
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuanHe $quanHe)
    {
        $validate = $this->__validate($request);
        $quanHe->update($validate);
        return redirect()->route('quan-he.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuanHe $quanHe)
    {
        $quanHe->delete();
    }

    public function __validate($data){
        $validate = $this->validate($data,[
            'id_vi_tri'=>'required',
            'loai'=>'required',
            'noi_dung'=>'required',
        ],[
            'id_vi_tri.required' =>'Vị trí không được để trống',
            'loai.required' =>'Vị trí không được để trống',
            'noi_dung.required' =>'Vị trí không được để trống',
        ]);

        return $validate;
    }
}
