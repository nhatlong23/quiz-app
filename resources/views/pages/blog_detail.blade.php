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

        .comment-section,
        .comment-reply {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .comment-section.show,
        .comment-reply.show {
            display: block;
            opacity: 1;
        }

        .reply {
            margin-left: 50px;
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
                            {{-- <img src="img/blog/details/blog-details.jpg" alt=""> --}}
                            <div class="blog__details__item__title">
                                <span class="tip">Street style</span>
                                <h4>{{ $blogs->title }}</h4>
                                <ul>
                                    <li>by <span>{{ $blogs->user->name }}</span></li>
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
                        <form action="{{ route('send_comment') }}" method="POST">
                            @csrf
                            <div class="blog__details__comment">
                                <h5 id="comment_count">0 Bình luận</h5>
                                <a href="#" class="leave-btn">Để lại bình luận</a>
                                <input type="hidden" name="comment_blogs_id" class="comment_blogs_id"
                                    value="{{ $blogs->id }}">
                                <input type="hidden" name="parent_comment_id" value="" class="parent_comment_id">
                                <div class="form-group comment-section" id="comment-section">
                                    <label for="comment">Bình Luận Ngay</label>
                                    <div class="row">
                                        @if (Auth::guard('students')->check())
                                            <div class="col">
                                                <input type="text" class="form-control" name="comment_name"
                                                    value="{{ Auth::guard('students')->user()->name }}" readonly>
                                            </div>
                                            <div class="col">
                                                <input type="email" class="form-control" name="comment_email"
                                                    value="{{ Auth::guard('students')->user()->email }}" readonly>
                                            </div>
                                        @else
                                            <div class="col">
                                                <input type="text" class="form-control" name="comment_name"
                                                    placeholder="Tên" required>
                                            </div>
                                            <div class="col">
                                                <input type="email" class="form-control" name="comment_email"
                                                    placeholder="Email" required>
                                            </div>
                                        @endif
                                    </div>
                                    <br>
                                    <textarea class="form-control" name="comment_content" placeholder="Để lại bình luận ở đây" id="content" rows="3"
                                        required></textarea>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Bình luận</button>
                                </div>
                                <div id="comment_show"></div>
                            </div>
                        </form>
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

        <script>
            $(document).ready(function() {
                var blogs_id = $('.comment_blogs_id').val();

                function load_comment() {
                    $.ajax({
                        url: "{{ route('load_comment') }}",
                        method: "POST",
                        data: {
                            blogs_id: blogs_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            var commentsHtml = '';
                            data.forEach(function(comment) {
                                if (comment.parent_comment_id === null) {
                                    commentsHtml += `
                                        <div class="blog__comment__item">
                                            <div class="blog__comment__item__pic">
                                                <img src="{{ asset('frontend/img/blog/details/UserAvatar.png') }}" alt="">
                                            </div>
                                            <div class="blog__comment__item__text">
                                                <h6>${comment.name}</h6>
                                                <p>${comment.content}</p>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> ${comment.created_at}</li>
                                                    <li><i class="fa fa-heart-o like-comment" data-comment-id="${comment.id}" style="cursor: pointer"></i> ${comment.likes}</li>
                                                    <li>
                                                        <a href="#" class="reply-comment" title="Trả lời bình luận" data-comment-id="${comment.id}"><i class="fa fa-reply"></i> Trả lời</a>
                                                    </li>
                                                </ul>
                                                <div class="form-group comment-reply" id="comment-reply-${comment.id}">
                                                    <label for="comment_reply">Trả lời bình luận</label>
                                                    <textarea required class="form-control" id="comment_reply" rows="3"></textarea>
                                                    <br>
                                                    <button type="button" class="btn btn-primary reply-to-reply" data-comment-id="${comment.id}">Trả lời</button>
                                                </div>
                                            </div>
                                        </div>`;

                                    data.forEach(function(reply) {
                                        if (reply.parent_comment_id === comment.id) {
                                            commentsHtml += `
                                            <div class="blog__comment__item reply">
                                                <div class="blog__comment__item__pic">
                                                    <img src="{{ asset('frontend/img/blog/details/UserAdmin.png') }}" alt="">
                                                </div>
                                                <div class="blog__comment__item__text">
                                                    <h6>${reply.name}</h6>
                                                    <p>${reply.content}</p>
                                                    <ul>
                                                        <li><i class="fa fa-clock-o"></i> ${reply.updated_at}</li>
                                                        <li><i class="fa fa-heart-o like-comment" data-comment-id="${reply.id}" style="cursor: pointer"></i> ${reply.likes}</li>
                                                    </ul>
                                                </div>
                                            </div>`;
                                        }
                                    });
                                }
                            });
                            $('#comment_show').html(commentsHtml);
                            $('#comment_count').text(data.length + ' Bình luận');
                        }
                    });
                }

                load_comment();

                $(document).on('click', '.like-comment', function() {
                    var commentId = $(this).data('comment-id');
                    var likeIcon = $(this);
                    $.ajax({
                        url: "{{ route('like_comment') }}",
                        method: "POST",
                        data: {
                            comment_id: commentId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            likeIcon.text(' ' + response.likes);
                        }
                    });
                });

                document.querySelector('.leave-btn').addEventListener('click', function(event) {
                    event.preventDefault();
                    var commentSection = document.getElementById('comment-section');
                    commentSection.classList.toggle('show');
                });

                $(document).on('click', '.reply-comment', function(event) {
                    event.preventDefault();
                    var commentId = $(this).data('comment-id');
                    $('#comment-reply-' + commentId).toggleClass('show');
                });
            });
        </script>
    @endpush
@endsection
