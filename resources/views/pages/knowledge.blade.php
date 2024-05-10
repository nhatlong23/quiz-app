@extends('welcome')

@section('homepages')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Kiến thức</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container spad">
        {{-- kiến thức --}}
    </div>
@endsection
