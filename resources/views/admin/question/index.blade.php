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
                            <div>Liệt kê các câu hỏi theo đề</div>
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
                                    <th>Câu hỏi môn học</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $unique_subjects = [];
                                    $count = 0;
                                @endphp
                                @foreach ($question_list as $key => $list)
                                    @if (!in_array($list->subject->name, $unique_subjects))
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>
                                                <a class="btn mr-2 mb-2 btn-primary"
                                                    href="{{ route('questions.show', $list->subject_id) }}">{{ $list->subject->name }}</a>
                                            </td>
                                        </tr>
                                        @php
                                            $unique_subjects[] = $list->subject->name;
                                        @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Thêm file từ Excel</h5>
                            <form action="{{ route('questions.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="position-relative form-group">
                                    <label for="subject_id">Môn học:</label>
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <option selected disabled>-------Chọn môn học-------</option>
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

                document.getElementById('subject_id').addEventListener('change', function() {
                    var selectedSubjectId = this.value;
                    document.getElementById('selected_subject_id').value = selectedSubjectId;
                });
            </script>
        @endpush
    @else
        <script>
            window.location = "/";
        </script>
    @endif
@endsection
