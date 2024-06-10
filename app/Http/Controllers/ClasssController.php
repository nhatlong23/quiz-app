<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Classs;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClasssController extends Controller
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
        $class_list = Classs::orderBy('id', 'DESC')->get();
        return view('admin.class.index', compact('class_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blocks_name = Block::orderBy('id', 'DESC')->get();
        return view('admin.class.form', compact('blocks_name'));
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
                'block_id' => 'required|numeric',
                'number' => 'required|max:255|numeric',
                'status' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên lớp học',
                'name.unique' => 'Tên lớp học đã tồn tại',
                'name.max' => 'Tên lớp học không được quá 100 ký tự',
                'desc.required' => 'Vui lòng nhập mô tả lớp học',
                'desc.max' => 'Mô tả lớp học không được quá 255 ký tự',
                'block_id.required' => 'Vui lòng nhập khối lớp',
                'block_id.numeric' => 'Khối lớp phải là số',
                'number.required' => 'Vui lòng nhập số lượng học sinh',
                'number.max' => 'Số lượng học sinh không được quá 255 ký tự',
                'number.numeric' => 'Số lượng học sinh phải là số',
                'status.required' => 'Vui lòng chọn trạng thái lớp học',
            ]
        );
        $class = new Classs();
        $class->fill($validateData);
        $class->created_at = now('Asia/Ho_Chi_Minh');

        toastr()->success("Thêm thành công lớp học: $class->name");
        $class->save();
        return redirect()->route('class.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($classId)
    {
        $class = Classs::findOrFail($classId);
        $exams = $class->standardizeExams()->with('exam')->get();
        return view('admin.class.show', compact('class', 'exams'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $class_list = Classs::orderBy('id', 'DESC')->get();
        $blocks_name = Block::orderBy('id', 'DESC')->get();
        $class = Classs::findOrFail($id);
        return view('admin.class.form', compact('class_list', 'class', 'blocks_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate(
            [
                'name' => 'required|max:100',
                'desc' => 'required|max:255',
                'block_id' => 'required|numeric',
                'number' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên lớp học',
                'name.max' => 'Tên lớp học không được quá 100 ký tự',
                'desc.required' => 'Vui lòng nhập mô tả lớp học',
                'desc.max' => 'Mô tả lớp học không được quá 255 ký tự',
                'block_id.required' => 'Vui lòng nhập khối lớp',
                'block_id.numeric' => 'Khối lớp phải là số',
                'number.required' => 'Vui lòng nhập số lượng học sinh',
                'number.max' => 'Số lượng học sinh không được quá 255 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái lớp học',
            ]
        );

        $class = Classs::findOrFail($id);

        $fields = [
            'name' => 'Tên lớp học',
            'desc' => 'Mô tả lớp học',
            'number' => 'Số lượng học sinh',
            'status' => 'Trạng thái',
        ];

        foreach ($fields as $field => $label) {
            if ($class->$field != $validateData[$field]) {
                if ($field === 'status') {
                    $statusText = $validateData[$field] == 1 ? 'Hiển thị' : 'Ẩn';
                    toastr()->success("Thay đổi $label thành $statusText");
                } else {
                    toastr()->success("Thay đổi $label thành " . $validateData[$field]);
                }
            }
        }

        $class->fill($validateData);
        $class->updated_at = now('Asia/Ho_Chi_Minh');

        $class->save();
        return redirect()->route('class.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $class = Classs::findOrFail($id);
            $class_name = $class->name;
            $class->delete();
            toastr()->warning("Xóa thành công lớp học: $class_name");
        } catch (ModelNotFoundException $exception) {
            toastr()->warning("Không tìm thấy lớp học");
        }
        return redirect()->route('class.index');
    }

    public function quick_view_class(Request $request)
    {
        $class_id = $request->id_class;
        $class = Classs::findOrFail($class_id);

        $students = $class->students;

        $output = [
            'name' => $class->name,
            'number' => $class->number,
            'students' => $students
        ];

        return response()->json($output);
    }

    public function updateStatusClasss(Request $request)
    {
        $class = Classs::findOrFail($request->id);
        $status = $request->checked ? 1 : 0;
        $class->status = $status;
        $class->updated_at = now('Asia/Ho_Chi_Minh');
        $class->save();

        return $status;
    }
}
