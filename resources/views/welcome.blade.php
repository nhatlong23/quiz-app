<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Study Hard">
    <meta name="keywords" content="Study, Hard, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="LongNguyen">
    <link rel="shortcut icon" href="{{ asset('frontend/img/StudyLogo.png') }}" type="image/x-icon">
    <title>Trắc nghiệm</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/icon-font.min.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                    <div class="tip">2</div>
                </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                    <div class="tip">2</div>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="{{ route('homepage') }}"><img src="{{ asset('frontend/img/Study.png') }}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            @if (!Auth::guard('students')->check())
                <a href="{{ route('redirectToLogin') }}">Đăng nhập</a>
            @else
                <a href="{{ route('profile') }}">Hồ sơ</a>
                <p>Lớp: {{ Auth::guard('students')->user()->student_class->name }}</p>
                <a href="{{ route('logoutStudents') }}">Đăng xuất</a>
            @endif
        </div>
    </div>
    <!-- Offcanvas Menu End -->
    @php
        $get_name = Request::route()->getName();
    @endphp
    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="{{ route('homepage') }}"><img src="{{ asset('frontend/img/Study.png') }}"
                                alt=""></a>
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
                            <li class="{{ $get_name === 'contact' ? 'active' : '' }}"><a
                                    href="{{ route('contact') }}">Liên hệ</a></li>
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
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        @if (Auth::guard('students')->check())
                                            {{ Auth::guard('students')->user()->name }}
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('logoutStudents') }}">Đăng xuất</a>
                                        <a class="dropdown-item" href="{{ route('profile') }}">Hồ sơ</a>
                                        <a class="dropdown-item" href="#">Lớp :
                                            {{ Auth::guard('students')->user()->student_class->name }}</a>
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

    @yield('homepages')
    <div class="clearfix"></div>
    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="{{ route('homepage') }}"><img src="{{ asset('frontend/img/Study.png') }}"
                                    alt=""></a>
                        </div>
                        <p>Trang web trắc nghiệm của chúng tôi là một nơi tuyệt vời để bạn thử thách bản thân và kiểm
                            tra kiến thức của mình trong nhiều lĩnh vực khác nhau. Từ ngôn ngữ, toán học, khoa học tự
                            nhiên đến văn hóa và nghệ thuật, chúng tôi cung cấp hàng trăm bài kiểm tra và câu hỏi đa
                            dạng để bạn có thể nâng cao kỹ năng và hiểu biết của mình.
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Truy cập nhanh</h6>
                        <ul>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="footer__widget">
                        <h6>Tài khoản</h6>
                        <ul>
                            <li><a href="">Tài khoản của tôi</a></li>
                            {{-- <li><a href="#">Orders Tracking</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Wishlist</a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-8">
                    <div class="footer__newslatter">
                        <h6>Liên hệ</h6>
                        <form action="{{route('send.email.telegram')}}" method="POST">
                            @csrf
                            <input type="email" name="email" required placeholder="Email">
                            <button type="submit" class="site-btn">Liên hệ</button>
                        </form>
                        <div class="footer__social">
                            <a href="https://www.facebook.com/phpid1586/" target="_blank"><i
                                    class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="https://www.instagram.com/nguyen_nhat_long/" target="_blank"><i
                                    class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <div class="footer__copyright__text">
                        <p>Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This
                            template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">Colorlib</a>
                            <a href="//www.dmca.com/Protection/Status.aspx?ID=b8eccf47-789c-4b91-bf8a-b4c502c46639"
                                title="DMCA.com Protection Status" target="_blank" class="dmca-badge"> <img
                                    src ="https://images.dmca.com/Badges/dmca-badge-w100-5x1-06.png?ID=b8eccf47-789c-4b91-bf8a-b4c502c46639"
                                    alt="DMCA.com Protection Status" />
                            </a>
                        </p>
                    </div>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input disabled type="text" id="search-input" placeholder="Khum có gì cả hehe .....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/blockf12.js') }}"></script>
    <script src="{{ asset('frontend/js/svgembedder.min.js') }}"></script>
    <script src="{{ asset('frontend/js/js.cookie.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"></script>

    @stack('scripts')
</body>

</html>
