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
                        <div>Liệt kê các môn học</div>
                    </div>
                    @can('subjects.create')
                        <div class="page-title-actions">
                            <div class="d-inline-block">
                                <a href="{{ route('subjects.create') }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Thêm các môn học
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
                                <th>Tên môn học</th>
                                <th>Trạng thái môn học</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects_list as $key => $list)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        @can('updateStatusSubjects')
                                            <input class="subjects_status" id="toggle-demo"
                                                data-subject-id="{{ $list->id }}" type="checkbox" data-on="Hiển thị"
                                                data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                        @else
                                            <span class="badge badge-{{ $list->status == 1 ? 'success' : 'danger' }}">
                                                {{ $list->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        @endcan
                                    </td>
                                    <td>
                                        <form id="delete-subject-form-{{ $list->id }}" method="POST"
                                            action="{{ route('subjects.destroy', $list->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            @can('subjects.edit')
                                                <a href="{{ route('subjects.edit', $list->id) }}" class="btn btn-secondary">
                                                    <i class="pe-7s-note"></i>
                                                </a>
                                            @endcan
                                            @can('subjects.destroy')
                                                <button type="button" class="btn btn-danger delete-subject-button"
                                                    data-subject-id="{{ $list->id }}">
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
            const updateStatusSubjects = "{{ route('updateStatusSubjects') }}";

            $(document).ready(function() {
                $('.subjects_status').change(function() {
                    var subjectId = $(this).data('subject-id');
                    var checked = $(this).prop('checked') ? 0 : 1;
                    $.ajax({
                        type: 'POST',
                        url: updateStatusSubjects,
                        data: {
                            id: subjectId,
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
                document.querySelectorAll('.delete-subject-button').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var subjectId = this.getAttribute('data-subject-id');
                        Swal.fire({
                            title: 'Xác nhận xoá môn học',
                            text: "Bạn có chắc chắn muốn xoá môn học này không?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Xoá',
                            cancelButtonText: 'Hủy',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('delete-subject-form-' + subjectId).submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
