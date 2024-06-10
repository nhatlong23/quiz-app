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
                        <span>{{ $tags }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <section class="blog-details spad">
        <div class="container">
            @if ($blogs->isEmpty())
                <p>No blogs found with the tag "{{ $tags }}".</p>
            @else
                @foreach ($blogs as $blog)
                    <div class="blog-item">
                        <a href="{{ route('blog_detail', $blog->slug) }}">
                            <h2>{{ $blog->title }}</h2>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection
