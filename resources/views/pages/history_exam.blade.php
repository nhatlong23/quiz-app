@extends('welcome')

@section('homepages')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Lịch sử thi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container spad">
        <h2>Lịch sử thi</h2>
        <hr>
        <div id="accordion">
            @foreach ($result as $key => $result)
                <div class="card">
                    <div class="card-header">
                        {{ $result->result_student->name }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $result->result_exam->content }} - {{ $result->result_exam->created_at }}</h5>
                        <p class="card-text">{{ $result->point }} Điểm</p>
                        <a href="{{ route('detailExamHistory', $result->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
                <br>
            @endforeach
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
