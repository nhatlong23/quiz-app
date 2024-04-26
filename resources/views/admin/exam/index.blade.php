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
                            <div>Liệt kê các đề thi</div>
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
                                    <th>Tên đề thi</th>
                                    <th>Môn thi</th>
                                    <th>Số câu hỏi</th>
                                    <th>Thời gian bắt đầu thi</th>
                                    <th>Thời gian kết thúc thi</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($exams_list as $key => $list)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('quick_view_exam') }}">
                                                @csrf
                                                <input type="hidden" name="id_exam" value="{{ $list->id }}">
                                                <input type="hidden" name="subjects_id" value="{{ $list->exam_subject->id }}">
                                                <button type="button" class="btn mr-2 mb-2 btn-shadow btn-alternate quick_view_exam_button"
                                                    data-toggle="modal" data-target=".quick_view_exam"
                                                    data-exam="{{ $list->content }}">
                                                    {{ $list->content }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $list->exam_subject->name }}</td>
                                        <td>{{ $list->max_questions }}</td>
                                        <td>{{ $list->opening_time }}</td>
                                        <td>{{ $list->closing_time }}</td>
                                        <td>
                                            @if ($list->status == 1)
                                                Hiển thị
                                            @else
                                                Ẩn
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('exams.destroy', $list->id) }}"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa đề thi này?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('exams.edit', $list->id) }}" class="btn btn-secondary">
                                                    <i class="pe-7s-note"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger"><i class="pe-7s-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <script>
            window.location = "/";
        </script>
    @endif
@endsection
