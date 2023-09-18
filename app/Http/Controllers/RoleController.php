<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Authorizable;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view_roles');
        $roles = Role::all();
        $permissions = Permission::all();

        return view('run.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('run.roles.create', [
            'role' => new Role()
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

        $validate = $this->validate($request, [
            'name' => 'required|unique:App\Models\Role,name',
            'label' => 'nullable',

        ]);
        $role = new Role();
        $role->name = $validate['name'];
        $role->label = $validate['label'];
        if ($role->label == "") {
            $role->label = $role->name;
        }
        $role->guard_name = "web";
        if ($role->save()) {
            return redirect(route('roles.index'))->with('status', 'Thêm thành công ' . $role->name);
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        return view('run.roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if (isset($request['label'])) {
            $validate = $this->validate($request, [
                'name' => 'required|unique:App\Models\Role,name,' . $role->id,
                'label' => 'nullable',

            ]);
            if ($role->update($validate)) {
                return redirect()->route('roles.index')->with('success', 'Cập nhật thành công quyền ' . $role->name);
            } else {
                return redirect()->route('roles.index')->with('error', 'Cập nhật thành công quyền ' . $role->name);
            }
        } else {
            if ($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());
                return redirect()->route('roles.index');
            }

            $permissions = $request->get('permissions', []);
            

            $role->syncPermissions($permissions);
            // ddd($role->permissions);
            $request->session()->flash($role->name . ' đã cập nhật.');

            return redirect()->route('roles.index');
        }
        // admin role has everything

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $users = User::role($role->name)->get()->toArray();
        if (!empty($users))
            return redirect()->back()->with('error', 'Không xóa được quyền đã dùng');
        else {
            $role->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        }
    }
}
