@extends('welcome')

@section('homepages')
    <section class="blog spad">
        <div class="container">
            <div class="row" id="blog-list">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <a href="{{ route('blog_detail', $blog->slug) }}">
                                <div class="blog__item__pic large__item set-bg" data-setbg="{{ $blog->images }}"></div>
                                <div class="blog__item__text">
                                    <h6>
                                        <strong>{{ $blog->title }}</strong>
                                    </h6>
                                    <ul>
                                        <li>by <span>{{ $blog->user->name }}</span></li>
                                        <li>{{ $blog->created_at }}</li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-12 text-center">
                <button id="load-more-btn" class="primary-btn load-btn">Tải thêm bài viết</button>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var offset = {{ $blogs->count() }};
                var loadMoreBtn = document.getElementById('load-more-btn');
                var blogList = document.getElementById('blog-list');

                loadMoreBtn.addEventListener('click', function() {
                    loadMoreBtn.innerHTML = 'Đang tải...';
                    fetch("{{ route('loadMoreBlogs') }}?offset=" + offset)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                data.forEach(blog => {
                                    var blogItem = document.createElement('div');
                                    blogItem.className = 'col-lg-4 col-md-4 col-sm-6';
                                    blogItem.innerHTML = `
                                        <!-- Blog Item -->
                                        <div class="blog__item">
                                            <a href="{{ route('blog_detail', 'slug_placeholder') }}">
                                                <div class="blog__item__pic large__item set-bg" style="background-image: url(${blog.images})"  data-setbg="${blog.images}"></div>
                                                <div class="blog__item__text">
                                                    <h6><strong>${blog.title}</strong></h6>
                                                    <ul>
                                                        <li>by <span>admin</span></li>
                                                        <li>${blog.created_at}</li>
                                                    </ul>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- End Blog Item -->
                                    `;
                                    blogList.appendChild(blogItem);
                                    offset++;
                                });
                                loadMoreBtn.innerHTML = 'Tải thêm bài viết';
                            } else {
                                loadMoreBtn.style.display = 'none';
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        </script>
    @endpush
@endsection
