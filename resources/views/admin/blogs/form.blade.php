@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-graph text-success"></i>
                        </div>
                        @if (!isset($blogs))
                            <div>Thêm blog</div>
                        @else
                            <div>Sửa blog</div>
                        @endif
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
            <div class="tab-content">
                <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            @if (!isset($blogs))
                                <form method="POST" enctype="multipart/form-data" id="myForm"
                                    action="{{ route('blogs.store') }}">
                                @else
                                    <form method="POST" enctype="multipart/form-data"
                                        action="{{ route('blogs.update', $blogs->id) }}">
                                        @method('PUT')
                            @endif
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="title" class="col-sm-2 col-form-label">Tên blogs :</label>
                                <div class="col-sm-10">
                                    <input name="title" id="slug" placeholder="Nhập tên bogs vào đây!!"
                                        type="text" class="form-control" autocomplete="off"
                                        value="{{ isset($blogs) ? $blogs->title : '' }}" onkeyup="ChangeToSlug()">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="slug" class="col-sm-2 col-form-label">Slug blogs :</label>
                                <div class="col-sm-10">
                                    <input name="slug" id="convert_slug"
                                        placeholder="Slug tự động nhập khi bạn nhập tên blogs!!" type="text"
                                        class="form-control" autocomplete="off"
                                        value="{{ isset($blogs) ? $blogs->slug : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="content" class="col-sm-2 col-form-label">Nội dung blog :</label>
                                <div class="col-sm-10">
                                    <textarea name="content" id="editor"> {{ isset($blogs) ? $blogs->content : '' }}</textarea>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="tags" class="col-sm-2 col-form-label">Tags blogs :</label>
                                <div class="col-sm-10">
                                    <input name="tags" data-role="tagsinput" type="text" class="form-control"
                                        autocomplete="off" value="{{ isset($blogs) ? $blogs->tags : '' }}"> (Dùng dấu ",")
                                </div>
                            </div>
                            {{-- <div class="position-relative row form-group">
                                <label for="status" class="col-sm-2 col-form-label">Trạng thái blog :</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        <option value="1" {{ isset($blogs) && $blogs->status == 1 ? 'selected' : '' }}>
                                            Hiển thị blog
                                        </option>
                                        <option value="0" {{ isset($blogs) && $blogs->status == 0 ? 'selected' : '' }}>
                                            Ẩn blog
                                        </option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="position-relative row form-group">
                                <label for="desc" class="col-sm-2 col-form-label">Hình ảnh blog :</label>
                                <div class="col-sm-10">
                                    <input name="images" id="images" type="file" class="form-control"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="position-relative row form-check">
                                <div class="col-sm-10 offset-sm-2">
                                    @if (!isset($blogs))
                                        <button type="submit" name="submit" class="btn btn-secondary">Lưu dữ
                                            liệu</button>
                                    @else
                                        <button type="submit" name="submit" class="btn btn-secondary">Cập nhật dữ
                                            liệu</button>
                                    @endif
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
@endsection
