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
                        <div>Sửa thông tin website</div>
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
                            <form method="POST" action="{{ route('infos.update', $infos->id) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="position-relative row form-group">
                                    <label for="name" class="col-sm-2 col-form-label">Tên website :</label>
                                    <div class="col-sm-10">
                                        <input name="name" id="name" placeholder="Nhập tên website vào đây!!"
                                            type="text" class="form-control"
                                            value="{{ isset($infos) ? $infos->name : '' }}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="name" class="col-sm-2 col-form-label">Địa chỉ website :</label>
                                    <div class="col-sm-10">
                                        <input name="address" id="address" placeholder="Nhập địa chỉ website vào đây!!"
                                            type="text" class="form-control"
                                            value="{{ isset($infos) ? $infos->address : '' }}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="name" class="col-sm-2 col-form-label">Số điện thoại website :</label>
                                    <div class="col-sm-10">
                                        <input name="phone" id="phone"
                                            placeholder="Nhập số điện thoại website vào đây!!" type="text"
                                            class="form-control" value="{{ isset($infos) ? $infos->phone : '' }}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="name" class="col-sm-2 col-form-label">Email website :</label>
                                    <div class="col-sm-10">
                                        <input name="email" id="email" placeholder="Nhập email website vào đây!!"
                                            type="text" class="form-control"
                                            value="{{ isset($infos) ? $infos->email : '' }}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="name" class="col-sm-2 col-form-label">Map website :</label>
                                    <div class="col-sm-10">
                                        <input name="map" id="map" placeholder="Nhập map website vào đây!!"
                                            type="text" class="form-control"
                                            value="{{ isset($infos) ? $infos->map : '' }}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="about" class="col-sm-2 col-form-label">Giới thiệu website :</label>
                                    <div class="col-sm-10">
                                        <textarea name="about" id="about"> {{ isset($infos) ? $infos->about : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="terms_of_service" class="col-sm-2 col-form-label">Điều khoản website :</label>
                                    <div class="col-sm-10">
                                        <textarea name="terms_of_service" id="terms_of_service"> {{ isset($infos) ? $infos->terms_of_service : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="privacy_policy" class="col-sm-2 col-form-label">Chính sách quyền riêng tư website :</label>
                                    <div class="col-sm-10">
                                        <textarea name="privacy_policy" id="privacy_policy"> {{ isset($infos) ? $infos->privacy_policy : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="logo" class="col-sm-2 col-form-label">Logo website :</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="valid" aria-invalid="false" accept="image/*" name="logo">
                                        <img src="{{ asset($infos->logo) }}" title="" />
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="favicon" class="col-sm-2 col-form-label">Favicon website :</label>
                                    <div class="picture" class="col-sm-10">
                                        <img src="{{ asset($infos->favicon) }}" class="picture-src"
                                            id="wizardPicturePreview" title="" />
                                        <input type="file" class="valid" id="wizard-picture" aria-invalid="false"
                                            accept="image/*" name="favicon">
                                    </div>
                                </div>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        @if (!isset($infos))
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

            ClassicEditor.create(document.querySelector('#about'))
            ClassicEditor.create(document.querySelector('#terms_of_service'))
            ClassicEditor.create(document.querySelector('#privacy_policy'))
        </script>
    @endpush
@endsection
