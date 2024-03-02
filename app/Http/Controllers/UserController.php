<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Models\User;
use App\Notifications\NotificationUser;
use App\Notifications\TrainerApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Profile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
//use App\Actions\Fortify\PasswordValidationRules;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    use ValidatesRequests;
    use AuthorizesRequests;
    //use PasswordValidationRules;
    // use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view_users');
        $users = User::latest()->paginate();
        return view('run.users.index', compact('users'));
    }


    // public function test()
    // {
    //     $user = User::find(15);
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add_users');
        $roles = Role::pluck('name', 'id');
        return view('run.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $this->authorize('add_users');
        $validate = $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'profile_photo_url' => 'files|max:2048'
        ]);
        // dd($validate);

        $user = new User();
        $user->name = $validate['name'];
        $user->email = $validate['email'];
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
               
        $this->authorize('edit_users');
        //$user = User::find($id);
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all('name', 'id');
        $user_permission=$user->permissions;
        return view('run.users.edit', compact('user', 'roles', 'permissions','user_permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('edit_users');
        $validate = $this->validate($request, [
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
        return redirect()->route('users.index')->withMessage('status', "User has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        if (Auth::user()->id == $user->id) {
            //$request->session->flash()->warning('Deletion of currently logged in user is not allowed :(')->important();
            return redirect()->back()->with('warning', 'Deletion of currently logged in user is not allowed :(');
        }

        $user->delete();

        // return redirect()->back();
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

    public function createActionColumn($user)
    {   
        $auth = auth()->user();
        $column = "";
    //    
       
        if ($auth->can('edit_users')) {
            $column .= "&nbsp;<a href='" . route('users.edit', $user->id) . "' class='btn btn-sm btn-primary'>" . '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
          </svg>' . "</a>&nbsp;";
        }

        if ($auth->can('delete_users')) {
            $route = route('users.destroy', $user->id);
            /*$column .= "<form   method='POST' action= '" . route('departments.destroy', $department->id) . "'   style = 'display: inline'  onSubmit = 'return confirm(\"Are you sure wanted to delete it?\")'>
            " . csrf_field() . "
            <input type='hidden' name='_method' value='delete'>*/
           

                $column .= "&nbsp;<button type='button' onclick='setDeleteUrl(\"" . $route . "\")' href='" . route('users.edit', $user->id) . "' class='btn btn-sm btn-danger'>" . '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
          </svg>' . "</button>&nbsp;";
        }

        return $column;
    }


    public function anyData()
    {
        $user = Auth::user();
       
        if ($user->hasRole('Admin')) {
            
            $users = User::select([
                'users.id',
                'users.name',
                'users.email',
                'users.profile_photo_path'
                // DB::raw('count(childrens.parent_id) as count'),

            ]);
        } else if ($user->hasRole('Employee')) {
            
            $users = User::select([
                'users.id',
                'users.name',
                'users.email',
                'users.profile_photo_path'
                // DB::raw('count(childrens.parent_id) as count'),

            ])->where('type', User::EMPLOYEE);
        }else{
            $users = User::select([
                'users.id',
                'users.name',
                'users.email',
                'users.profile_photo_path'
                // DB::raw('count(childrens.parent_id) as count'),

            ]);
        }

        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                return $this->createActionColumn($user);
            })
            ->addColumn('role', function ($user) {
                return $user->roleNames();
            })
            // ->addColumn('fullname', function ($user) {
            //     $profile = $user->profile;
            //     return $profile->full_name;
            // })
            ->addColumn('image', function ($user) {

                $result = '<div class="mt-2" style="text-align: center">';
                $result .= '<img src="' . $user->profile_photo_url . '" alt="' . $user->name . '" class="rounded-circle" style="width:46px"> </div>';
                // $url = $user->getProfilePhotoUrlAttribute();
                return $result;
            })->rawColumns(['actions', 'role', 'image'])->make(true);
    }

    public function newIndex()
    {
        return view('admin.user.profile');
    }
}
