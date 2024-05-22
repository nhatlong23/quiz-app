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
                        <div>Liệt kê các vai trò</div>
                    </div>
                    @can('roles.create')
                        <div class="page-title-actions">
                            <div class="d-inline-block">
                                <a href="{{ route('roles.create') }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Thêm vai trò
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
                                <th>Tên vai trò</th>
                                <th>Mô tả vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role_list as $key => $list)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->description }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('roles.destroy', $list->id) }}"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa vai trò này?')">
                                            @csrf
                                            @method('DELETE')
                                            @can('roles.edit')
                                                <a href="{{ route('roles.edit', $list->id) }}" class="btn btn-secondary">
                                                    <i class="pe-7s-note"></i>
                                                </a>
                                            @endcan
                                            @can('roles.destroy')
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
        <script></script>
    @endpush
@endsection
