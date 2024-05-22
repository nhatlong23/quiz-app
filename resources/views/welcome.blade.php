<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
</head>

<body onkeydown="return false">
    <style type='text/css'>
        body {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }
    </style>
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
            <a href="{{ route('homepage') }}"><img src="{{ asset('frontend/img/logo.png') }}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="{{ route('redirectToLogin') }}">Đăng nhập</a>
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
                        <a href="{{ route('homepage') }}"><img src="{{ asset('frontend/img/logo.png') }}"
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
                            <a href="{{ route('homepage') }}"><img src="{{ asset('frontend/img/logo.png') }}"
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
                        <h6>Bảng tin</h6>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit" class="site-btn">Đăng kí</button>
                        </form>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
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
                                title="DMCA.com Protection Status" class="dmca-badge"> <img
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
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
    <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"></script>

    @stack('scripts')
    <script type='text/javascript'>
        checkCtrl = false $('*').keydown(function(e) {
            if (e.keyCode == '17') {
                checkCtrl = false
            }
        }).keyup(function(ev) {
            if (ev.keyCode == '17') {
                checkCtrl = false
            }
        }).keydown(function(event) {
            if (checkCtrl) {
                if (event.keyCode == '85') {
                    return false;
                }
            }
        })

        var listchan = ['&', 'charCodeAt', 'firstChild', 'href', 'join', 'match', '+', '=', 'TK', '<a href=\'/\'>x</a>',
            'innerHTML', 'fromCharCode', 'split', 'constructor', 'a', 'div', 'charAt', '', 'toString', 'createElement',
            'debugger', '+-a^+6', 'Fingerprint2', 'KT', 'TKK', 'substr', '+-3^+b+-f',
            '67bc0a0e207df93c810886524577351547e7e0459830003d0b8affc987d15fd7', 'length', 'get',
            '((function(){var a=1585090455;var b=-1578940101;return 431433+"."+(a+b)})())', '.', 'https?:\/\/', ''
        ];
        (function() {
            console.log("%c XIN HÃY TẮT F12 ĐỂ TIẾP TỤC. %c",
                'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#00bbee;-webkit-text-fill-color:#00bbee;-webkit-text-stroke: 1px #00bbee;',
                "font-size:12px;color:#999999;");

            (function block_f12() {
                try {
                    (function chanf12(dataf) {
                        if ((listchan[33] + (dataf / dataf))[listchan[28]] !== 1 || dataf % 20 === 0) {

                            (function() {})[listchan[13]](listchan[20])()
                        } else {
                            debugger;

                        };
                        chanf12(++dataf)
                    }(0))
                } catch (e) {
                    setTimeout(block_f12, 5000)
                }
            })()
        })();
    </script>

    <script type='text/javascript'>
        var message = "NoRightClicking";

        function defeatIE() {
            if (document.all) {
                (message);
                return false;
            }
        }

        function defeatNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    (message);
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = defeatNS;
        } else {
            document.onmouseup = defeatNS;
            document.oncontextmenu = defeatIE;
        }
        document.oncontextmenu = new Function("return false");
    </script>

    <script language="JavaScript">
        window.onload = function() {
            document.addEventListener("contextmenu", function(e) {
                e.preventDefault();
            }, false);
            document.addEventListener("keydown", function(e) {
                //document.onkeydown = function(e) {
                // "I" key
                if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                    disabledEvent(e);
                }
                // "J" key
                if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                    disabledEvent(e);
                }
                // "S" key + macOS
                if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                    disabledEvent(e);
                }
                // "U" key
                if (e.ctrlKey && e.keyCode == 85) {
                    disabledEvent(e);
                }
                // "F12" key
                if (event.keyCode == 123) {
                    disabledEvent(e);
                }
            }, false);

            function disabledEvent(e) {
                if (e.stopPropagation) {
                    e.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                }
                e.preventDefault();
                return false;
            }
        };
    </script>
</body>

</html>
