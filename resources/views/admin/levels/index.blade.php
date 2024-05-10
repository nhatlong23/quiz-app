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
                            <div>Liệt kê các mức độ câu hỏi</div>
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
                                    <th>Tên mức độ câu hỏi</th>
                                    <th>Mô tả mức độ</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($levels_list as $key => $list)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->desc }}</td>
                                        <td>
                                            <input class="levels_status" id="toggle-demo"
                                                data-levels-id="{{ $list->id }}" type="checkbox" data-on="Hiển thị"
                                                data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('levels.destroy', $list->id) }}"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('levels.edit', $list->id) }}" class="btn btn-secondary">
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
        @push('scripts')
            <script>
                const updateStatusLevels = "{{ route('updateStatusLevels') }}";

                $(document).ready(function() {
                    $('.levels_status').each(function() {
                        $(this).bootstrapToggle();
                    });

                    $('.levels_status').change(function() {
                        var levelsId = $(this).data('levels-id');
                        var checked = $(this).prop('checked') ? 0 : 1;
                        $.ajax({
                            type: 'POST',
                            url: updateStatusLevels,
                            data: {
                                id: levelsId,
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
            </script>
        @endpush
    @else
        <script>
            window.location = "/";
        </script>
    @endif
@endsection
