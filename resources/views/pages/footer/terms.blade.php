@extends('welcome')

@section('homepages')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Điều khoản dịch vụ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="contact__content">
                        <div class="contact__address">
                            <h5>Điều khoản dịch vụ</h5>
                            <ul>
                                <li>
                                    {!! $infos->terms_of_service !!}
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
