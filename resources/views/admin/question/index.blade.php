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
                        <div>Liệt kê các câu hỏi theo đề</div>
                    </div>
                    @can('questions.create')
                        <div class="page-title-actions">
                            <div class="d-inline-block">
                                <a href="{{ route('questions.create') }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Thêm câu hỏi
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
                                        <td>{{ $count }}</td>
                                        @can('questions.view')
                                            <td>
                                                <a class="btn mr-2 mb-2 btn-primary"
                                                    href="{{ route('questions.show', $list->subject_id) }}">
                                                    {{ $list->subject->name }}
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                {{ $list->subject->name }}
                                            </td>
                                        @endcan
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
            @can('questions.import')
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
                                <div class="position-relative form-group">
                                    <label for="block_id">Khối học:</label>
                                    <select name="block_id" id="block_id" class="form-control">
                                        <option selected disabled>-------Chọn khối học-------</option>
                                        @foreach ($blocks as $block)
                                            <option value="{{ $block->id }}">
                                                {{ $block->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
            @endcan
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $("form").submit(function() {
                    var subjectId = $("#subject_id").val();
                    var blockId = $("#block_id").val();

                    if (subjectId === null && blockId === null) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi...',
                            text: 'Vui lòng chọn môn học or chọn khối học!',
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
@endsection
