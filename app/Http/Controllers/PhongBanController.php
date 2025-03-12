<?php

namespace App\Http\Controllers;

use App\Models\PhongBan;
use App\Models\User;
use App\Traits\PhongBanTraits;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PhongBanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listPhongBan = PhongBan::all();
        return view('back-end.phong-ban.index',[
            'listPhongBan' => $listPhongBan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __validate($data){
        $validate = Validator::make($data,[
            'name' => 'required',
            'users' => 'nullable',
            'description' => 'nullable',
        ],[
            'name.required' => 'Tên phòng ban không được bỏ trống',
            'user.required' => 'User thuộc phòng ban không được bỏ trống'
        ]);

        return $validate->validate();
    }

    public function create()
    {
        $listIdUserDaCoPhongBan = User::whereHas('userThuocPhongBan')->pluck('id')->toArray();
        $listUser = User::activeEmployees()->select(['id','name'])->whereNotIn('id',$listIdUserDaCoPhongBan)->get();
        $listPhongBan = PhongBan::select(['id','name'])->get();
        return view('back-end.phong-ban.create',[
            'listUser' => $listUser,
            'listPhongBan' => $listPhongBan
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
       $validate = $this->__validate( $request->all());
       $kiemTraPhongBan = PhongBan::where('name',$validate['name'])->first();
       if($kiemTraPhongBan){
           return redirect()->back()->with('error','Tên phòng ban đã tồn tại');
       }
       $phongBan = PhongBan::create([
            'name' => $validate['name'],
            'description' => $validate['description'],
            'stt' => (PhongBan::max('stt') ?? 0) + 1
       ]);

       $user = [];
        if(!empty($validate['users'])){
            $user = $validate['users'];
        }
        $phongBan->userThuocPhongBan()->sync( $user);

       return redirect()->route('phong-ban.index')->with('success','Tạo phòng ban thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PhongBan $phongBan)
    {
        $listIdUserDaCoPhongBan = User::whereHas('userThuocPhongBan')->pluck('id')->toArray();
        $listUserThuocPhongBan = $phongBan->userThuocPhongBan;
        $listUser = User::activeEmployees()->select(['id','name'])->whereNotIn('id', $listIdUserDaCoPhongBan)->get();
        $listPhongBan = PhongBan::select(['id','name','stt'])->whereNotIn('id',[$phongBan->id])->get();
        return view('back-end.phong-ban.edit',[
            'phongBan' => $phongBan,
            'listUserThuocPhongBan' => $listUserThuocPhongBan,
            'listUser' => $listUser,
            'listPhongBan' => $listPhongBan
        ]);
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
    public function update(Request $request, PhongBan $phongBan)
    {
        $validate = $this->__validate($request->all());

        $phongBan->update([
            'name' => $validate['name'],
            'description' => $validate['description']
        ]);

        $user = [];
        if(!empty($validate['users'])){
            $user = $validate['users'];

            $idUserCoSan = $phongBan->userThuocPhongBan->pluck('id')->toArray();
            $idUserBiXoa = array_diff($idUserCoSan,$user);
            if(!empty($idUserBiXoa)){
                foreach($idUserBiXoa as $id){
                    $users = User::find($id);
                    if($users && $users->viTri){
                        $viTri = $users->viTri;
                        $viTri->id_phong_ban = null;
                        $viTri->save();
                }
            }
        }
        $phongBan->userThuocPhongBan()->sync( $user);
        return redirect()->route('phong-ban.index')->with('success','Cập nhật phòng ban thành công');
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhongBan $phongBan)
    {
        $phongBan->userThuocPhongBan()->detach();
        $phongBan->delete();
        return redirect()->route('phong-ban.index')->with('success','Xóa phòng ban thành công');
    }
}
