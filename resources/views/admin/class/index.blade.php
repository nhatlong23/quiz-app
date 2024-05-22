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
                        <div>Liệt kê các lớp học</div>
                    </div>
                    @can('class.create')
                        <div class="page-title-actions">
                            <div class="d-inline-block">
                                <a href="{{ route('class.create') }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Thêm lớp học
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
                                <th>Tên lớp</th>
                                <th>Mô tả</th>
                                <th>Khối lớp</th>
                                <th>Sỉ số</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($class_list as $key => $list)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @can('quick_view_class')
                                            <form method="POST" action="{{ route('quick_view_class') }}">
                                                @csrf
                                                <input type="hidden" name="id_class" value="{{ $list->id }}">
                                                <input type="hidden" name="id_block" value="{{ $list->block_class->id }}">
                                                <button type="button" class="btn mr-2 mb-2 btn-primary quick_view_class_button"
                                                    data-toggle="modal" data-target=".quick_view_class"
                                                    data-question="{{ $list->name }}">
                                                    {{ $list->name }}
                                                </button>
                                            </form>
                                        @else
                                            {{ $list->name }}
                                        @endcan
                                    </td>
                                    <td>{{ $list->desc }}</td>
                                    <td>{{ $list->block_class->name }}</td>
                                    <td>{{ $list->number }}</td>
                                    <td>
                                        @can('updateStatusClasss')
                                            <input class="classs_status" id="toggle-demo" data-class-id="{{ $list->id }}"
                                                type="checkbox" data-on="Hiển thị" data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                        @else
                                            <span class="badge badge-{{ $list->status == 1 ? 'success' : 'danger' }}">
                                                {{ $list->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        @endcan
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('class.destroy', $list->id) }}"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                            @csrf
                                            @method('DELETE')
                                            @can('class.edit')
                                                <a href="{{ route('class.edit', $list->id) }}" class="btn btn-secondary">
                                                    <i class="pe-7s-note"></i>
                                                </a>
                                            @endcan
                                            @can('class.destroy')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="pe-7s-trash"></i>
                                                </button>
                                            @endcan
                                            @can('class.view')
                                                <a href="{{ route('class.show', $list->id) }}"
                                                    class="btn btn-shadow btn-primary">
                                                    <i class="pe-7s-target"></i>
                                                </a>
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
    @push('model')
        <div class="modal fade quick_view_class" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quick_view_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <table style="width: 100%;" id="example"
                                    class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>MSTS</th>
                                            <th>Tên</th>
                                            <th>Giới tính</th>
                                            <th>Ngày sinh</th>
                                            <th>CCCD</th>
                                            <th>Email</th>
                                            <th>SĐT</th>
                                            <th>Năm học</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody id="quick_view_class"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        <script>
            const updateStatusClasss = "{{ route('updateStatusClasss') }}";
            const quickViewClassRequest = "{{ route('quick_view_class') }}";


            $(document).ready(function() {
                $('.classs_status').each(function() {
                    $(this).bootstrapToggle();
                });

                $('.classs_status').change(function() {
                    var classId = $(this).data('class-id');
                    var checked = $(this).prop('checked') ? 0 : 1;
                    $.ajax({
                        type: 'POST',
                        url: updateStatusClasss,
                        data: {
                            id: classId,
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

            $(document).ready(function() {
                $('.quick_view_class_button').click(function() {
                    var class_id = $(this).siblings('input[name="id_class"]').val();

                    $.ajax({
                        url: quickViewClassRequest,
                        type: 'POST',
                        data: {
                            id_class: class_id,
                            _token: csrfToken,
                        },
                        success: function(response) {
                            $('#quick_view_title').text('Lớp :' + response.name + ' - Sĩ số : ' +
                                response.number);

                            $('#quick_view_class').empty();

                            $.each(response.students, function(index, student) {
                                var row = '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + student.student_code + '</td>' +
                                    '<td>' + student.name + '</td>' +
                                    '<td>' + student.gender + '</td>' +
                                    '<td>' + student.birth + '</td>' +
                                    '<td>' + student.cccd + '</td>' +
                                    '<td>' + student.email + '</td>' +
                                    '<td>' + student.phone + '</td>' +
                                    '<td>' + student.school_year + '</td>' +
                                    '<td><button class="btn btn-danger delete-question">Xoá</button></td>' +
                                    '</tr>';
                                $('#quick_view_class').append(row);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
