<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V18</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="{{ asset('frontend/css/mdb.min.css') }}" />
</head>

<body style="background-color: #666666;">
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <a href="{{ route('homepage') }}"><img
                                                src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                                style="width: 185px;" alt="logo"></a>
                                        <h4 class="mt-1 mb-5 pb-1">Chúng tôi là IT trường THPT Cẩm Lệ</h4>
                                    </div>

                                    <form method="POST" enctype="multipart/form-data" action="{{ route('checkLoginStudents') }}">
                                        @csrf
                                        <p>Xin hãy đăng nhập vào tài khoản của bạn</p>
                                    
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input name="email" type="email" class="form-control" placeholder="Vui lòng nhập email mà trường đã cấp" />
                                            <label class="form-label" for="email">Email</label>
                                        </div>
                                    
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input name="password" type="password" class="form-control" placeholder="Vui lòng nhập mật khẩu" />
                                            <label class="form-label" for="password">Mật khẩu</label>
                                        </div>
                                    
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">
                                                Đăng nhập
                                            </button>
                                            <a class="text-muted" href="">Quên mật khẩu?</a>
                                        </div>
                                    
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Bạn chưa có tài khoản?</p>
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger">Liên hệ admin</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Khám phá và Kiểm tra kiến thức với Trang web Trắc nghiệm</h4>
                                    <p class="small mb-0">Trang web trắc nghiệm của chúng tôi là một nơi tuyệt vời để bạn thử thách bản thân và kiểm tra kiến thức của mình trong nhiều lĩnh vực khác nhau. Từ ngôn ngữ, toán học, khoa học tự nhiên đến văn hóa và nghệ thuật, chúng tôi cung cấp hàng trăm bài kiểm tra và câu hỏi đa dạng để bạn có thể nâng cao kỹ năng và hiểu biết của mình.</p>
                                    <p class="small mb-0">Với giao diện thân thiện và dễ sử dụng, bạn có thể trải nghiệm các bài kiểm tra một cách thuận tiện từ bất kỳ thiết bị nào có kết nối internet. Bên cạnh đó, chúng tôi cung cấp phản hồi tức thì và thống kê kết quả sau mỗi bài kiểm tra để bạn có thể theo dõi tiến bộ của mình và xác định những điểm cần cải thiện.</p>
                                    <p class="small mb-0">Hãy tham gia cùng chúng tôi để trải nghiệm không gian học tập mới mẻ và thú vị, nơi bạn có thể trau dồi kiến thức và chuẩn bị tốt nhất cho những thử thách phía trước!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<!-- MDB -->
<script type="text/javascript" src="{{asset('frontend/js/mdb.umd.min.js')}}"></script>

</html>
