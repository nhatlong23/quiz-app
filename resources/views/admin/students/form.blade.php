@extends('layouts.app')

@section('content')
    <style>
        .picture {
            width: 106px;
            height: 106px;
            background-color: #999999;
            border: 4px solid #cccccc;
            color: #ffffff;
            border-radius: 50%;
            margin: 5px auto;
            overflow: hidden;
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
        }

        .picture-src {
            width: 100%;
            height: 100%;
        }

        .picture:hover {
            border-color: #4caf50;
        }

        .picture input[type="file"] {
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        .choice {
            text-align: center;
            cursor: pointer;
        }

        .choice input[type="radio"],
        .choice input[type="checkbox"] {
            position: absolute;
            left: -10000px;
            z-index: -1;
        }

        .choice .icon {
            text-align: center;
            vertical-align: middle;
            height: 106px;
            width: 106px;
            border-radius: 50%;
            color: #999999;
            margin: 5px auto;
            border: 4px solid #cccccc;
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
            overflow: hidden;
        }

        .choice .icon:hover {
            border-color: #4caf50;
        }

        .choice.active .icon {
            border-color: #2ca8ff;
        }
    </style>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-graph text-success"></i>
                        </div>
                        @if (!isset($students))
                            <div>Thêm thí sinh</div>
                        @else
                            <div>Sửa thí sinh</div>
                        @endif
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="tab-content">
                <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            @if (!isset($students))
                                <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                                @else
                                    <form method="POST" action="{{ route('students.update', $students->id) }}"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                            @endif
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="student_code" class="col-sm-2 col-form-label">Mã thí sinh :</label>
                                <div class="col-sm-10">
                                    <input name="student_code" id="student_code" placeholder="Nhập mã thí sinh vào đây!!"
                                        type="text" class="form-control"
                                        value="{{ isset($students) ? $students->student_code : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="name" class="col-sm-2 col-form-label">Tên thí sinh :</label>
                                <div class="col-sm-10">
                                    <input name="name" id="name" placeholder="Nhập tên thí sinh vào đây!!"
                                        type="text" class="form-control"
                                        value="{{ isset($students) ? $students->name : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="school_year" class="col-sm-2 col-form-label">Năm học :</label>
                                <div class="col-sm-10">
                                    <input name="school_year" id="school_year" placeholder="Nhập năm học thí sinh vào đây!!"
                                        type="text" class="form-control"
                                        value="{{ isset($students) ? $students->school_year : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="class_id" class="col-sm-2 col-form-label">Lớp :</label>
                                <div class="col-sm-10">
                                    <select name="class_id" class="form-control">
                                        <option selected disabled>-------Chọn lớp học--------</option>
                                        @foreach ($class_name as $class)
                                            <option value="{{ $class->id }}" 
                                                {{ isset($students) && $students->class_id == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="birth" class="col-sm-2 col-form-label">Ngày sinh :</label>
                                <div class="col-sm-10">
                                    <input name="birth" id="birth" placeholder="Nhập ngày sinh thí sinh vào đây!!"
                                        type="date" class="form-control"
                                        value="{{ isset($students) ? $students->birth : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="gender" class="col-sm-2 col-form-label">Giới tính :</label>
                                <div class="col-sm-10">
                                    <select name="gender" class="form-control">
                                        <option value="male"
                                            {{ isset($students) && $students->gender == 'male' ? 'selected' : '' }}>
                                            Nam</option>
                                        <option value="female"
                                            {{ isset($students) && $students->gender == 'female' ? 'selected' : '' }}>
                                            Nữ</option>
                                        <option value="other"
                                            {{ isset($students) && $students->gender == 'other' ? 'selected' : '' }}>
                                            Khác</option>
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="cccd" class="col-sm-2 col-form-label">CCCD :</label>
                                <div class="col-sm-10">
                                    <input name="cccd" id="cccd" placeholder="Nhập cccd thí sinh vào đây!!"
                                        type="text" class="form-control"
                                        value="{{ isset($students) ? $students->cccd : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="phone" class="col-sm-2 col-form-label">Số điện thoại :</label>
                                <div class="col-sm-10">
                                    <input name="phone" id="phone" placeholder="Nhập số điện thoại thí sinh vào đây!!"
                                        type="phone" class="form-control"
                                        value="{{ isset($students) ? $students->phone : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="email" class="col-sm-2 col-form-label">Email :</label>
                                <div class="col-sm-10">
                                    <input name="email" id="email" placeholder="Nhập email thí sinh vào đây!!"
                                        type="phone" class="form-control"
                                        value="{{ isset($students) ? $students->email : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="status" class="col-sm-2 col-form-label">Trạng thái thí sinh
                                    :</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        <option value="1"
                                            {{ isset($students) && $students->status == 1 ? 'selected' : '' }}>
                                            Hiển thị thí sinh</option>
                                        <option value="0"
                                            {{ isset($students) && $students->status == 0 ? 'selected' : '' }}>
                                            Ẩn thí sinh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="password" class="col-sm-2 col-form-label">Mật khẩu :</label>
                                <div class="col-sm-10">
                                    <input name="password" id="password"
                                        placeholder="Nhập mật khẩu mới cho thí sinh vào đây!!" type="password"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Nhập lại
                                    mật khẩu :</label>
                                <div class="col-sm-10">
                                    <input name="password_confirmation" id="password_confirmation"
                                        placeholder="Nhập lại mật khẩu mới cho thí sinh vào đây!!" type="password"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="images" class="col-sm-2 col-form-label">Hình ảnh thí sinh
                                    :</label>
                                <div class="picture">
                                    <img src="" class="picture-src" id="wizardPicturePreview" title="" />
                                    <input type="file" class="valid" id="wizard-picture" aria-invalid="false"
                                        accept="image/*" name="images">
                                </div>
                            </div>
                            <div class="position-relative row form-check">
                                <div class="col-sm-10 offset-sm-2">
                                    @if (!isset($students))
                                        <button type="submit" class="btn btn-secondary">Lưu dữ liệu</button>
                                    @else
                                        <button type="submit" class="btn btn-secondary">Cập nhật dữ liệu</button>
                                    @endif
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#wizard-picture").on('change', function() {
                    readURL(this);
                });
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#wizardPicturePreview").attr("src", e.target.result).fadeIn("slow");
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
