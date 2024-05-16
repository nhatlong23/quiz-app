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
                                @foreach ($questions as $key => $list)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('quick_view_question') }}">
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
                                            <input class="question_status" id="toggle-demo"
                                                data-question-id="{{ $list->id }}" type="checkbox" data-on="Hiển thị"
                                                data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
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
            </div>
        </div>
        @push('model')
            <div class="modal fade quick_view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="subject"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <table style="width: 100%;" id="example"
                                        class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Câu hỏi</th>
                                                <th>Đáp án A</th>
                                                <th>Đáp án B</th>
                                                <th>Đáp án C</th>
                                                <th>Đáp án D</th>
                                                <th>Đáp án đúng</th>
                                                <th>Mức độ</th>
                                                <th>Hình ảnh</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="question"></td>
                                                <td id="option_a"></td>
                                                <td id="option_b"></td>
                                                <td id="option_c"></td>
                                                <td id="option_d"></td>
                                                <td id="answer"></td>
                                                <td id="level"></td>
                                                <td id="picture"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endpush

        @push('scripts')
            <script>
                const updateStatusQuestions = "{{ route('updateStatusQuestions') }}";
                const quickViewQuestion = "{{ route('quick_view_question') }}";

                $(document).ready(function() {
                    $('.question_status').each(function() {
                        $(this).bootstrapToggle();
                    });

                    $('.question_status').change(function() {
                        var questionId = $(this).data('question-id');
                        var checked = $(this).prop('checked') ? 0 : 1;
                        $.ajax({
                            type: 'POST',
                            url: updateStatusQuestions,
                            data: {
                                id: questionId,
                                checked: checked,
                                _token: csrfToken,
                            },
                            success: function(response) {
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    });
                });

                $(document).ready(function() {
                    $('.quick_view_button').click(function() {
                        var question = $(this).data('question');
                        $('#quick_view_question').text(question);
                        $('#quick_view_subject').text(subject);

                        var question_id = $(this).siblings('input[name="id_questions"]').val();
                        var subject_id = $(this).siblings('input[name="id_subjects"]').val();
                        $.ajax({
                            url: quickViewQuestion,
                            type: 'POST',
                            data: {
                                id_questions: question_id,
                                id_subjects: subject_id,
                                _token: csrfToken,
                            },
                            success: function(response) {
                                $('#question').text(response.question);
                                $('#option_a').text(response.option_a);
                                $('#option_b').text(response.option_b);
                                $('#option_c').text(response.option_c);
                                $('#option_d').text(response.option_d);
                                $('#answer').text(response.answer);
                                $('#picture').text(response.picture);
                                $('#subject').text(response.subject);
                                $('#level').text(response.level);
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
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
