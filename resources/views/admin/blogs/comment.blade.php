@extends('layouts.app')
@section('content')
    <style>
        ul.list-reply {
            list-style-type: decimal;
            padding: 0;
            color: blue;
            margin: 5px 40px;
        }
    </style>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
                        </div>
                        <div>Liệt kê các bình luận</div>
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
                                <th>Duyệt</th>
                                <th>Bình luận</th>
                                <th>Tên người gửi</th>
                                <th>Email người gửi</th>
                                <th>Bài viết</th>
                                <th>Ngày gửi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comment_list as $list)
                                @if ($list->parent_comment_id == null)
                                    <tr>
                                        <td>
                                            @can('updateStatusComments')
                                                <input class="comment_status" id="toggle-demo" id="{{ $list->blogs_id }}"
                                                    data-comment-id="{{ $list->id }}" type="checkbox" data-on="Hiển thị"
                                                    data-off="Ẩn" data-toggle="toggle"
                                                    {{ isset($list->status) && $list->status == 1 ? 'checked' : '' }}>
                                            @else
                                                <span class="badge {{ $list->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $list->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                                </span>
                                            @endcan
                                        </td>
                                        <td>
                                            {{ $list->content }}
                                            <ul class="list-reply">
                                                Trả lời:
                                                @foreach ($comment_list as $comment_reply)
                                                    @if ($comment_reply->parent_comment_id == $list->id)
                                                        <li> {{ $comment_reply->content }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            @if ($list->status)
                                                @can('reply_comment')
                                                    <form action="{{ route('reply_comment') }}" method="POST">
                                                        @csrf
                                                        <br>
                                                        <input type="hidden" name="blog_id_reply"
                                                            value="{{ $list->blogs_id }}">
                                                        <input type="hidden" name="parent_comment_id"
                                                            value="{{ $list->id }}">
                                                        <textarea class="form-control" required name="content_reply" rows="3"></textarea> <br>
                                                        <button class="btn btn-danger" type="submit">
                                                            Trả lời bình luận
                                                        </button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->email }}</td>
                                        <td>
                                            <a target="_blank" href="{{ route('blog_detail', $list->blog->slug) }}">
                                                {{ $list->blog->title }}
                                            </a>
                                        </td>
                                        <td>{{ $list->created_at }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const updateStatusComments = "{{ route('updateStatusComments') }}";

            $(document).ready(function() {
                $('.comment_status').each(function() {
                    $(this).bootstrapToggle();
                });

                $('.comment_status').change(function() {
                    var commentId = $(this).data('comment-id');
                    var checked = $(this).prop('checked') ? 0 : 1;
                    $.ajax({
                        type: 'POST',
                        url: updateStatusComments,
                        data: {
                            id: commentId,
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
