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
                        @if (!isset($user))
                            <div>Thêm quản trị viên</div>
                        @else
                            <div>Sửa quản trị viên</div>
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
                            @if (!isset($user))
                                <form method="POST" action="{{ route('users.store') }}">
                                @else
                                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                                        @method('PUT')
                            @endif
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-sm-2 col-form-label">Tên quản trị viên :</label>
                                <div class="col-sm-10">
                                    <input name="name" required id="name"
                                        placeholder="Nhập tên quản trị viên vào đây!!" type="text" class="form-control"
                                        autocomplete="off" value="{{ isset($user) ? $user->name : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="email" class="col-sm-2 col-form-label">Email quản trị viên :</label>
                                <div class="col-sm-10">
                                    <input name="email" required id="email"
                                        placeholder="Nhập email quản trị viên vào đây!!" type="email" class="form-control"
                                        autocomplete="off" value="{{ isset($user) ? $user->email : '' }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="password" class="col-sm-2 col-form-label">Mật khẩu quản trị viên :</label>
                                <div class="col-sm-10">
                                    <input name="password" required id="password"
                                        placeholder="Nhập mật khẩu quản trị viên vào đây!!" type="password"
                                        class="form-control" autocomplete="off"
                                        @if (isset($user)) disabled @endif>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label class="col-sm-2 col-form-label">Chọn vai trò quản trị viên :</label>
                                <div class="col-sm-10">
                                    <select required multiple name="role_id[]" class="form-control role-multiple">
                                        @php
                                            $rolesOfUser = isset($user) ? $user->roles->pluck('id')->toArray() : [];
                                        @endphp
                                        @foreach ($roles_list as $item)
                                            <option value="{{ $item->id }}"
                                                {{ in_array($item->id, $rolesOfUser) ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative row form-check">
                                <div class="col-sm-10 offset-sm-2">
                                    @if (!isset($user))
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
                $('.role-multiple').select2({
                    placeholder: "Chọn vai trò quản trị viên",
                    allowClear: true
                });
            });
        </script>
    @endpush
@endsection
