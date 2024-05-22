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
                        <div>Liệt kê các blog</div>
                    </div>
                    @can('blogs.create')
                        <div class="page-title-actions">
                            <div class="d-inline-block">
                                <a href="{{ route('blogs.create') }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Thêm các blogs
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
                                <th>Tên blog</th>
                                <th>Slug blog</th>
                                <th>Hình ảnh blog</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($blogs_list as $key => $list)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @can('blogs.view')
                                            <a href="{{ route('blogs.show', $list->slug) }}" class="btn btn-secondary">
                                                {{ $list->title }}
                                            </a>
                                        @endcan
                                    </td>
                                    <td>{{ $list->slug }}</td>
                                    <td>
                                        <img src="{{ $list->images }}" width="250px" alt="">
                                    </td>
                                    <td>
                                        @can('updateStatusBlogs')
                                            <input class="blogs_status" id="toggle-demo" data-blogs-id="{{ $list->id }}"
                                                type="checkbox" data-on="Hiển thị" data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                        @else
                                            <span class="badge badge-{{ $list->status == 1 ? 'success' : 'danger' }}">
                                                {{ $list->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        @endcan
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('blogs.destroy', $list->id) }}"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa blogs này?')">
                                            @csrf
                                            @method('DELETE')
                                            @can('blogs.edit')
                                                <a href="{{ route('blogs.edit', $list->id) }}" class="btn btn-secondary">
                                                    <i class="pe-7s-note"></i>
                                                </a>
                                            @endcan
                                            @can('blogs.destroy')
                                                <button type="submit" class="btn btn-danger">
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
            const updateStatusBlogs = "{{ route('updateStatusBlogs') }}";

            $(document).ready(function() {
                $('.blogs_status').each(function() {
                    $(this).bootstrapToggle();
                });

                $('.blogs_status').change(function() {
                    var blogsId = $(this).data('blogs-id');
                    var checked = $(this).prop('checked') ? 0 : 1;
                    $.ajax({
                        type: 'POST',
                        url: updateStatusBlogs,
                        data: {
                            id: blogsId,
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
@endsection
