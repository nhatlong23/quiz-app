@extends('welcome')

@section('homepages')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Chi tiết lịch sử thi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container spad">
        <h2>Chi tiết lịch sử thi</h2>
        <hr>
        <div id="accordion">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Câu hỏi</th>
                        <th scope="col">Đáp án A</th>
                        <th scope="col">Đáp án B</th>
                        <th scope="col">Đáp án C</th>
                        <th scope="col">Đáp án D</th>
                        <th scope="col">Câu trả lời</th>
                        <th scope="col">Đáp án</th>
                        <th scope="col">Hoàn thành</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultQuestions as $key => $result)
                        <tr @if ($result->selected_option == $result->question->answer) class="font-weight-bold" @endif>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $result->question->question }}</td>
                            <td>{{ $result->question->option_a }}</td>
                            <td>{{ $result->question->option_b }}</td>
                            <td>{{ $result->question->option_c }}</td>
                            <td>{{ $result->question->option_d }}</td>
                            <td>
                                @if ($result->selected_option == 'no_answer')
                                    Không trả lời
                                @else
                                    {{ $result->selected_option }}
                                    @if ($result->selected_option == $result->question->answer)
                                        <i class="fa fa-check text-success"></i>
                                    @endif
                                @endif
                            </td>
                            <td>{{ $result->question->answer }}</td>
                            <td>{{ $result->question->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <br>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
@endsection
