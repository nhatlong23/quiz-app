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
                            <div>Liệt kê các thí sinh</div>
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
                                    <th>Mã thí sinh</th>
                                    <th>Tên thí sinh</th>
                                    <th>Lớp</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students_list as $key => $list)
                                    <tr>
                                        <td>{{ $list->student_code }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('quick_view_students') }}">
                                                @csrf
                                                <input type="hidden" name="id_students" value="{{ $list->id }}">
                                                <input type="hidden" name="class" value="{{ $list->student_class->id }}">
                                                <button type="button" class="btn mr-2 mb-2 btn-primary quick_view_students_button"
                                                    data-toggle="modal" data-target=".quick_view_students"
                                                    data-students="{{ $list->name }}">
                                                    {{ $list->name }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $list->student_class->name }}</td>
                                        <td>
                                            @if ($list->status)
                                                Hiển thị
                                            @else
                                                Ẩn
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('students.destroy', $list->id) }}"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa thí sinh này?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('students.edit', $list->id) }}"
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
    @else
        <script>
            window.location = "/";
        </script>
    @endif
@endsection
