<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Models\Permission;

class PermissionController extends Controller
{
    private $permission;
    public function __construct(Permission $permission)
    {
        $this->middleware('auth');
        $this->permission = $permission;
    }

    private function getPermission($parentId)
    {
        $data = $this->permission->all();
        $recursive = new Recusive($data);
        $htmlOptions = $recursive->permissionRecursive($parentId);
        return $htmlOptions;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->get();
        $parentPermissions = Permission::where('parent_id', 0)->get();

        return view('admin.permissions.index', compact('permissions', 'parentPermissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $htmlOptions = $this->getPermission($parentId = '');
        return view('admin.permissions.form', compact('htmlOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'parent_id' => '',
                'key_code' => '',
            ],
            [
                'required' => 'Vui lòng nhập :attribute',
                'unique' => 'Mã quyền đã tồn tại',
                'max' => ':Attribute không được quá :max ký tự',
            ]
        );

        $permission = new Permission();
        $permission->fill($validatedData);
        $permission->created_at = now('Asia/Ho_Chi_Minh');
        $permission->save();

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permissions = Permission::find($id);
        $parentId = $permissions->parent_id;
        $htmlOptions = $this->getPermission($parentId);

        if ($parentId == 0) {
            return redirect()->route('permissions.index')->withErrors(['error' => 'Bạn không thể sửa quyền cha.']);
        }

        return view('admin.permissions.form', compact('permissions', 'htmlOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'parent_id' => '',
                'key_code' => '',
            ],
            [
                'required' => 'Vui lòng nhập :attribute',
                'unique' => 'Mã quyền đã tồn tại',
                'max' => ':Attribute không được quá :max ký tự',
            ]
        );

        $permission = Permission::find($id);
        $permission->fill($validatedData);
        $permission->updated_at = now('Asia/Ho_Chi_Minh');
        $permission->save();

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        $this->deleteChildren($permission);

        $permission->delete();

        toastr()->success('Quyền đã được xóa thành công.');
        return redirect()->route('permissions.index');
    }

    private function deleteChildren($permission)
    {
        foreach ($permission->permissionChildren as $child) {
            $this->deleteChildren($child);
            $child->delete();
        }
    }
}
