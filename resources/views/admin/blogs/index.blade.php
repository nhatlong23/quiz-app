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
                            <div>Liệt kê các blog</div>
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
                                    <th>Tên blog</th>
                                    <th>Slug blog</th>
                                    {{-- <th>Nội dung blog</th> --}}
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
                                            <a href="{{ route('blogs.show', $list->slug) }}" class="btn btn-secondary">
                                                {{ $list->title }}
                                            </a>
                                        </td>

                                        <td>{{ $list->slug }}</td>
                                        <td>
                                            <img src="{{ $list->images }}" width="250px" alt="">
                                        </td>
                                        <td>
                                            <input class="blogs_status" id="toggle-demo" data-blogs-id="{{ $list->id }}"
                                                type="checkbox" data-on="Hiển thị" data-off="Ẩn" data-toggle="toggle"
                                                {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                        </td>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('blogs.destroy', $list->id) }}"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa blogs này?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('blogs.edit', $list->id) }}" class="btn btn-secondary">
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
    @else
        <script>
            window.location = "/";
        </script>
    @endif
@endsection
