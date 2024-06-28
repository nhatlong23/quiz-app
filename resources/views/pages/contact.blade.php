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
                                    <p>Bình Thái 1, Cẩm Lệ, Đà Nẵng</p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-phone"></i> Số điện thoại</h6>
                                    <p><span>0899-244-850</span><span>0325-616-957</span></p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-headphones"></i> Hỗ trợ</h6>
                                    <p>hotro@longtech.id.vn</p>
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
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61358.908429942465!2d108.1616302092546!3d16.017066571461974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142199deb085271%3A0x8ac5d36794034e22!2zQ-G6qW0gTOG7hywgxJDDoCBO4bq1bmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1714965237395!5m2!1svi!2s"
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
