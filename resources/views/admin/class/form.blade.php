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
                        @if (!isset($class))
                            <div>Thêm lớp học</div>
                        @else
                            <div>Sửa lớp học</div>
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
                            @if (!isset($class))
                                <form method="POST" action="{{ route('class.store') }}">
                                @else
                                    <form method="POST" action="{{ route('class.update', $class->id) }}">
                                        @method('PUT')
                            @endif
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-sm-2 col-form-label">Tên lớp học :</label>
                                <div class="col-sm-10">
                                    <input name="name" id="name" placeholder="Nhập tên lớp vào đây!!" type="text"
                                        class="form-control" autocomplete="off"
                                        value="{{ isset($class) ? $class->name : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="desc" class="col-sm-2 col-form-label">Mô tả lớp học :</label>
                                <div class="col-sm-10">
                                    <input name="desc" id="desc" placeholder="Nhập mô tả lớp học vào đây!!"
                                        type="text" class="form-control" autocomplete="off"
                                        value="{{ isset($class) ? $class->desc : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="block_id" class="col-sm-2 col-form-label">Khối lớp học :</label>
                                <div class="col-sm-10">
                                    <select name="block_id" class="form-control">
                                        <option selected disabled>-------Chọn lớp học-------</option>
                                        @foreach ($blocks_name as $block_name)
                                            <option value="{{ $block_name->id }}"
                                                {{ isset($class) && $class->block_id == $block_name->id ? 'selected' : '' }}>
                                                {{ $block_name->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="number" class="col-sm-2 col-form-label">Sĩ số lớp học :</label>
                                <div class="col-sm-10">
                                    <input name="number" id="number" placeholder="Nhập sĩ số lớp học vào đây!!"
                                        type="number" class="form-control" autocomplete="off"
                                        value="{{ isset($class) ? $class->number : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="status" class="col-sm-2 col-form-label">Trạng thái lớp học :</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        <option value="1" {{ isset($class) && $class->status == 1 ? 'selected' : '' }}>
                                            Hiển thị lớp học
                                        </option>
                                        <option value="0"
                                            {{ isset($class) && $class->status == 0 ? 'selected' : '' }}>Ẩn lớp học
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative row form-check">
                                <div class="col-sm-10 offset-sm-2">
                                    @if (!isset($class))
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
@endsection
