<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role_list = Role::orderBy('id', 'DESC')->get();

        return view('admin.roles.index', compact('role_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionsParent = Permission::where('parent_id', 0)->get();
        return view('admin.roles.form', compact('permissionsParent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'permission_id' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên vai trò',
                'name.max' => 'Tên vai trò không được vượt quá 255 ký tự',
                'description.required' => 'Vui lòng nhập tên hiển thị',
                'description.max' => 'Tên hiển thị không được vượt quá 255 ký tự',
                'permission_id.required' => 'Vui lòng chọn quyền',
            ]
        );

        $role = new Role();
        $role->fill($dataValidated);
        $role->created_at = now('Asia/Ho_Chi_Minh');
        $role->save();

        $permissionsIds = $request->permission_id;
        $role->permissions()->attach(($permissionsIds));

        toastr()->success('Thêm vai trò thành công');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Role::find($id);
        $role_list = Role::orderBy('id', 'DESC')->get();
        $permissionsParent = Permission::where('parent_id', 0)->get();
        $permissionChecked = $roles->permissions;

        return view('admin.roles.form', compact('roles', 'role_list', 'permissionsParent', 'permissionChecked'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataValidated = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
            ],
            [
                'name.required' => 'Vui lòng nhập tên vai trò',
                'name.max' => 'Tên vai trò không được vượt quá 255 ký tự',
                'description.required' => 'Vui lòng nhập tên hiển thị',
                'description.max' => 'Tên hiển thị không được vượt quá 255 ký tự',
            ]
        );

        $role = Role::find($id);
        $role->fill($dataValidated);
        $role->save();

        $permissionsIds = $request->permission_id;
        $role->permissions()->sync(($permissionsIds));

        toastr()->success('Cập nhật vai trò thành công');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        $premissions = $role->permissions;
        $role->permissions()->detach($premissions);

        toastr()->success('Xóa vai trò thành công');
        return redirect()->route('roles.index');
    }
}
