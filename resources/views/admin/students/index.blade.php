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
                        <div>Liệt kê các thí sinh</div>
                    </div>
                    @can('students.create')
                        <div class="page-title-actions">
                            <div class="d-inline-block">
                                <a href="{{ route('students.create') }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Thêm các thí sinh
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
                                        @can('quick_view_students')
                                            <form method="POST" action="{{ route('quick_view_students') }}">
                                                @csrf
                                                <input type="hidden" name="id_students" value="{{ $list->id }}">
                                                <input type="hidden" name="class" value="{{ $list->student_class->id }}">
                                                <button type="button"
                                                    class="btn mr-2 mb-2 btn-primary quick_view_students_button"
                                                    data-toggle="modal" data-target=".quick_view_students"
                                                    data-students="{{ $list->name }}">
                                                    {{ $list->name }}
                                                </button>
                                            </form>
                                        @else
                                            {{ $list->name }}
                                        @endcan
                                    </td>
                                    <td>{{ $list->student_class->name }}</td>
                                    <td>
                                        @can('updateStatusStudents')
                                            <input class="students_status" id="toggle-demo"
                                                data-student-id="{{ $list->id }}" type="checkbox" data-on="Hiển thị"
                                                data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                        @else
                                            <span class="badge badge-{{ $list->status == 1 ? 'success' : 'danger' }}">
                                                {{ $list->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        @endcan
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('students.destroy', $list->id) }}"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa thí sinh này?')">
                                            @csrf
                                            @method('DELETE')
                                            @can('students.edit')
                                                <a href="{{ route('students.edit', $list->id) }}" class="btn btn-secondary">
                                                    <i class="pe-7s-note"></i>
                                                </a>
                                            @endcan
                                            @can('students.destroy')
                                                <button type="submit" class="btn btn-danger"0>
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
    @push('model')
        <div class="modal fade quick_view_students" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quick_view_students_title"></h5>
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
                                            <th>Mã thí sinh</th>
                                            <th>Tên thí sinh</th>
                                            <th>Lớp</th>
                                            <th>Năm học</th>
                                            <th>Ngày sinh</th>
                                            <th>Giới tính</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>CCCD</th>
                                            <th>Ảnh đại diện</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="student_code"></td>
                                            <td id="names"></td>
                                            <td id="class"></td>
                                            <td id="school_year"></td>
                                            <td id="birth"></td>
                                            <td id="gender"></td>
                                            <td id="email"></td>
                                            <td id="phone"></td>
                                            <td id="cccd"></td>
                                            <td><img id="images" src="" alt="Student Image" style="width: 100%;">
                                            </td>
                                        </tr>
                                    </tbody>
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
            const updateStatusStudents = "{{ route('updateStatusStudents') }}";
            const quickViewStudentsRequest = "{{ route('quick_view_students') }}";

            $(document).ready(function() {
                $('.students_status').each(function() {
                    $(this).bootstrapToggle();
                });

                $('.students_status').change(function() {
                    var studentsId = $(this).data('student-id');
                    var checked = $(this).prop('checked') ? 0 : 1;
                    $.ajax({
                        type: 'POST',
                        url: updateStatusStudents,
                        data: {
                            id: studentsId,
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
                $('.quick_view_students_button').click(function() {
                    var description = $(this).data('description');
                    $('#quick_view_description').text(description);

                    var student_id = $(this).siblings('input[name="id_students"]').val();
                    var class_id = $(this).siblings('input[name="class"]').val();

                    $.ajax({
                        url: quickViewStudentsRequest,
                        type: 'POST',
                        data: {
                            id_student: student_id,
                            id_class: class_id,
                            _token: csrfToken,
                        },
                        success: function(response) {
                            $('#quick_view_students_title').text(response.names + ' - ' + response
                                .class);
                            $('#student_code').text(response.student_code);
                            $('#names').text(response.names);
                            $('#school_year').text(response.school_year);
                            $('#birth').text(response.birth);
                            $('#gender').text(response.gender);
                            $('#email').text(response.email);
                            $('#phone').text(response.phone);
                            $('#cccd').text(response.cccd);
                            $('#class').text(response.class);
                            $('#images').attr('src', response.images);
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
