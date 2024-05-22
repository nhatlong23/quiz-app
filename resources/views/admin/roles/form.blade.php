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
                        @if (!isset($roles))
                            <div>Thêm vai trò</div>
                        @else
                            <div>Sửa vai trò</div>
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
                            @if (!isset($roles))
                                <form method="POST" action="{{ route('roles.store') }}">
                                @else
                                    <form method="POST" action="{{ route('roles.update', $roles->id) }}">
                                        @method('PUT')
                            @endif
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-sm-2 col-form-label">Tên vai trò :</label>
                                <div class="col-sm-10">
                                    <input name="name" required id="name" placeholder="Nhập tên vai trò vào đây!!"
                                        type="text" class="form-control" autocomplete="off"
                                        value="{{ isset($roles) ? $roles->name : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="description" class="col-sm-2 col-form-label">Mô tả vai trò :</label>
                                <div class="col-sm-10">
                                    <input name="description" required id="description"
                                        placeholder="Nhập mô tả vai trò vào đây!!" type="text" class="form-control"
                                        autocomplete="off" value="{{ isset($roles) ? $roles->description : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="name" class="col-sm-2 col-form-label">Phân quyền :</label>
                                <div class="col-sm-10">
                                    @foreach ($permissionsParent as $permissionsParent)
                                        <div class="card bg-light mb-3">
                                            <div class="card-header">
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox_wrapper" type="checkbox"
                                                        value="{{ $permissionsParent->id }}">
                                                    <label class="form-check-label">
                                                        {{ $permissionsParent->name }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="card-title">
                                                    @foreach ($permissionsParent->permissionChildren as $permissionChildren)
                                                        <div class="form-check form-check-inline">
                                                            <input name="permission_id[]"
                                                            @if (isset($roles))
                                                                @if ($permissionChecked->contains('id', $permissionChildren->id))
                                                                    checked
                                                                @endif
                                                            @endif
                                                                class="form-check-input checkbox_children" type="checkbox"
                                                                value="{{ $permissionChildren->id }}">
                                                            <label
                                                                class="form-check-label">{{ $permissionChildren->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </h3>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="position-relative row form-check">
                                <div class="col-sm-10 offset-sm-2">
                                    @if (!isset($roles))
                                        <button type="submit" class="btn btn-secondary">Lưu dữ liệu</button>
                                    @else
                                        <button type="submit" class="btn btn-secondary">Cập nhật dữ liệu</button>
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
            $(document).ready(function() {
                $('.checkbox_wrapper').on('click', function() {
                    $(this).closest('.card').find('.checkbox_children').prop('checked', $(this).prop(
                        'checked'));
                });
            });
        </script>
    @endpush
@endsection
