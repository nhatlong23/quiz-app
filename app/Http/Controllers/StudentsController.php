<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentsController extends Controller
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
        $students_list = Student::orderBy('id', 'DESC')->get();
        return view('admin.students.index', compact('students_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class_name = Classs::orderBy('id', 'DESC')->get();
        return view('admin.students.form', compact('class_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_code' => 'required|max:100|unique:students',
            'name' => 'required|max:100',
            'class_id' => 'nullable|numeric',
            'birth' => 'required|date',
            'gender' => 'required',
            'school_year' => 'required|max:100',
            'cccd' => 'required|digits:12|numeric|unique:students',
            'phone' => 'required|regex:/^0[0-9]{9}$/|numeric|unique:students',
            'email' => 'required|email|unique:students',
            'password' => 'min:6|max:50|required',
            'status' => 'required|in:0,1',
            'images' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'password_confirmation' => 'same:password',
        ], [
            'student_code.required' => 'Vui lòng nhập mã sinh viên',
            'student_code.unique' => 'Mã sinh viên đã tồn tại',
            'student_code.max' => 'Mã sinh viên không được quá :max ký tự',
            'name.required' => 'Vui lòng nhập tên sinh viên',
            'name.max' => 'Tên sinh viên không được quá :max ký tự',
            'birth.required' => 'Vui lòng nhập ngày sinh',
            'birth.date' => 'Ngày sinh không đúng định dạng',
            'gender.required' => 'Vui lòng chọn giới tính',
            'school_year.required' => 'Vui lòng nhập năm học',
            'school_year.max' => 'Năm học không được quá :max ký tự',
            'cccd.required' => 'Vui lòng nhập số CCCD',
            'cccd.digits' => 'Số CCCD phải có :digits chữ số',
            'cccd.numeric' => 'Số CCCD phải là số',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'phone.numeric' => 'Số điện thoại phải là số',
            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự',
            'password.max' => 'Mật khẩu không được quá :max ký tự',
            'password_confirmation.same' => 'Mật khẩu không khớp',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'images.mimes' => 'Ảnh không đúng định dạng jpeg, jpg, png, gif',
            'images.max' => 'Kích thước ảnh không được vượt quá :max KB',
        ]);

        $hashedPassword = Hash::make($request->password);

        $students = new Student();
        $students->fill($validatedData);
        $students->password = $hashedPassword;
        $students->created_at = now('Asia/Ho_Chi_Minh');

        if ($request->hasFile('images')) {
            $uploadedImage = Cloudinary::upload($request->file('images')->getRealPath(), [
                'folder' => 'quizz_local',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => pathinfo($request->file('images')->getClientOriginalName(), PATHINFO_FILENAME),
            ]);
            $students->images = $uploadedImage->getSecurePath();
        }

        $students->save();

        toastr()->success("Thêm thành công tên sinh viên: $students->students_name");
        return redirect()->route('students.index');
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
        $students = Student::findOrFail($id);
        $class_name = Classs::orderBy('id', 'DESC')->get();
        return view('admin.students.form', compact('students', 'class_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'class_id' => 'nullable|numeric',
            'birth' => 'required|date',
            'gender' => 'required',
            'cccd' => 'required|digits:12|numeric',
            'school_year' => 'required|max:100',
            'phone' => 'required|regex:/^0[0-9]{9}$/|numeric',
            'email' => 'required|email',
            // 'students_password' => 'min:6|max:50',
            'status' => 'required|in:0,1',
            'images' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            // 'students_password_confirmation' => 'same:students_password',
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => 'Mã sinh viên đã tồn tại',
            'max' => ':Attribute không được quá :max ký tự',
            'numeric' => ':Attribute phải là số',
            'date' => ':Attribute không đúng định dạng',
            'digits' => ':Attribute phải có :digits chữ số',
            'regex' => ':Attribute không đúng định dạng',
            'email' => 'Email không đúng định dạng',
            'min' => ':Attribute phải có ít nhất :min ký tự',
            'in' => 'Trạng thái không hợp lệ',
            'mimes' => 'Ảnh không đúng định dạng jpeg, jpg, png, gif',
            'same' => 'Mật khẩu không khớp',
        ]);
        

        $students = Student::findOrFail($id);

        // $hashedPassword = Hash::make($request->students_password);

        $fields = [
            'name' => 'Tên sinh viên',
            'birth' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'cccd' => 'Số CCCD',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'status' => 'Trạng thái',
            'school_year' => 'Niên khóa',
            'class_id' => 'Lớp',
        ];

        foreach ($fields as $field => $label) {
            if ($students->$field != $validatedData[$field]) {
                if ($field === 'status') {
                    $statusText = $validatedData[$field] == 1 ? 'Hiển thị' : 'Ẩn';
                    toastr()->success("Thay đổi $label thành $statusText");
                } else {
                    toastr()->success("Thay đổi $label thành " . $validatedData[$field]);
                }
            }
        }

        $students->fill(array_merge($validatedData, [
            'students_department_id' => '1',
            // 'students_password' => $hashedPassword,
        ]));

        $this->handleImage($request, $students);
        $students->updated_at = now('Asia/Ho_Chi_Minh');

        $students->save();
        return redirect()->route('students.index');
    }

    private function handleImage($request, $students)
    {
        $get_image = $request->file('images');

        if ($get_image) {
            if ($students->images) {
                $public_id_old = $students->images;
                $token = explode('/', $public_id_old);
                $token2 = explode('.', $token[sizeof($token) - 1]);
                Cloudinary::destroy('students/' . $token2[0]);
            }

            $original_name = $get_image->getClientOriginalName();
            $public_id_new = pathinfo($original_name, PATHINFO_FILENAME);

            $uploadedImage = Cloudinary::upload($get_image->getRealPath(), [
                'folder' => 'quizz_local',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => $public_id_new,
            ]);

            $students->images = $uploadedImage->getSecurePath();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $students = Student::findOrFail($id);
            $students_name = $students->name;
            $students->delete();
            toastr()->warning("Xóa thành công sinh viên: $students_name");
        } catch (ModelNotFoundException $exception) {
            toastr()->warning("Không tìm thấy sinh viên");
        }

        return redirect()->route('students.index');
    }

    public function quick_view_students(Request $request)
    {
        $student_id = $request->id_student;
        $student = Student::findOrFail($student_id);

        $class_id = $request->id_class;
        $class = Classs::findOrFail($class_id);

        $output = [
            'student_code' => $student->student_code,
            'names' => $student->name,
            'school_year' => $student->school_year,
            'birth' => $student->birth,
            'gender' => $student->gender,
            'email' => $student->email,
            'phone' => $student->phone,
            'cccd' => $student->cccd,
            'class' => $class->name,
            'images' => $student->images,
        ];

        return response()->json($output);
    }

    public function updateStatusStudents(Request $request)
    {
        $student = Student::findOrFail($request->id);
        $status = $request->checked ? 1 : 0;
        $student->status = $status;
        $student->updated_at = now('Asia/Ho_Chi_Minh');
        $student->save();
    
        return $status;
    }
}
