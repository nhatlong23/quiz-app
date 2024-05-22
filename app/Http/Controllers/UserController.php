<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $user_list = User::orderBy('id', 'DESC')->get();

        return view('admin.users.index', compact('user_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles_list = Role::orderBy('id', 'DESC')->get();

        return view('admin.users.form', compact('roles_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ],
            [
                'name.required' => 'Vui lòng nhập tên người dùng',
                'name.max' => 'Tên người dùng không được vượt quá 255 ký tự',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            ]
        );

        $user = new User();
        $user->fill($dataValidated);
        $user->password = Hash::make($request->password);
        $user->created_at = now('Asia/Ho_Chi_Minh');
        $roleIds = $request->role_id;

        if ($user->save()) {
            $user->roles()->attach($roleIds);

            toastr()->success('Thêm mới người dùng thành công');
            return redirect()->route('users.index');
        } else {
            toastr()->error('Thêm mới người dùng thất bại');
            return redirect()->route('users.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles_list = Role::orderBy('id', 'DESC')->get();

        return view('admin.users.form', compact('user', 'roles_list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataValidated = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'role_id' => 'required|array',
                'role_id.*' => 'exists:roles,id',
            ],
            [
                'name.required' => 'Vui lòng nhập tên người dùng',
                'name.max' => 'Tên người dùng không được vượt quá 255 ký tự',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'role_id.required' => 'Vui lòng chọn ít nhất một vai trò',
                'role_id.*.exists' => 'Vai trò không hợp lệ',
            ]
        );

        $user = User::find($id);
        $user->fill($dataValidated);

        $roleIds = $request->role_id;
        if ($user->save()) {
            $user->roles()->sync($roleIds);

            toastr()->success('Cập nhật người dùng thành công');
            return redirect()->route('users.index');
        } else {
            toastr()->error('Cập nhật người dùng thất bại');
            return redirect()->route('users.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            toastr()->error('Người dùng không tồn tại');
            return redirect()->route('users.index');
        }

        $user->roles()->detach();

        $user->delete();

        toastr()->success('Xóa người dùng thành công');
        return redirect()->route('users.index');
    }
}
