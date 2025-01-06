@extends('welcome')

@section('homepages')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Liên hệ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__content">
                        <div class="contact__address">
                            <h5>Thông tin liên lạc</h5>
                            <ul>
                                <li>
                                    <h6><i class="fa fa-map-marker"></i> Địa chỉ</h6>
                                    <p>{!! $infos->address !!}</p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-phone"></i> Số điện thoại</h6>
                                    <p><span>{!! $infos->phone !!}</span></p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-headphones"></i> Hỗ trợ</h6>
                                    <p><span>{!! $infos->email !!}</span></p>
                                </li>
                            </ul>
                        </div>
                        <div class="contact__form">
                            <h5>Gửi thông tin </h5>
                            <form action="{{ route('send.contact.email') }}" method="POST">
                                @csrf
                                <input type="text" name="name" placeholder="Tên" required>
                                <input type="email" name="email" placeholder="Email" required>
                                <textarea name="emailMessage" placeholder="Thông điệp" required></textarea>
                                <button type="submit" class="site-btn">Gửi thông tin</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__map">
                        <iframe
                            src="{{ $infos->map }}"
                            width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
