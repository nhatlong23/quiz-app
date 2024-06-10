@extends('welcome')

@section('homepages')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Đề Thi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-loader {
            animation: none;
            border-width: 0;
        }
    </style>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>Môn thi sắp tới</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($exams as $exam)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card-deck">
                            <div class="card" style="width: 18rem;">
                                @if ($exam->exam->exam_subject->image != null)
                                    <img src="{{ asset('storage/' . $exam->exam->exam_subject->image) }}"
                                        class="card-img-top" alt="">
                                @else
                                    <img src="{{ asset('frontend/img/subjects/images.jpg') }}" class="card-img-top"
                                        alt="">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $exam->exam->content }}</h5>
                                    <p class="card-text">Môn : {{ $exam->exam->exam_subject->name }}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Thời gian thi: {{ $exam->exam->duration }} (Phút)</li>
                                    <li class="list-group-item">Thời gian bắt đầu:
                                        {{ $exam->exam->formatted_opening_time }}</li>
                                    <li class="list-group-item">Thời gian kết thúc:
                                        {{ $exam->exam->formatted_closing_time }}</li>
                                    <li class="list-group-item">Trắc nghiệm: {{ $exam->exam->max_questions }} câu</li>
                                </ul>
                                <div class="card-body">
                                    @if (in_array($exam->exam->id, $submittedExams))
                                        <button class="btn btn-secondary card-link" disabled>Bài thi đã làm</button>
                                    @else
                                        <button id="startExamBtn_{{ $exam->exam->id }}"
                                            data-exam-id="{{ $exam->exam->id }}"
                                            data-exam-title="{{ $exam->exam->content }}"
                                            class="trigger-swal btn btn-primary card-link">Bắt đầu thi
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            const vietnameseCharacters = /[àáảãạâầấẩẫậăằắẳẵặèéẻẽẹêềếểễệìíỉĩịòóỏõọôồốổỗộơờớởỡợùúủũụưừứửữựỳýỷỹỵđ]/;

            function checkUnikey(inputValue) {
                return vietnameseCharacters.test(inputValue);
            }

            $('.trigger-swal').on('click', function() {
                let examId = $(this).data('exam-id');
                let examTitle = $(this).data('exam-title');

                Swal.fire({
                    title: examTitle,
                    input: 'password',
                    inputAttributes: {
                        autocapitalize: 'off',
                        placeholder: 'Nhập mật khẩu của đề thi',
                    },
                    buttonsStyling: false,
                    showCancelButton: true,
                    customClass: {
                        confirmButton: 'btn btn-primary btn-lg mr-2',
                        cancelButton: 'btn btn-danger btn-lg',
                        loader: 'custom-loader',
                    },
                    loaderHtml: '<div class="spinner-border text-primary"></div>',
                    preConfirm: (password) => {
                        if (!password) {
                            Swal.showValidationMessage('Vui lòng nhập mật khẩu');
                            return false;
                        }

                        // Check if Unikey is on
                        if (checkUnikey(password)) {
                            Swal.showValidationMessage(
                                'Unikey đang bật. Vui lòng tắt Unikey và nhập lại mật khẩu.');
                            return false;
                        }

                        Swal.showLoading();
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                method: 'POST',
                                url: '/check-password-exam',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    exam_id: examId,
                                    password: password
                                },
                                success: function(response) {
                                    if (response.valid) {
                                        resolve();
                                    } else {
                                        reject(response.error);
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi',
                                        text: 'Sai mật khẩu đề thi hoặc đề thi không tồn tại. Vui lòng thử lại.'
                                    });
                                }
                            });
                        });
                    },
                }).then((result) => {
                    // Handle success if needed
                    if (result.isConfirmed) {
                        window.location.href = `/test-exam/${examId}`;
                    }
                }).catch((error) => {
                    Swal.showValidationMessage(error);
                });
            });
        </script>
        @foreach ($exams as $exam)
            <script>
                // Lấy thời gian hiện tại
                var currentTime = new Date();
                // Lấy thời gian bắt đầu và kết thúc của bài thi
                var openingTime = new Date('{{ $exam->exam->opening_time }}');
                var closingTime = new Date('{{ $exam->exam->closing_time }}');

                // Lấy button element bằng id
                var buttonElement = document.getElementById('startExamBtn_{{ $exam->exam->id }}');

                // Kiểm tra nếu thời gian hiện tại đã qua thời gian kết thúc của bài thi
                if (currentTime > closingTime) {
                    buttonElement.innerText = "Bài thi đã kết thúc";
                    buttonElement.setAttribute("disabled", true);
                }
                // Kiểm tra nếu thời gian hiện tại chưa đến thời gian bắt đầu của bài thi
                else if (currentTime < openingTime) {
                    buttonElement.innerText = "Chờ bài thi mở";
                    buttonElement.setAttribute("disabled", true);
                }
            </script>
        @endforeach
    @endpush
@endsection
