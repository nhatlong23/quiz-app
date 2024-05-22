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
                        <div>Liệt kê kết quả thí sinh</div>
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
                                <th>Tên sinh viên</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result_list as $key => $list)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>
                                        @can('result.view')
                                            <a href="{{ route('result.show', $list->students_id) }}" class="btn btn-secondary">
                                                {{ $list->result_student ? $list->result_student->name : 'N/A' }}
                                            </a>
                                        @else
                                            {{ $list->result_student ? $list->result_student->name : 'N/A' }}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
