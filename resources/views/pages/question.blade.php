@extends('welcome')

@section('homepages')
    <style>
        .number {
            display: inline-block;
            border: 2px solid #007bff;
            /* Màu khung */
            padding: 5px 10px;
            /* Padding */
            font-size: 16px;
            /* Kích thước chữ */
            transition: all 0.2s ease;
            /* Hiệu ứng chuyển đổi */
            cursor: pointer;
            margin: 5px;
            /* Khoảng cách giữa các số */
            border-radius: 5px;
        }

        .number:hover {
            background-color: #007bff;
            /* Màu nền khi hover */
            color: white;
            /* Màu chữ khi hover */
            transform: scale(1.1);
            /* Phóng to khi hover */
        }

        #bad {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            /* Khoảng cách giữa các phần tử */
        }
    </style>
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Thi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="product spad">
        <div class="container">
            <div class="card">
                <h5 class="card-header">{{ $exam->content }}</h5>
                <div class="card-body">
                    <footer class="blockquote-footer">Bài này có: <cite title="Source Title">{{ $exam->max_questions }} câu
                            hỏi</cite></footer>
                </div>
            </div>
            <br>
            <div class="row">
                @if (Auth::guard('students')->check())
                    <input type="hidden" name="student_id" value="{{ Auth::guard('students')->id() }}">
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                @endif
                <div class="col">
                    @foreach ($questions as $question)
                        <div class="card text-center" id="question_{{ $loop->iteration }}">
                            <div class="card-header" style="background-color: rgb(193, 193, 212)">
                                Câu {{ $loop->iteration }}: {{ $question->question->question }}
                            </div>
                            <div class="card-body">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" name="question_{{ $question->question->id }}"
                                                value="A" onclick="highlightQuestion({{ $loop->iteration }})">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control"
                                        placeholder="A: {{ $question->question->option_a }}" disabled>
                                </div>
                                <br>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" name="question_{{ $question->question->id }}"
                                                value="B" onclick="highlightQuestion({{ $loop->iteration }})">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control"
                                        placeholder="B: {{ $question->question->option_b }}" disabled>
                                </div>
                                <br>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" name="question_{{ $question->question->id }}"
                                                value="C" onclick="highlightQuestion({{ $loop->iteration }})">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control"
                                        placeholder="C: {{ $question->question->option_c }}" disabled>
                                </div>
                                <br>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" name="question_{{ $question->question->id }}"
                                                value="D" onclick="highlightQuestion({{ $loop->iteration }})">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control"
                                        placeholder="D: {{ $question->question->option_d }}" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>

                <div class="col-lg-3">
                    <div style="position: sticky; top: 20px;">
                        <div class="col py-3 px-lg-5 border bg-light text-center">
                            <strong>Câu hỏi:</strong>
                        </div>
                        <div class="col py-3 px-lg-5 bg-light text-center" id="questionNumbers">
                            @for ($i = 1; $i <= $totalQuestions; $i++)
                                <span class="number" onclick="scrollToQuestion({{ $i }})"
                                    id="question_{{ $i }}">{{ $i }}</span>
                            @endfor
                        </div>
                        <div class="col py-3 px-lg-5 border bg-light text-center">
                            <div id="bad">
                                <span class="badge badge-danger">
                                    <h5>Thời gian còn lại: <span id="countdown"></span></h5>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary">
                                    <span class="lnr lnr-cloud-download"></span> Lưu bài
                                </button>
                            </div>

                            <div class="col">
                                <button type="button" class="btn btn-primary" id="submitAnswers">
                                    <span class="lnr lnr-pencil"></span> Nộp bài
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            const submitAnswersUrl = "{{ route('submitAnswers') }}";
            const csrfToken = "{{ csrf_token() }}";

            function selectRadio(radioId) {
                document.getElementById(radioId).checked = true;
            }

            function highlightQuestion(questionNumber) {
                var questionNumbers = document.getElementById('questionNumbers').children;

                for (var i = 0; i < questionNumbers.length; i++) {
                    if (i + 1 === questionNumber) {
                        questionNumbers[i].style.backgroundColor = '#007bff';
                        questionNumbers[i].style.color = 'white';
                    }
                }
            }

            function scrollToQuestion(questionNumber) {
                var element = document.getElementById('question_' + questionNumber);
                if (element) {
                    element.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            window.addEventListener('scroll', function() {
                var container = document.getElementById('questionNumbersContainer');
                if (container) {
                    container.style.top = (20 + window.pageYOffset) + 'px';
                }
            });

            function clearLocalStorage() {
                for (var key in localStorage) {
                    if (key.includes("_exam_") && key.includes("_student_")) {
                        localStorage.removeItem(key);
                    }
                }
            }
            // Đợi cho trang tải hoàn tất
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
                    radio.addEventListener("change", function() {
                        var questionName = this.getAttribute("name");
                        var examId = document.querySelector('input[name="exam_id"]').value;
                        var studentId = document.querySelector('input[name="student_id"]').value;

                        var localStorageKey = questionName + "_exam_" + examId + "_student_" +
                            studentId;

                        var selectedOption = this.value;

                        // Lưu giá trị vào LocalStorage
                        if (selectedOption) {
                            localStorage.setItem(localStorageKey, selectedOption);
                        }
                    });
                });

                // Lặp qua danh sách câu hỏi để đặt trạng thái của nút radio từ LocalStorage
                document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
                    var questionName = radio.getAttribute("name");
                    var examId = document.querySelector('input[name="exam_id"]').value;
                    var studentId = document.querySelector('input[name="student_id"]').value;

                    // Tạo một key duy nhất cho LocalStorage bằng cách kết hợp tên câu hỏi, ID của đề thi và ID của thí sinh
                    var localStorageKey = questionName + "_exam_" + examId + "_student_" + studentId;

                    var selectedOption = localStorage.getItem(localStorageKey);
                    if (selectedOption === radio.value) {
                        radio.checked = true;
                    }
                });
            });

            function getCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }

            function setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            function clearCookie(name) {
                document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            }

            $(document).ready(function() {
                var studentId = $('input[name="student_id"]').val();
                var examId = $('input[name="exam_id"]').val();

                var cookieKey = "exam_" + examId + "_student_" + studentId + "_endTime";

                var endTime = getCookie(cookieKey);

                if (!endTime) {
                    var currentTime = new Date().getTime();
                    endTime = currentTime + ({{ $question_duration->exam->duration }} * 60 * 1000);
                    setCookie(cookieKey, endTime, 1); //1day
                }

                startCountdown(endTime);
            });

            // Hàm đếm ngược
            function startCountdown(endTime) {
                var x = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = endTime - now;
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById("countdown").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";
                    if (distance <= 0) {
                        clearInterval(x);
                        document.getElementById("countdown").innerHTML = "Hết giờ";
                        clearCookie(cookieKey);
                        submitAnswers();
                    }
                }, 1000);

                $('#submitAnswers').click(function() {
                    if ($('input[type="radio"]:checked').length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Cảnh báo',
                            text: 'Bạn chưa chọn câu trả lời nào. Bạn có chắc muốn nộp bài không?',
                            showCancelButton: true,
                            confirmButtonText: 'Đồng ý',
                            cancelButtonText: 'Hủy bỏ'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                submitAnswers();
                                clearLocalStorage();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Xác nhận',
                            text: 'Bạn có chắc muốn nộp bài không?',
                            showCancelButton: true,
                            confirmButtonText: 'Đồng ý',
                            cancelButtonText: 'Hủy bỏ'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                submitAnswers();
                                clearLocalStorage();
                            }
                        });
                    }
                });

                function submitAnswers() {
                    var exam_id = $('input[name="exam_id"]').val();
                    var student_id = $('input[name="student_id"]').val();

                    var answers = {};
                    var question_ids = [];

                    $('input[name^="question_"]').each(function() {
                        var question_id = $(this).prop('name').replace('question_', '');
                        question_ids.push(question_id);
                        var answer = $('input[name="question_' + question_id + '"]:checked').val();

                        answers[question_id] = answer ? answer : 'no_answer';
                    });
                    console.log(answers);
                    $.ajax({
                        method: 'POST',
                        url: submitAnswersUrl,
                        data: {
                            _token: csrfToken,
                            exam_id: exam_id,
                            student_id: student_id,
                            answers: answers,
                            question_ids: question_ids
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Nộp bài thành công',
                                    text: 'Điểm của bạn: ' + response.score + ' điểm',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '/';
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi',
                                    text: 'Có lỗi xảy ra. Vui lòng thử lại.'
                                });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: 'Có lỗi xảy ra. Vui lòng thử lại.'
                            });
                        }
                    });
                }
            };
        </script>
    @endpush
@endsection
