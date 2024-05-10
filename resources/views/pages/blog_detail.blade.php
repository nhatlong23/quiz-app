@extends('welcome')

@section('homepages')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="">Blog</a>
                        <span>{{ $blogs->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img src="img/blog/details/blog-details.jpg" alt="">
                            <div class="blog__details__item__title">
                                <span class="tip">Street style</span>
                                <h4>{{ $blogs->title }}</h4>
                                <ul>
                                    <li>by <span>Admin</span></li>
                                    <li>{{ $blogs->created_at }}</li>
                                    <li>39 Comments</li>
                                </ul>
                            </div>
                        </div>
                        {!! $blogs->content !!}
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item">
                                        <h6><a href="#"><i class="fa fa-angle-left"></i> Các bài đăng trước</a></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item blog__details__btn__item--next">
                                        <h6><a href="#">Bài đăng tiếp theo <i class="fa fa-angle-right"></i></a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog__details__comment">
                            <h5>3 Bình luận</h5>
                            <a href="#" class="leave-btn">Để lại bình luận</a>
                            <div class="blog__comment__item">
                                <div class="blog__comment__item__pic">
                                    <img src="{{asset('frontend/img/blog/details/comment-1.jpg')}}" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                        mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog__comment__item blog__comment__item--reply">
                                <div class="blog__comment__item__pic">
                                    <img src="{{asset('frontend/img/blog/details/comment-2.jpg')}}" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Consequat consetetur dissentiet, ceteros commune perpetua mei et. Simul viderer
                                        facilisis egimus ulla mcorper.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog__comment__item">
                                <div class="blog__comment__item__pic">
                                    <img src="{{asset('frontend/img/blog/details/comment-3.jpg')}}" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                        mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Bài viết liên quan</h4>
                            </div>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="img/blog/sidebar/fp-1.jpg" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="img/blog/sidebar/fp-2.jpg" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="img/blog/sidebar/fp-3.jpg" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Tags cloud</h4>
                            </div>
                            <div class="blog__sidebar__tags">
                                <a href="#">Fashion</a>
                                <a href="#">Street style</a>
                                <a href="#">Diversity</a>
                                <a href="#">Beauty</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection