@extends('welcome')

@section('homepages')
    <style>
        #scrollToTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            padding: 15px;
            transition: opacity 0.3s;
        }

        #scrollToTopBtn:hover {
            opacity: 0.7;
        }
    </style>
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
                                    <img src="{{ asset('frontend/img/blog/details/comment-1.jpg') }}" alt="">
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
                                    <img src="{{ asset('frontend/img/blog/details/comment-2.jpg') }}" alt="">
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
                                    <img src="{{ asset('frontend/img/blog/details/comment-3.jpg') }}" alt="">
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
                            @foreach ($relatedPosts as $relatedPost)
                                <a href="{{ route('blog_detail', $relatedPost->slug) }}" class="blog__feature__item">
                                    <div class="blog__feature__item__pic">
                                        <img src="{{ asset($relatedPost->images) }}" width="50px"
                                            alt="{{ $relatedPost->slug }}">
                                    </div>
                                    <div class="blog__feature__item__text">
                                        <h6>{{ $relatedPost->title }}</h6>
                                        <span>{{ $relatedPost->created_at }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        @if (!empty($filtered_tags))
                            <div class="blog__sidebar__item">
                                <div class="section-title">
                                    <h4>Tags</h4>
                                </div>
                                <div class="blog__sidebar__tags">
                                    @foreach ($filtered_tags as $tags)
                                        <a href="{{ route('tags', $tags) }}">{{ trim($tags) }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top">
            <i class="fa fa-arrow-up" aria-hidden="true"></i>
        </button>
    </section>
    @push('scripts')
        <script>
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                var scrollToTopBtn = document.getElementById("scrollToTopBtn");
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    scrollToTopBtn.style.display = "block";
                } else {
                    scrollToTopBtn.style.display = "none";
                }
            }
        </script>
    @endpush
@endsection
