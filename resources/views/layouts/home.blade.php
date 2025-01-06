@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                        </div>
                        <div>Trang tổng quan
                            <div class="page-title-subheading">Đây là trang tổng quan của trang quản trị website trắc nghiệm.
                            </div>
                        </div>
                    </div>
                    <div class="page-title-actions">
                        <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                            class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-star"></i>
                        </button>
                        <div class="d-inline-block dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="btn-shadow dropdown-toggle btn btn-info">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa fa-business-time fa-w-20"></i>
                                </span>
                                Buttons
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <i class="nav-link-icon lnr-inbox"></i>
                                            <span> Inbox</span>
                                            <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <i class="nav-link-icon lnr-book"></i>
                                            <span> Book</span>
                                            <div class="ml-auto badge badge-pill badge-danger">5</div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <i class="nav-link-icon lnr-picture"></i>
                                            <span> Picture</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a disabled class="nav-link disabled">
                                            <i class="nav-link-icon lnr-file-empty"></i>
                                            <span> File Disabled</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
                            Thông tin
                        </div>
                        <div class="btn-actions-pane-right text-capitalize">
                            <button class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm">View
                                All</button>
                        </div>
                    </div>
                    <div class="no-gutters row">
                        <div class="col-sm-6 col-md-4 col-xl-4">
                            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                                    <i class="lnr-laptop-phone text-dark opacity-8"></i>
                                </div>
                                <div class="widget-chart-content">
                                    <div class="widget-subheading">Tổng đề thi</div>
                                    <div class="widget-numbers">{{ $totalExams }}</div>
                                </div>
                            </div>
                            <div class="divider m-0 d-md-none d-sm-block"></div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-xl-4">
                            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                                    <i class="lnr-graduation-hat text-white"></i>
                                </div>
                                <div class="widget-chart-content">
                                    <div class="widget-subheading">Tổng số câu hỏi</div>
                                    <div class="widget-numbers"><span>{{ $total_question }} câu</span></div>
                                </div>
                            </div>
                            <div class="divider m-0 d-md-none d-sm-block"></div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-xl-4">
                            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                                    <i class="lnr-apartment text-white"></i>
                                </div>
                                <div class="widget-chart-content">
                                    <div class="widget-subheading">Tổng số thí sinh</div>
                                    <div class="widget-numbers text-success"><span>{{ $totalStudents }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center d-block p-3 card-footer">
                        <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary btn-lg">
                            <span class="mr-2 opacity-7">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
                                    <path
                                        d="M256 48C141.1 48 48 141.1 48 256s93.1 208 208 208 208-93.1 208-208S370.9 48 256 48zM76 256c0-48.1 18.7-93.3 52.7-127.3S207.9 76 256 76c48.1 0 93.3 18.7 127.3 52.7 32.2 32.2 50.7 74.5 52.6 119.7-8.8-10.3-24.2-24-43.8-24-27.5 0-41.7 25.7-51 42.7-1.4 2.5-2.7 4.9-3.9 7-11.4 19.2-27.3 30-42.5 28.9-13.4-.9-24.8-11.2-32.2-28.8-9.2-22.1-29.1-45.8-52.9-49.2-11.3-1.6-28.1.8-44.7 21.4-3.2 4-6.9 9.4-11.1 15.6-10.4 15.5-26.2 38.8-38.1 40.8-17.3 2.8-30.9-7.5-36.4-12.3-2.2-11.2-3.3-22.8-3.3-34.5z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <span class="mr-1">View Complete Report</span>
                        </button>
                    </div>
                </div>

                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
                            Chỉnh sửa cài đặt
                        </div>
                    </div>
                    <div class="no-gutters row">
                        <div class="col-sm-6 col-md-6 col-xl-6">
                            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
                                    <div class="main-card card">
                                        <div class="card-body">
                                            <div class="position-relative row form-group">
                                                <label for="name" class="col-sm-4 col-form-label">Tên :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="name" autocomplete="off"
                                                        id="name" class="form-control" placeholder="Nhập tên"
                                                        value="{{ !isset($settings) ? $settings->name : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label for="description" class="col-sm-4 col-form-label">Mô tả :</label>
                                                <div class="col-sm-8">
                                                    <textarea name="desc" id="desc" class="form-control" placeholder="Nhập mô tả">{{ !isset($settings) ? $settings->desc : '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label for="key_name" class="col-sm-4 col-form-label">Key name :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="key_name" autocomplete="off"
                                                        id="key_name" class="form-control" placeholder="Nhập key name"
                                                        value="{{ !isset($settings) ? $settings->key_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label for="key_value" class="col-sm-4 col-form-label">Key value:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="key_value"
                                                        autocomplete="off" id="key_value" placeholder="Enter text..."
                                                        value="{{ !isset($settings) ? $settings->key_value : '' }}">
                                                </div>
                                            </div>
                                            <div hidden class="position-relative row form-group">
                                                <label for="key_value_end" class="col-sm-4 col-form-label">Key value
                                                    end:</label>
                                                <div class="col-sm-8">
                                                    <input type="datetime-local" class="form-control"
                                                        name="key_value_end" autocomplete="off" id="key_value_end"
                                                        value="{{ !isset($settings) ? $settings->key_value_end : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <div class="col-sm-8"></div>
                                                <div class="col-sm-12">
                                                    <label>
                                                        <input type="checkbox" id="type_toggle" checked>
                                                        <span id="type_label">Sử dụng phương thức nhập dạng text</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-row form-inline">
                                                <div>
                                                    @if (isset($settings))
                                                        <input type="button" id="save_settings"
                                                            class="btn btn-shadow btn-secondary" value="Tạo">
                                                    @else
                                                        <input type="button" id="save_settings"
                                                            class="btn btn-shadow btn-secondary" value="Cập nhật">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-xl-6">
                            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
                                    <div class="main-card card">
                                        <div class="card-body">
                                            <table style="width: 100%;" id=""
                                                class="table table-hover table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Tên cài đặt</th>
                                                        <th>Mô tả cài đặt</th>
                                                        <th>Key name</th>
                                                        <th>Key value</th>
                                                        <th>Key value end</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($settings as $setting)
                                                        <tr>
                                                            <td>{{ $setting->name }}</td>
                                                            <td>{{ $setting->desc }}</td>
                                                            <td>{{ $setting->key_name }}</td>
                                                            <td>{{ $setting->key_value }}</td>
                                                            <td>{{ $setting->key_value_end ? $setting->key_value_end : 'null' }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-primary">Sửa</a>
                                                                <a href="#" class="btn btn-danger">Xóa</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>

                </div>

                <div class=" mb-3 card">
                    <div class="card-body">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
                            Người khả dụng
                        </div>
                        <div class="widget-chart-content">
                            <div class="widget-subheading">Tổng số người dùng đã vào website</div>
                            <div class="widget-numbers"><span>{{ $totalVisitors }}</span></div>
                        </div>

                        <div class="widget-chart-content">
                            <div class="widget-subheading">Số người dùng online</div>
                            <div class="widget-numbers"><span>{{ $onlineVisitors }}</span></div>
                        </div>
                        <table style="width: 100%;" id="example"
                            class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                    <th>Thời gian</th>
                                    <th>Người dùng</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->ip_address }}</td>
                                        <td>{{ $visitor->user_agent }}</td>
                                        <td>{{ $visitor->last_activity }}</td>
                                        <td>
                                            @if ($visitor->students_id)
                                                {{ $visitor->student->name }}
                                            @else
                                                Khách
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $lastActivity = \Carbon\Carbon::parse(
                                                    $visitor->last_activity,
                                                    'Asia/Ho_Chi_Minh',
                                                );
                                                $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
                                                $diff = $lastActivity->diff($now);

                                                if ($visitor->last_activity >= $now->subMinutes(1)) {
                                                    $status = '<span class="text-success">Online</span>';
                                                } elseif ($diff->y > 0) {
                                                    $status = "Offline {$diff->y} năm trước";
                                                } elseif ($diff->m > 0) {
                                                    $status = "Offline {$diff->m} tháng trước";
                                                } elseif ($diff->d > 0) {
                                                    $status = "Offline {$diff->d} ngày trước";
                                                } elseif ($diff->h > 0) {
                                                    $status = "Offline {$diff->h} giờ trước";
                                                } elseif ($diff->i > 0) {
                                                    $status = "Offline {$diff->i} phút trước";
                                                } else {
                                                    $status = 'Offline ít phút trước';
                                                }
                                            @endphp
                                            <span class="text-secondary">{!! $status !!}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const checkbox = document.getElementById('type_toggle');
            const inputField = document.getElementById('key_value');
            const inputFieldEnd = document.getElementById('key_value_end').parentElement.parentElement; // Lấy div cha
            const label = document.getElementById('type_label');

            // Trạng thái mặc định
            inputField.type = 'text';
            inputField.placeholder = 'Enter text...';
            inputFieldEnd.hidden = true; // Ẩn dòng chứa key_value_end
            label.textContent = 'Sử dụng phương thức nhập dạng text'; // Thiết lập nhãn ban đầu

            // Lắng nghe sự kiện thay đổi của checkbox
            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    inputField.type = 'text';
                    inputField.placeholder = 'Enter text...';
                    inputFieldEnd.hidden = true;
                    label.textContent = 'Sử dụng phương thức nhập dạng text';
                } else {
                    inputField.type = 'datetime-local';
                    inputField.placeholder = '';
                    inputFieldEnd.hidden = false;
                    label.textContent = 'Sử dụng phương thức nhập dạng datetime';
                }
            });
        </script>
    @endpush
@endsection
