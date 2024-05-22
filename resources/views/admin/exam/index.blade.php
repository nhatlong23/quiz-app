@extends('layouts.app')
@section('content')
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
                    @can('exams.create')
                        <div class="page-title-actions">
                            <div class="d-inline-block">
                                <a href="{{ route('exams.create') }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Thêm đề thi
                                </a>
                            </div>
                        </div>
                    @endcan
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
                                        @can('quick_view_exam')
                                            <form method="POST" action="{{ route('quick_view_exam') }}">
                                                @csrf
                                                <input type="hidden" name="id_exam" value="{{ $list->id }}">
                                                <input type="hidden" name="subjects_id" value="{{ $list->exam_subject->id }}">
                                                <button type="button"
                                                    class="btn mr-2 mb-2 btn-shadow btn-alternate quick_view_exam_button"
                                                    data-toggle="modal" data-target=".quick_view_exam"
                                                    data-exam-id="{{ $list->id }}">
                                                    {{ $list->content }}
                                                </button>
                                            </form>
                                        @else
                                            {{ $list->content }}
                                        @endcan
                                    </td>
                                    <td>{{ $list->exam_subject->name }}</td>
                                    <td>{{ $list->max_questions }}</td>
                                    <td>{{ $list->formatted_opening_time }}</td>
                                    <td>{{ $list->formatted_closing_time }}</td>
                                    <td>
                                        @can('updateStatusExams')
                                            <input class="exams_status" id="toggle-demo" data-exam-id="{{ $list->id }}"
                                                type="checkbox" data-on="Hiển thị" data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                        @else
                                            <span class="badge badge-{{ $list->status == 1 ? 'success' : 'danger' }}">
                                                {{ $list->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        @endcan
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('exams.destroy', $list->id) }}"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa đề thi này?')">
                                            @csrf
                                            @method('DELETE')
                                            @can('exams.edit')
                                                <a href="{{ route('exams.edit', $list->id) }}" class="btn btn-secondary">
                                                    <i class="pe-7s-note"></i>
                                                </a>
                                            @endcan
                                            @can('exams.destroy')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="pe-7s-trash"></i>
                                                </button>
                                            @endcan
                                            @can('addExamToClass')
                                                <button type="button"
                                                    class="btn btn-shadow btn-primary add_exam_to_class_button"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    data-exam-model-id="{{ $list->id }}">
                                                    <i class="pe-7s-plus"></i>
                                                </button>
                                            @endcan
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
        <div class="modal fade quick_view_exam" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quick_view_exam_title"></h5>
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
                                            <th>STT</th>
                                            <th>Câu hỏi</th>
                                            <th>Đáp án A</th>
                                            <th>Đáp án B</th>
                                            <th>Đáp án C</th>
                                            <th>Đáp án D</th>
                                            <th>Câu trả lời</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="example_tbody"></tbody>
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

        {{-- add exam to class --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm đề thi vào lớp</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="position-relative row form-group">
                            @if (isset($class_list))
                                <select class="form-select form-control">
                                    <option disabled selected>------Chọn lớp học------</option>
                                    @foreach ($class_list as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach

                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" id="saveChanges">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        <script>
            const updateStatusExams = "{{ route('updateStatusExams') }}";
            const quickViewExamRequest = "{{ route('quick_view_exam') }}";
            const addExamToClass = "{{ route('addExamToClass') }}";
            const deleteQuestionFromExam = "{{ route('deleteQuestionFromExam') }}";

            $(document).ready(function() {
                $('.exams_status').each(function() {
                    $(this).bootstrapToggle();
                });

                $('.exams_status').change(function() {
                    var examId = $(this).data('exam-id');
                    var checked = $(this).prop('checked') ? 0 : 1;
                    $.ajax({
                        type: 'POST',
                        url: updateStatusExams,
                        data: {
                            id: examId,
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
                $('.quick_view_exam_button').click(function() {
                    var exam_id = $(this).siblings('input[name="id_exam"]').val();
                    var subjects_id = $(this).siblings('input[name="subjects_id"]').val();

                    $('.quick_view_exam').attr('data-exam-id', exam_id);

                    $.ajax({
                        url: quickViewExamRequest,
                        type: 'POST',
                        data: {
                            id_exam: exam_id,
                            subjects_id: subjects_id,
                            _token: csrfToken,
                        },
                        success: function(response) {
                            $('#quick_view_exam_title').text(response.subject + ' - ' + response
                                .content);

                            $('#example_tbody').empty();

                            $.each(response.questions, function(index, question) {
                                var row = '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + question.question + '</td>' +
                                    '<td>' + question.option_a + '</td>' +
                                    '<td>' + question.option_b + '</td>' +
                                    '<td>' + question.option_c + '</td>' +
                                    '<td>' + question.option_d + '</td>' +
                                    '<td>' + question.answer + '</td>' +
                                    '<td>' + question.status + '</td>' +
                                    '<td><button data-question-id="' + question.id +
                                    '" class="btn btn-danger delete-question">Xoá</button></td>' +
                                    '</tr>';
                                $('#example_tbody').append(row);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });

            $(document).on('click', '.delete-question', function() {
                var confirmation = confirm("Bạn có chắc chắn muốn xoá câu hỏi này?");
                if (confirmation) {
                    var questionId = $(this).data('question-id');
                    var examId = $('.quick_view_exam').attr('data-exam-id');

                    $.ajax({
                        type: 'POST',
                        url: deleteQuestionFromExam,
                        data: {
                            question_id: questionId,
                            exam_id: examId,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                text: response.message,
                                timer: 3000,
                                timerProgressBar: true,
                            }).then(function() {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: 'success',
                                text: 'Đã có lỗi',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    });
                }
            });

            document.addEventListener("DOMContentLoaded", function() {
                var selectedClassId;
                var examId;

                document.getElementById('saveChanges').addEventListener('click', function() {
                    if (selectedClassId && examId) {
                        $.ajax({
                            type: "POST",
                            url: addExamToClass,
                            data: {
                                class_id: selectedClassId,
                                exam_id: examId,
                                _token: csrfToken,
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    text: response.message,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: "Oops...",
                            text: "Vui lòng chọn lớp trước khi lưu.",
                        });
                    }
                });

                var formSelect = document.querySelectorAll('.form-select');
                formSelect.forEach(function(select) {
                    select.addEventListener('change', function() {
                        selectedClassId = this.value;
                        // console.log("ID của lớp đã chọn:", selectedClassId);
                    });
                });

                var addExamButtons = document.querySelectorAll('.add_exam_to_class_button');
                addExamButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        examId = this.dataset.examModelId;
                        // console.log("ID của đề thi:", examId);
                    });
                });
            });
        </script>
    @endpush
@endsection
