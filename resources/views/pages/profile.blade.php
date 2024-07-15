@extends('welcome')

@section('homepages')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Hồ sơ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .img-account-profile {
            height: 10rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }
    </style>
    @php
        $user_name = Auth::guard('students')->user()->name;
        $user_student_code = Auth::guard('students')->user()->student_code;
        $user_phone = Auth::guard('students')->user()->phone;
        $user_birth = Auth::guard('students')->user()->birth;
        $user_email = Auth::guard('students')->user()->email;
        $user_cccd = Auth::guard('students')->user()->cccd;
        $user_images = Auth::guard('students')->user()->images;
        $user_gender = Auth::guard('students')->user()->gender;
    @endphp
    <div class="container-xl px-4 mt-4">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('save_profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Hình ảnh sinh viên</div>
                        <div class="card-body text-center">
                            @if ($user_images)
                                <img class="img-account-profile rounded-circle mb-2" src="{{ $user_images }}"
                                    alt="">
                            @else
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                            @endif
                            <div class="small font-italic text-muted mb-4">JPG hoặc PNG không lớn hơn 5 MB</div>
                            <div class="mb-3">
                                <input type="file" class="file-upload" name="images" accept="image/*">
                            </div>
                            {{-- <button class="btn btn-primary" type="file">Tải lên hình ảnh mới</button> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Chi tiết tài khoản</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="student_code">Mã sinh viên</label>
                                <input class="form-control" id="student_code" type="text"
                                    value="{{ $user_student_code }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Địa chỉ email</label>
                                <input class="form-control" id="email" type="email" value="{{ $user_email }}"
                                    disabled>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="name">Tên sinh viên</label>
                                    <input class="form-control" id="name" name="name" type="text"
                                        placeholder="{{ $user_name }}" value="{{ $user_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="cccd">Số CCCD</label>
                                    <input class="form-control" id="cccd" name="cccd" type="number"
                                        placeholder="{{ $user_cccd }}" value="{{ $user_cccd }}">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="phone">Số điện thoại</label>
                                    <input class="form-control" id="phone" name="phone" type="number"
                                        placeholder="{{ $user_phone }}" value="{{ $user_phone }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="birth">Ngày sinh</label>
                                    <input class="form-control" id="birth" type="date" name="birth"
                                        placeholder="{{ $user_birth }}" value="{{ $user_birth }}">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="gender">Giới tính</label>
                                    <select name="gender" class="form-control h-75 d-inline-block">
                                        <option value="male" {{ $user_gender == 'male' ? 'selected' : '' }}>Nam
                                        </option>
                                        <option value="female" {{ $user_gender == 'female' ? 'selected' : '' }}>Nữ
                                        </option>
                                        <option value="other" {{ $user_gender == 'other' ? 'selected' : '' }}>Khác
                                        </option>
                                        <option value="unknown" {{ $user_gender == 'unknown' ? 'selected' : '' }}>Không xác
                                            định</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="current_password">Mật khẩu cũ</label>
                                    <input class="form-control" id="current_password" name="current_password"
                                        type="password" placeholder="Nhập mật khẩu cũ để đổi mật khẩu">
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="password">Nhập mật khẩu mới</label>
                                    <input class="form-control" id="password" name="password" type="password"
                                        placeholder="Nhập mật khẩu mới vào đây">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="confirm_password">Nhập lại mật khẩu mới</label>
                                    <input class="form-control" id="confirm_password" type="password"
                                        name="confirm_password" placeholder="Nhập lại mật khẩu mới">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                var readURL = function(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('.avatar').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $(".file-upload").on('change', function() {
                    readURL(this);
                });
            });
        </script>
    @endpush
@endsection
