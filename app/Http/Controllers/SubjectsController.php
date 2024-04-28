<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects_list = Subject::orderBy('id', 'DESC')->get();
        return view('admin.subjects.index', compact('subjects_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subjects.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:subjects|max:100',
                'status' => 'required',
            ], [

                'name.required' => 'Vui lòng nhập tên môn học',
                'name.unique' => 'Tên môn học đã tồn tại',
                'name.max' => 'Tên môn học không được quá 100 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái của môn học',
            ]);

            $subject = new Subject();
            $subject->fill($validatedData);
            $subject->created_at = now('Asia/Ho_Chi_Minh');
            $subject->save();

            toastr()->success("Thêm thành công Môn học: $subject->name");
            return redirect()->route('subjects.index');
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subjects_edit = Subject::orderBy('id', 'DESC')->get();
        $subjects = Subject::findOrFail($id);
        return view('admin.subjects.form', compact('subjects_edit', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:100',
                'status' => 'required',
            ], [
                'name.required' => 'Vui lòng nhập tên môn học',
                'name.max' => 'Tên môn học không được quá 100 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái của môn học',
            ]);

            $subject = Subject::findOrFail($id);
            $fields = [
                'name' => 'tên môn học',
                'status' => 'trạng thái môn học',
            ];
            foreach ($fields as $field => $label) {
                if ($subject->$field != $validatedData[$field]) {
                    if ($field === 'status') {
                        $statusText = $validatedData[$field] == 1 ? 'Hiển thị môn học' : 'Ẩn môn học';
                        toastr()->success("Thay đổi $label thành $statusText");
                    } else {
                        toastr()->success("Thay đổi $label thành " . $validatedData[$field]);
                    }
                }
            }
            $subject->fill($validatedData);
            $subject->updated_at = now('Asia/Ho_Chi_Minh');
            $subject->save();
            return redirect()->route('subjects.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $subject = Subject::findOrFail($id);
            $subject_name = $subject->name;
            $subject->delete();
            toastr()->warning("Xóa thành công môn học: $subject_name");
        } catch (ModelNotFoundException $exception) {
            toastr()->warning("Không tìm thấy môn học");
        }

        return redirect()->route('subjects.index');
    }

    public function updateStatusSubjects(Request $request)
    {
        $subject = Subject::findOrFail($request->id);
        $status = $request->checked ? 1 : 0;
        $subject->status = $status;
        $subject->updated_at = now('Asia/Ho_Chi_Minh');
        $subject->save();
    
        return $status;
    }
    
}
