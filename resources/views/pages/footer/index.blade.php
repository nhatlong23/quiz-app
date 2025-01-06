<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="{{ route('homepage') }}"><img src="{{ asset($infos->logo) }}"
                                alt=""></a>
                    </div>
                    <p>
                        {!! $infos->about !!}
                    </p>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Truy cập nhanh</h6>
                    <ul>
                        <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                        <li><a href="">Blogs</a></li>
                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        <li><a href="{{ route('terms') }}">Điều khoản dịch vụ</a></li>
                        <li><a href="{{ route('privacy') }}">Chính sách bảo mật</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Tài khoản</h6>
                    <ul>
                        <li><a href="{{ route('profile') }}">Tài khoản của tôi</a></li>
                        {{-- <li><a href="#">Orders Tracking</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Wishlist</a></li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>Liên hệ</h6>
                    <form action="{{ route('send.email.telegram') }}" method="POST">
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