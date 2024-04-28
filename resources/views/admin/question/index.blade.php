@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
                            </div>
                            <div>Liệt kê các Câu hỏi</div>
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
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Câu hỏi</th>
                                    <th>Môn học</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($question_list as $key => $list)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('quick_view') }}">
                                                @csrf
                                                <input type="hidden" name="id_questions" value="{{ $list->id }}">
                                                <input type="hidden" name="id_subjects" value="{{ $list->subject->id }}">
                                                <button type="button" class="btn mr-2 mb-2 btn-primary quick_view_button"
                                                    data-toggle="modal" data-target=".quick_view"
                                                    data-question="{{ $list->question }}">
                                                    {{ $list->question }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $list->subject->name }}</td>
                                        <td>
                                        <td>
                                            <input class="question_status" id="toggle-demo"
                                                data-question-id="{{ $list->id }}" type="checkbox" data-on="Hiển thị"
                                                data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                        </td>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('questions.destroy', $list->id) }}"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('questions.edit', $list->id) }}"
                                                    class="btn btn-secondary">
                                                    <i class="pe-7s-note"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="pe-7s-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Thêm file từ Excel</h5>
                            <form action="{{ route('questions.import') }}" method="POST" enctype="multipart/form-data"
                                class="">
                                @csrf
                                <div class="position-relative form-group">
                                    <label for="subject_id">Môn học:</label>
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="selected_subject_id" id="selected_subject_id">
                                <div class="position-relative form-group">
                                    <label for="file_import">File:</label>
                                    <input name="file_import" id="file_import" type="file" class="form-control-file"
                                        accept=".xlsx, .xls, .csv" required>
                                </div>
                                <button type="submit" class="mt-1 btn btn-primary">Thêm từ file Excel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('subject_id').addEventListener('change', function() {
                var selectedSubjectId = this.value;
                document.getElementById('selected_subject_id').value = selectedSubjectId;
            });
        </script>
    @else
        <script>
            window.location = "/";
        </script>
    @endif
@endsection
