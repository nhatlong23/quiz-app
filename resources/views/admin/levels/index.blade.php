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
                        <div>Liệt kê các mức độ câu hỏi</div>
                    </div>
                    @can('levels.create')
                        <div class="page-title-actions">
                            <div class="d-inline-block">
                                <a href="{{ route('levels.create') }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Thêm các mức độ câu hỏi
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
                                        @can('updateStatusLevels')
                                            <input class="levels_status" id="toggle-demo" data-levels-id="{{ $list->id }}"
                                                type="checkbox" data-on="Hiển thị" data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                        @else
                                            <span class="badge {{ $list->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                {{ $list->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        @endcan
                                    </td>
                                    <td>
                                        <form method="POST" id="delete-levels-form-{{ $list->id }}"
                                            action="{{ route('levels.destroy', $list->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            @can('levels.edit')
                                                <a href="{{ route('levels.edit', $list->id) }}" class="btn btn-secondary">
                                                    <i class="pe-7s-note"></i>
                                                </a>
                                            @endcan
                                            @can('levels.destroy')
                                                <button type="button" class="btn btn-danger delete-levels-button"
                                                    data-levels-id="{{ $list->id }}">
                                                    <i class="pe-7s-trash"></i>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.delete-levels-button').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var levelsId = this.getAttribute('data-levels-id');
                        Swal.fire({
                            title: 'Xác nhận xoá mức độ câu hỏi',
                            text: "Bạn có chắc chắn muốn xóa mức độ câu hỏi này?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Xoá',
                            cancelButtonText: 'Hủy',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('delete-levels-form-' + levelsId).submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
