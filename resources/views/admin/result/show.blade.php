@extends('layouts.app')
@section('content')
    <style>
        .dash-text::before {
            content: " - ";
        }
    </style>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
                        </div>
                        <div>Liệt kê bài thi từ sinh viên</div>
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
            <div class="card" style="width: 18rem;">
                @if ($student->images == null)
                    <img class="card-img-top" src="https://www.w3schools.com/howto/img_avatar.png" alt="Card image cap">
                @else
                    <img class="card-img-top" src="{{ $student->images }}" alt="Card image cap">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $student->name }} - {{ $student->student_code }}</h5>
                    <p class="card-text dash-text">Lớp học: {{ $student->student_class->name }}</p>
                    <p class="card-text dash-text">Giới tính: {{ $student->gender }}</p>
                    <p class="card-text dash-text">Năm học: {{ $student->school_year }}</p>
                    <p class="card-text dash-text">Số điện thoại: {{ $student->phone }}</p>
                    <p class="card-text dash-text">CCCD: {{ $student->cccd }}</p>
                    <p class="card-text dash-text">Email: {{ $student->email }}</p>
                </div>
            </div>
            <br>
            @foreach ($results as $result)
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h2>{{ $result->result_exam->content }} -- {{ $result->created_at }}</h2>
                        <table class="data-table table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Câu hỏi</th>
                                    <th>Đáp án A</th>
                                    <th>Đáp án B</th>
                                    <th>Đáp án C</th>
                                    <th>Đáp án D</th>
                                    <th>Câu trả lời</th>
                                    <th>Đáp án</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $stt = 1; @endphp
                                @foreach ($resultQuestions as $question)
                                    @if ($question->exam_id == $result->exam_id)
                                        <tr @if ($question->selected_option == $question->question->answer) style="font-weight: bold;" @endif>
                                            <td>{{ $stt++ }}</td>
                                            <td>{{ $question->question->question }}</td>
                                            <td>{{ $question->question->option_a }}</td>
                                            <td>{{ $question->question->option_b }}</td>
                                            <td>{{ $question->question->option_c }}</td>
                                            <td>{{ $question->question->option_d }}</td>
                                            <td>
                                                @if ($question->selected_option == $question->question->answer)
                                                    {{ $question->selected_option }} ✔
                                                @else
                                                    {{ $question->selected_option }}
                                                @endif
                                            </td>
                                            <td>{{ $question->question->answer }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>{{ $result->point }} Điểm</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript" src="{{ asset('backend/scripts/dataTables.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('backend/css/dataTables.min.css') }}">

        <script>
            $(document).ready(function() {
                $('.data-table').DataTable();
            });
        </script>
    @endpush
@endsection
