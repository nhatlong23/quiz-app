@extends('layouts.app')

@section('content')
    @if (Auth::id())
        <style>
            #error-message-container {
                margin-top: 10px;
                padding: 10px;
                background-color: #f8d7da;
                border: 1px solid #f5c6cb;
                color: #721c24;
                border-radius: 5px;
            }
        </style>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                            </div>
                            @if (!isset($exam))
                                <div>Thêm bộ đề thi</div>
                            @else
                                <div>Chỉnh sửa bộ đề thi</div>
                            @endif
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="error-message-container" hidden></div>
                <div class="tabs-animation">
                    {{-- <div class="mb-3 card">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
                                Portfolio Performance
                            </div>
                            <div class="btn-actions-pane-right text-capitalize">
                                <button class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm">View
                                    All</button>
                            </div>
                        </div>
                        <div class="no-gutters row">
                            <div class="col-sm-6 col-md-4 col-xl-4">
                                <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                    <div class="icon-wrapper rounded-circle">
                                        <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                                        <i class="lnr-laptop-phone text-dark opacity-8"></i>
                                    </div>
                                    <div class="widget-chart-content">
                                        <div class="widget-subheading">Cash Deposits</div>
                                        <div class="widget-numbers">1,7M</div>
                                        <div class="widget-description opacity-8 text-focus">
                                            <div class="d-inline text-danger pr-1">
                                                <i class="fa fa-angle-down"></i>
                                                <span class="pl-1">54.1%</span>
                                            </div>
                                            less earnings
                                        </div>
                                    </div>
                                </div>
                                <div class="divider m-0 d-md-none d-sm-block"></div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-xl-4">
                                <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                    <div class="icon-wrapper rounded-circle">
                                        <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                                        <i class="lnr-graduation-hat text-white"></i>
                                    </div>
                                    <div class="widget-chart-content">
                                        <div class="widget-subheading">Invested Dividents</div>
                                        <div class="widget-numbers"><span>9M</span></div>
                                        <div class="widget-description opacity-8 text-focus">
                                            Grow Rate:
                                            <span class="text-info pl-1">
                                                <i class="fa fa-angle-down"></i>
                                                <span class="pl-1">14.1%</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider m-0 d-md-none d-sm-block"></div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4">
                                <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                    <div class="icon-wrapper rounded-circle">
                                        <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                                        <i class="lnr-apartment text-white"></i>
                                    </div>
                                    <div class="widget-chart-content">
                                        <div class="widget-subheading">Capital Gains</div>
                                        <div class="widget-numbers text-success"><span>$563</span></div>
                                        <div class="widget-description text-focus">
                                            Increased by
                                            <span class="text-warning pl-1">
                                                <i class="fa fa-angle-up"></i>
                                                <span class="pl-1">7.35%</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center d-block p-3 card-footer">
                            <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary btn-lg">
                                <span class="mr-2 opacity-7">
                                    <i class="icon icon-anim-pulse ion-ios-analytics-outline"></i>
                                </span>
                                <span class="mr-1">View Complete Report</span>
                            </button>
                        </div>
                    </div> --}}
                    @if (!isset($exam))
                        <form action="{{ route('exams.store') }}" method="POST" enctype="multipart/form-data">
                        @else
                            <form action="{{ route('exams.update', $exam->id) }}" method="POST"
                                enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                        <i class="header-icon lnr-cloud-download icon-gradient bg-happy-itmeo"></i>
                                        Quản lý
                                    </div>
                                </div>
                                <div class="p-0 card-body">
                                    <div class="tab-pane tabs-animation fade show active" id="tab-content-1"
                                        role="tabpanel">
                                        <div class="main-card card">
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('exams_request') }}">
                                                    @csrf
                                                    <div class="position-relative row form-group">
                                                        <label for="subjects_id" class="col-sm-2 col-form-label">Môn học
                                                            :</label>
                                                        <div class="col-sm-10">
                                                            <select name="subjects_id" class="form-control" id="subject">
                                                                <option disabled selected>------------Môn học------------
                                                                </option>
                                                                @foreach ($subjects as $subject)
                                                                    <option value="{{ $subject->id }}">
                                                                        {{ $subject->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative row form-group">
                                                        <h3 class="col-sm-12 text-center">Loại câu hỏi</h3>
                                                        <div class="col-sm-12 d-flex custom-control text-center"
                                                            style="margin: inherit;">
                                                            @foreach ($levels as $level)
                                                                <div class="col-sm-3">
                                                                    <label>{{ $level->name }} :</label>
                                                                    <input type="number"
                                                                        class="col-sm-10 count form-control"
                                                                        data-level-id="{{ $level->id }}" min="0"
                                                                        value="0">
                                                                </div>
                                                            @endforeach
                                                            <input type="button" id="randomize_questions"
                                                                class="btn btn-shadow btn-secondary"
                                                                value="Tạo ngẫu nhiên đề thi">
                                                        </div>
                                                        <h2 class="text-center col-sm-12">
                                                            <div id="total_questions">0</div>
                                                        </h2>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="card-hover-shadow-2x mb-3 card">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                        <i class="header-icon lnr-lighter icon-gradient bg-amy-crisp"></i>
                                        Tuỳ chọn đề
                                    </div>
                                </div>
                                <div class="p-0 card-body">
                                    <div class="tab-pane tabs-animation fade show active" id="tab-content-1"
                                        role="tabpanel">
                                        <div class="main-card card">
                                            <div class="card-body">
                                                <div class="position-relative row form-group">
                                                    <label for="opening_time" class="col-sm-3 col-form-label">Thời gian mở
                                                        đề :</label>
                                                    <div class="col-sm-5">
                                                        <input type="datetime-local" class="form-control"
                                                            name="opening_time" id="opening_time"
                                                            value="{{ isset($exam) ? $exam->opening_time : '' }}">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label for="closing_time" class="col-sm-4 col-form-label">Thời gian đóng
                                                        đề :</label>
                                                    <div class="col-sm-5">
                                                        <input type="datetime-local" class="form-control"
                                                            name="closing_time" id="closing_time"
                                                            value="{{ isset($exam) ? $exam->closing_time : '' }}">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label for="content" class="col-sm-3 col-form-label">Tên bài thi
                                                        :</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="content" id="content"
                                                            class="form-control" placeholder="Nhập tên bài thi"
                                                            value="{{ isset($exam) ? $exam->content : '' }}">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label for="duration" class="col-sm-3 col-form-label">Thời gian làm
                                                        bài
                                                        (phút) :</label>
                                                    <div class="col-sm-5">
                                                        <input type="number" placeholder="Nhập thời gian làm bài"
                                                            class="form-control" min="1" name="duration"
                                                            id="duration"
                                                            value="{{ isset($exam) ? $exam->duration : '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-row form-inline">
                                                    <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                                        <label for="exampleEmail22" class="mr-sm-2">Mật khẩu đề
                                                            :</label>
                                                        <input name="password" id="password" placeholder="Nhập mật khẩu"
                                                            type="password" class="form-control">
                                                    </div>
                                                    <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                                        <input name="confirm_password" id="confirm_password"
                                                            placeholder="Nhập lại mật khẩu" type="password"
                                                            class="form-control">
                                                    </div>
                                                    <div>
                                                        @if (!isset($exam))
                                                            <input type="button" id="save_exams"
                                                                class="btn btn-shadow btn-secondary" value="Tạo đề thi">
                                                        @else
                                                            <input type="button" id="save_exams"
                                                                class="btn btn-shadow btn-secondary"
                                                                value="Cập nhật đề thi">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="card mb-3">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                    class="header-icon lnr-laptop-phone mr-3 text-muted opacity-6"> </i>Danh sách câu
                                hỏi
                            </div>
                            <div class="btn-actions-pane-right actions-icon-btn">
                                <div class="btn-group dropdown">
                                    <button type="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
                                        <i class="pe-7s-menu btn-icon-wrapper"></i>
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true"
                                        class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                        <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                        </button>
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                        </button>
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                        </button>
                                        <div tabindex="-1" class="dropdown-divider"></div>
                                        <div class="p-3 text-right">
                                            <button class="mr-2 btn-shadow btn-sm btn btn-link">View
                                                Details</button>
                                            <button class="mr-2 btn-shadow btn-sm btn btn-primary">Action</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table style="width: 100%;" id="example"
                                class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Nội dung</th>
                                        <th>Đáp án</th>
                                        <th>Đáp án đúng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="STT">Loading...</td>
                                        <td id="content">Loading...</td>
                                        <td id="option">Loading...</td>
                                        <td id="answer">Loading...</td>
                                        <td id="action">Loading...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                const examsRequestIndex = "{{ route('exams.index') }}";
                const examsRequestUrl = "{{ route('exams_request') }}";
                const examsRequestStore = "{{ route('exams.store') }}";
                var randomQuestions;

                $(document).ready(function() {
                    $("#randomize_questions").on('click', function() {
                        var subjectId = $("#subject").val();
                        if (subjectId === null) {
                            alert("Vui lòng chọn một môn học trước khi tạo đề thi.");
                            return;
                        }

                        var counts = {};
                        var countFieldsFilled = 0;

                        $(".count").each(function() {
                            var levelId = $(this).data('level-id');
                            var count = $(this).val();

                            if (count && count > 0) {
                                counts[levelId] = count;
                                countFieldsFilled++;
                            }
                        });

                        if (countFieldsFilled < 2) {
                            alert("Vui lòng nhập số lượng câu hỏi cho mỗi cấp độ (có thể bỏ qua 1 cấp độ).");
                            return;
                        }

                        $.ajax({
                            type: "POST",
                            url: examsRequestUrl,
                            data: {
                                subject: subjectId,
                                counts: counts,
                                _token: csrfToken,
                            },
                            success: function(response) {
                                displayCountQuestions(response);
                                randomQuestions = response.questionsByLevel;
                                displayRandomQuestions(response.questionsByLevel);
                            },
                            error: function(xhr, status, error) {}
                        });
                    });
                });

                function displayCountQuestions(response) {
                    var totalQuestions = response.totalQuestions;
                    $("#total_questions").text(totalQuestions);
                }

                function displayRandomQuestions(questions) {
                    var tbody = $('#example tbody');
                    tbody.empty();

                    var questionCount = 0;

                    $.each(questions, function(levelId, levelQuestions) {
                        $.each(levelQuestions, function(index, question) {
                            var row = $('<tr>');
                            row.append('<td>' + (++questionCount) + '</td>');
                            row.append('<td>' + question.question + '</td>');
                            row.append('<td><ul>' +
                                '<li>' + question.option_a + '</li>' +
                                '<li>' + question.option_b + '</li>' +
                                '<li>' + question.option_c + '</li>' +
                                '<li>' + question.option_d + '</li>' +
                                '</ul></td>');
                            row.append('<td>' + question.answer + '</td>');
                            row.append(
                                '<td><input type="button" class="btn btn-danger delete-question" value="Xoá"></td>'
                            );

                            tbody.append(row);
                        });
                    });
                }

                function updateQuestionCount() {
                    var rowCount = $('#example tbody tr').length;
                    $("#total_questions").text(rowCount);
                }

                $(document).on('click', '.delete-question', function() {
                    var confirmation = confirm("Bạn có chắc chắn muốn xoá câu hỏi này?");
                    if (confirmation) {
                        $(this).closest('tr').remove();
                        updateQuestionCount();
                        randomQuestions = updateRandomQuestionsAfterDelete(randomQuestions);
                    }
                });

                function updateRandomQuestionsAfterDelete(randomQuestions) {
                    var updatedRandomQuestions = {};
                    $.each(randomQuestions, function(levelId, levelQuestions) {
                        var updatedLevelQuestions = levelQuestions.filter(function(question) {
                            return $('#example tbody tr').find('td').eq(1).text() !== question.question;
                        });
                        updatedRandomQuestions[levelId] = updatedLevelQuestions;
                    });
                    return updatedRandomQuestions;
                }

                $("#save_exams").on('click', function() {
                    var subjectId = $("#subject").val();
                    var content = $("#content").val();
                    var max_questions = $("#total_questions").html();
                    var opening_time = $("#opening_time").val();
                    var closing_time = $("#closing_time").val();
                    var duration = $("#duration").val();
                    var password = $("#password").val();
                    var confirm_password = $("#confirm_password").val();

                    if (!randomQuestions) {
                        alert("Vui lòng ngẫu nhiên câu hỏi trước khi lưu bài kiểm tra.");
                        return;
                    }

                    var randomQuestionsJSON = JSON.stringify(randomQuestions);

                    $.ajax({
                        type: "POST",
                        url: examsRequestStore,
                        data: {
                            subjectId: subjectId,
                            content: content,
                            max_questions: max_questions,
                            opening_time: opening_time,
                            closing_time: closing_time,
                            duration: duration,
                            password: password,
                            confirm_password: confirm_password,
                            randomQuestions: randomQuestionsJSON,
                            _token: csrfToken,
                        },
                        success: function(response) {
                            window.location.href = examsRequestIndex;
                        },
                        error: function(xhr, status, error) {
                            var response = xhr.responseJSON;
                            var errorDetails = response.errors;

                            var errorMessage = '';
                            for (var field in errorDetails) {
                                errorMessage += errorDetails[field].join(', ') + '<br>';
                            }
                            $('#error-message-container').html(errorMessage);
                            $("#error-message-container").removeAttr("hidden");
                        }
                    });
                });

                $(document).ready(function() {
                    $("#closing_time").on('change', function() {
                        var openingTime = new Date($("#opening_time").val());
                        var closingTime = new Date($(this).val());

                        if (closingTime < openingTime) {
                            $("#error-message-container").html("Thời gian đóng đề không thể trước thời gian mở đề");
                            $("#error-message-container").removeAttr("hidden");
                            $(this).val("");
                        } else {
                            $("#error-message-container").attr("hidden", "hidden");
                        }
                    });
                });
            </script>
        @endpush
    @else
        <script>
            window.location = "/";
        </script>
    @endif
@endsection
