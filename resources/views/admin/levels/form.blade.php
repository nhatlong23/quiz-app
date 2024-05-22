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
                        @if (!isset($levels))
                            <div>Thêm mức độ câu hỏi</div>
                        @else
                            <div>Sửa mức độ câu hỏi</div>
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
                            @if (!isset($levels))
                                <form method="POST" action="{{ route('levels.store') }}">
                                @else
                                    <form method="POST" action="{{ route('levels.update', $levels->id) }}">
                                        @method('PUT')
                            @endif
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-sm-2 col-form-label">Tên mức độ câu hỏi :</label>
                                <div class="col-sm-10">
                                    <input name="name" id="name" placeholder="Nhập tên mức độ câu hỏi vào đây!!"
                                        type="text" class="form-control" autocomplete="off"
                                        value="{{ isset($levels) ? $levels->name : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="desc" class="col-sm-2 col-form-label">Mô tả mức độ câu hỏi :</label>
                                <div class="col-sm-10">
                                    <input name="desc" id="desc" placeholder="Nhập mô tả mức độ câu hỏi vào đây!!"
                                        type="text" class="form-control" autocomplete="off"
                                        value="{{ isset($levels) ? $levels->desc : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="status" class="col-sm-2 col-form-label">Trạng thái mức độ câu hỏi :</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        <option value="1"
                                            {{ isset($levels) && $levels->status == 1 ? 'selected' : '' }}>Hiển thị mức độ
                                            câu hỏi</option>
                                        <option value="0"
                                            {{ isset($levels) && $levels->status == 0 ? 'selected' : '' }}>Ẩn mức độ câu hỏi
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
