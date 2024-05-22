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
                        <div>Liệt kê các quyền</div>
                    </div>
                    @can('permissions.create')
                        <div class="page-title-actions">
                            <div class="d-inline-block">
                                <a href="{{ route('permissions.create') }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Thêm route quyền
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
                                <th>Tên quyền</th>
                                <th>Mô tả quyền</th>
                                <th>Route quyền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parentPermissions as $parentIndex => $parent)
                                <tr>
                                    <td>{{ $parentIndex + 1 }}</td>
                                    <td>{{ $parent->name }}</td>
                                    <td>{{ $parent->description }}</td>
                                    <td>{{ $parent->key_code }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('permissions.destroy', $parent->id) }}"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa quyền này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="pe-7s-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $childIndex = 1;
                                @endphp
                                @foreach ($permissions as $permission)
                                    @if ($permission->parent_id == $parent->id)
                                        <tr>
                                            <td>{{ $parentIndex + 1 }}.{{ $childIndex }}</td>
                                            <td>-- {{ $permission->name }}</td>
                                            <td>{{ $permission->description }}</td>
                                            <td>{{ $permission->key_code }}</td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('permissions.destroy', $permission->id) }}"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa quyền này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                                        class="btn btn-secondary">
                                                        <i class="pe-7s-note"></i>
                                                    </a>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="pe-7s-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $childIndex++;
                                        @endphp
                                    @endif
                                @endforeach
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
