<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels_list = Level::orderBy('id', 'DESC')->get();
        return view('admin.levels.index', compact('levels_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.levels.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'name' => 'required|unique:class|max:100',
                'desc' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập mức độ câu hỏi',
                'name.unique' => 'Mức độ câu hỏi đã tồn tại',
                'name.max' => 'Mức độ câu hỏi không được quá 100 ký tự',
                'desc.required' => 'Vui lòng nhập mô tả mức độ câu hỏi',
                'desc.max' => 'Mô tả mức độ câu hỏi không được quá 255 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái mức độ câu hỏi',
            ]
        );
        $levels = new Level();
        $levels->fill($validateData);
        $levels->created_at = now('Asia/Ho_Chi_Minh');

        toastr()->success("Thêm thành công lớp học: $levels->name");
        $levels->save();
        return redirect()->route('levels.index');
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
        $levels_list = Level::orderBy('id', 'DESC')->get();
        $levels = Level::findOrFail($id);
        return view('admin.levels.form', compact('levels_list', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate(
            [
                'name' => 'required|unique:class|max:100',
                'desc' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập mức độ câu hỏi',
                'name.unique' => 'Mức độ câu hỏi đã tồn tại',
                'name.max' => 'Mức độ câu hỏi không được quá 100 ký tự',
                'desc.required' => 'Vui lòng nhập mô tả mức độ câu hỏi',
                'desc.max' => 'Mô tả mức độ câu hỏi không được quá 255 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái mức độ câu hỏi',
            ]
        );
        $levels = Level::findOrFail($id);
        $fields = [
            'name' => 'Tên mức độ câu hỏi',
            'desc' => 'Mô tả mức độ câu hỏi',
            'status' => 'Trạng thái mức độ câu hỏi',
        ];

        foreach ($fields as $field => $label) {
            if ($levels->$field != $validateData[$field]) {
                if ($field === 'status') {
                    $statusText = $validateData[$field] == 1 ? 'Hiển thị mức độ câu hỏi' : 'Ẩn mức độ câu hỏi';
                    toastr()->success("Thay đổi $label thành $statusText");
                } else {
                    toastr()->success("Thay đổi $label thành " . $validateData[$field]);
                }
            }
        }

        $levels->fill($validateData);
        $levels->updated_at = now('Asia/Ho_Chi_Minh');

        $levels->save();
        return redirect()->route('levels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $levels = Level::findOrFail($id);
            $levels_name = $levels->name;
            $levels->delete();
            toastr()->warning("Xóa thành công lớp học: $levels_name");
        } catch (ModelNotFoundException $exception) {
            toastr()->warning("Không tìm thấy lớp học");
        }
        return redirect()->route('blocks.index');
    }
}
