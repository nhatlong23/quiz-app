@php
    $get_name = Request::route()->getName();
@endphp
<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('homepage') }}"><img src="{{ asset($infos->logo) }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ $get_name === 'homepage' ? 'active' : '' }}">
                            <a href="{{ route('homepage') }}">Trang chủ</a>
                        </li>
                        @auth('students')
                            <li class="{{ $get_name === 'redirectToExam' ? 'active' : '' }}">
                                <a
                                    href="{{ route('redirectToExam', ['class_id' => Auth::guard('students')->user()->class_id]) }}">Đề
                                    thi
                                </a>
                            </li>
                        @endauth
                        <li class="{{ $get_name === 'knowledge' ? 'active' : '' }}"><a
                                href="{{ route('knowledge') }}">Kiến thức</a></li>
                        <li><a href="#">Thi thử</a></li>
                        <li class="{{ $get_name === 'contact' ? 'active' : '' }}"><a href="{{ route('contact') }}">Liên
                                hệ</a></li>
                        @auth('students')
                            <li class="{{ $get_name === 'history_exam' ? 'active' : '' }}"><a
                                    href="{{ route('history_exam') }}">Lịch sử thi</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    @if (!Auth::guard('students')->check())
                        <div class="header__right__auth">
                            <a href="{{ route('redirectToLogin') }}">Đăng nhập</a>
                        </div>
                    @else
                        <div class="header__right__auth">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if (Auth::guard('students')->check())
                                        {{ Auth::guard('students')->user()->name }}
                                    @endif
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('profile') }}">Hồ sơ</a>
                                    <a class="dropdown-item" href="#">Lớp :
                                        {{ Auth::guard('students')->user()->student_class->name }}</a>
                                    <a class="dropdown-item" href="{{ route('logoutStudents') }}">Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="#"><span class="icon_heart_alt"></span>
                                <div class="tip">2</div>
                            </a></li>
                        <li><a href="#"><span class="icon_bag_alt"></span>
                                <div class="tip">2</div>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
