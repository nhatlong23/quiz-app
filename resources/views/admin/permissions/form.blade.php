@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-graph text-success"></i>
                        </div>
                        @if (!isset($permissions))
                            <div>Thêm route quyền</div>
                        @else
                            <div>Sửa route quyền</div>
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
                            @if (!isset($permissions))
                                <form method="POST" action="{{ route('permissions.store') }}"
                                    enctype="multipart/form-data">
                                @else
                                    <form method="POST" action="{{ route('permissions.update', $permissions->id) }}"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                            @endif
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-sm-2 col-form-label">Tên route :</label>
                                <div class="col-sm-10">
                                    <input name="name" id="name" placeholder="Nhập tên route vào đây!!"
                                        type="text" class="form-control"
                                        value="{{ isset($permissions) ? $permissions->name : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="description" class="col-sm-2 col-form-label">Mô tả route :</label>
                                <div class="col-sm-10">
                                    <input name="description" id="description" placeholder="Nhập mô tả route vào đây!!"
                                        type="text" class="form-control"
                                        value="{{ isset($permissions) ? $permissions->description : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="key_code" class="col-sm-2 col-form-label">Tên route :</label>
                                <div class="col-sm-10">
                                    <input name="key_code" id="key_code" placeholder="Nhập tên route vào đây!!"
                                        type="text" class="form-control"
                                        value="{{ isset($permissions) ? $permissions->key_code : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="parent_id" class="col-sm-2 col-form-label">Route Web :</label>
                                <div class="col-sm-10">
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option selected disabled>-------Chọn danh mục cha-------</option>
                                        {!! $htmlOptions !!}
                                    </select>
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
        <script></script>
    @endpush
@endsection
