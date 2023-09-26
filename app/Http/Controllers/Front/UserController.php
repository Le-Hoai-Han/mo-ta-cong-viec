<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vitri;
use App\Traits\ViTriTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Validator;

class UserController extends RoutingController
{
    use ViTriTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getData(){
         $ceo = Vitri::find(2);
        
         $chartConfig = [
            'container' => '#basic-example',
            'connectors' => [
                'type' => 'step',
                
            ],
            'node' => [
                'HTMLclass' => 'nodeExample1'
            ]
        ];

        $nodeStructure = [
            'text' => [
                'name' => $ceo->user->name,
                'title' => $ceo->ten_vi_tri,
                'contact' => $ceo->user->sdt,
                
            ],
            'stackChildren' => $ceo->hien_thi_nhanh,
            'image' =>  asset('storage/'.$ceo->user->profile_photo_path),
            'HTMLid'=>'nhan-vien-' .$ceo->id,
            'children' => $ceo->soDoToChucCapDuoi($ceo),
        ];

        $chartJson = [
            'chart' => $chartConfig,
            'nodeStructure' => $nodeStructure
        ];
       return response()->json( $chartJson);

     }

     public function getData2(){
        $ceo = Vitri::find(2);
       
        $chartConfig = [
           'container' => '#OrganiseChart-big-commpany',
           'levelSeparation' => 45,
           'rootOrientation' => 'NORTH',
           'nodeAlign' => 'BOTTOM',
           'connectors' => [
               'type' => 'step',
               'style' => [
                'stroke-width' => 2
               ]
           ],
           'node' => [
               'HTMLclass' => 'big-commpany'
           ]
       ];

       $nodeStructure = [
           'text' => [
               'name' => $ceo->user->name,
               'title' => $ceo->ten_vi_tri,
            //    'contact' => $ceo->user->sdt,
               
           ],
           'connectors'=>[
                // 'type' =>'curve',
                'style' => [
                    'stroke' => $ceo->stroke,
                    'arrow-end' => 'oval-wide-long'
                ]
           ],
        //    'image' =>  asset('storage/'.$ceo->user->profile_photo_path),
           'HTMLid'=>'nhan-vien-' .$ceo->id,
           'children' => $ceo->soDoToChucCapDuoi2($ceo),
       ];

       $chartJson = [
           'chart' => $chartConfig,
           'nodeStructure' => $nodeStructure
       ];
      return response()->json( $chartJson);

    }

    public function getData3(){
        $ceo = Vitri::find(2);
       
        $chartConfig = [
           'container' => '#OrganiseChart-big-commpany',
           'levelSeparation' => 45,
           'rootOrientation' => 'NORTH',
           'nodeAlign' => 'BOTTOM',
           'connectors' => [
               'type' => 'step',
               'style' => [
                'stroke-width' => 2
               ]
           ],
           'node' => [
               'HTMLclass' => 'big-commpany'
           ]
       ];

       $nodeStructure = [
           'text' => [
               'name' => $ceo->user->name,
               'title' => $ceo->ten_vi_tri,
            //    'contact' => $ceo->user->sdt,
               
           ],
           'connectors'=>[
                // 'type' =>'curve',
                'style' => [
                    'stroke' => $ceo->stroke,
                    'arrow-end' => 'oval-wide-long'
                ]
           ],
        //    'image' =>  asset('storage/'.$ceo->user->profile_photo_path),
           'HTMLid'=>'nhan-vien-' .$ceo->id,
           'children' => $ceo->soDoToChucCapDuoi3($ceo),
       ];

       $chartJson = [
           'chart' => $chartConfig,
           'nodeStructure' => $nodeStructure
       ];
      return response()->json( $chartJson);

    }
    public function index()
    {
        return view('front.user2.index');
    }


    public function index2()
    {
        return view('front.user2.index2');
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
        $validate = $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'sdt' => 'required|min:10',
            'profile_photo_url' => 'files|max:2048'
        ]);
        // dd($validate);

        $user = new User();
        $user->name = $validate['name'];
        $user->email = $validate['email'];
        $user->sdt = $validate['sdt'];
        $user->password = bcrypt($request->get('password'));
        $user->status = 1;
        $file = $request->file();

        if ($user->save()) {
            
            //lưu profile

            // $profile->user_id= $user->id;
            // $profile->full_name= $user->name;
            // $profile->gender=null;
            // $profile->save();
            if(($request->file()) != null){
                $user->updateProfilePhoto($file['photo_file_path']);
            }
            // $user->updateProfilePhoto($request['profile_photo_url']);
            $this->syncPermissions($request, $user);
            return redirect()->route('users.index')->with('status', $user->name . " được tạo thành công");
        } else {
            return request()->session()->flash('error', 'Không thể tạo tài khoản này.');
        }
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
    public function update(Request $request, User $user)
    {
        if($user->viTri->trang_thai == Vitri::TT_KHOA){
            return response()->json([
                'status' =>'error',
                'message' =>'Cập nhật thất do vị trí đang bị khóa thông tin',
            ]);
        }
        $validate = Validator::make($request->all(), [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|min:1',
            'password' => 'nullable|min:8',
            'status' =>'required|min:1',
            'profile_photo_url' => 'files|max:2048'
        ]);
        $file = $request->file();
        //if($validate['password'] == null && )    
        // Update user
        $user->fill($request->except('roles', 'permissions', 'password'));

        // check for password change
        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        
        if(($request->file()) != null){
            $user->updateProfilePhoto($file['photo_file_path']);

        }

        // Handle the user roles
        $this->syncPermissions($request, $user);
        $user->status=$request->status;
        $user->save();
        
        //$request->session->flash()->success('User has been updated.');
        return redirect()->back()->withMessage('status', "User has been updated.");
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

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
    
        $permissions = $request->get('permissions', []);
        //trao vai trò cho người dùng
        $user->syncRoles($roles);
        //trao quyền cá nhân cho người dùng
        $user->syncPermissions($permissions);
        if ($user->hasRole('manager') || $user->hasRole('admin')) {
            if ($user->type != User::EMPLOYEE) {
                $user->update(['type' => User::EMPLOYEE]);
            }
        } else {
            $user->update(['type' => User::PUBLIC_USER]);
        }
        return $user;
    }
}
