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
                            <div>Liệt kê các lớp học</div>
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
                                    <th>Tên lớp</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($class_list as $key => $list)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('quick_view_class') }}">
                                                @csrf
                                                <input type="hidden" name="id_class" value="{{ $list->id }}">
                                                <input type="hidden" name="id_block" value="{{ $list->block_class->id }}">
                                                <button type="button"
                                                    class="btn mr-2 mb-2 btn-primary quick_view_class_button"
                                                    data-toggle="modal" data-target=".quick_view_class"
                                                    data-question="{{ $list->name }}">
                                                    {{ $list->name }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            @if ($list->status)
                                                Hiển thị lớp
                                            @else
                                                Ẩn lớp
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('class.destroy', $list->id) }}"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('class.edit', $list->id) }}" class="btn btn-secondary">
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
