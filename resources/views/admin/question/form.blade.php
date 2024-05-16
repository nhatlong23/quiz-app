@extends('layouts.app')

@section('content')
    @if (Auth::id())
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="pe-7s-graph text-success"></i>
                            </div>
                            @if (!isset($students))
                                <div>Thêm câu hỏi</div>
                            @else
                                <div>Sửa câu hỏi</div>
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
                                @if (!isset($questions))
                                    <form method="POST" action="{{ route('questions.store') }}"
                                        enctype="multipart/form-data">
                                    @else
                                        <form method="POST" action="{{ route('questions.update', $questions->id) }}"
                                            enctype="multipart/form-data">
                                            @method('PUT')
                                @endif
                                @csrf
                                <div class="position-relative row form-group">
                                    <label for="subject_id" class="col-sm-2 col-form-label">Môn học :</label>
                                    <div class="col-sm-10">
                                        <select name="subject_id" id="subject_id" class="form-control">
                                            <option selected disabled>-------Chọn môn học-------</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ isset($questions) && $questions->subject_id == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="question" class="col-sm-2 col-form-label">Nội dung :</label>
                                    <div class="col-sm-10">
                                        <input name="question" id="question" placeholder="Nhập nội dung câu hỏi vào đây!!"
                                            type="text" class="form-control"
                                            value="{{ isset($questions) ? $questions->question : '' }}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="option_a" class="col-sm-2 col-form-label">Phương án A :</label>
                                    <div class="input-group-prepend col-sm-10">
                                        <div class="input-group-text">
                                            <input type="radio" id="radio_a" name="answer" value="A"
                                                {{ isset($questions) && $questions->answer === 'A' ? 'checked' : '' }}>
                                        </div>
                                        <input name="option_a" id="option_a" placeholder="Nhập đáp án A vào đây!!"
                                            type="text" class="form-control"
                                            value="{{ isset($questions) ? $questions->option_a : '' }}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="option_b" class="col-sm-2 col-form-label">Phương án B :</label>
                                    <div class="input-group-prepend col-sm-10">
                                        <div class="input-group-text">
                                            <input type="radio" id="radio_b" name="answer" value="B"
                                                {{ isset($questions) && $questions->answer === 'B' ? 'checked' : '' }}>
                                        </div>
                                        <input name="option_b" id="option_b" placeholder="Nhập đáp án B vào đây!!"
                                            type="text" class="form-control"
                                            value="{{ isset($questions) ? $questions->option_b : '' }}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="option_c" class="col-sm-2 col-form-label">Phương án C :</label>
                                    <div class="input-group-prepend col-sm-10">
                                        <div class="input-group-text">
                                            <input type="radio" id="radio_c" name="answer" value="C"
                                                {{ isset($questions) && $questions->answer === 'C' ? 'checked' : '' }}>
                                        </div>
                                        <input name="option_c" id="option_c" placeholder="Nhập đáp án C vào đây!!"
                                            type="text" class="form-control"
                                            value="{{ isset($questions) ? $questions->option_c : '' }}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="option_d" class="col-sm-2 col-form-label">Phương án D :</label>
                                    <div class="input-group-prepend col-sm-10">
                                        <div class="input-group-text">
                                            <input type="radio" id="radio_d" name="answer" value="D"
                                                {{ isset($questions) && $questions->answer === 'D' ? 'checked' : '' }}>
                                        </div>
                                        <input name="option_d" id="option_d" placeholder="Nhập đáp án D vào đây!!"
                                            type="text" class="form-control"
                                            value="{{ isset($questions) ? $questions->option_d : '' }}">
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="picture" class="col-sm-2 col-form-label">Hình ảnh câu hỏi
                                        :</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="valid" id="" aria-invalid="false"
                                            accept="image/*" name="picture">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="levels" class="col-sm-2 col-form-label">Mức độ câu hỏi:</label>
                                    <div class="col-sm-10">
                                        @foreach ($levels as $level)
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="level_{{ $level->id }}"
                                                    class="custom-control-input" name="level_id"
                                                    value="{{ $level->id }}"
                                                    {{ isset($questions) && $questions->level_id == $level->id ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="level_{{ $level->id }}">{{ $level->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="status" class="col-sm-2 col-form-label">Trạng thái câu hỏi
                                        :</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control">
                                            <option value="1"
                                                {{ isset($questions) && $questions->status == 1 ? 'selected' : '' }}>
                                                Hiển thị câu hỏi</option>
                                            <option value="0"
                                                {{ isset($questions) && $questions->status == 0 ? 'selected' : '' }}>
                                                Ẩn câu hỏi</option>
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
            <script>
                $(document).ready(function() {
                    $("form").submit(function() {
                        var subjectId = $("#subject_id").val();
                        if (subjectId === null) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi...',
                                text: 'Vui lòng chọn môn học!',
                                timer: 1500,
                                showConfirmButton: true,
                                timerProgressBar: true,
                            });
                            return false;
                        }
                    });
                });
            </script>
        @endpush
    @else
        <script>
            window.location = "/";
        </script>
    @endif
@endsection
