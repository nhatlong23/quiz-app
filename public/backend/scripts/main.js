$(document).ready(function () {
    $("#wizard-picture").on('change', function () {
        readURL(this);
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#wizardPicturePreview").attr("src", e.target.result).fadeIn("slow");
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function () {
    $('.quick_view_button').click(function () {
        var question = $(this).data('question');
        $('#quick_view_question').text(question);
        $('#quick_view_subject').text(subject);

        var question_id = $(this).siblings('input[name="id_questions"]').val();
        var subject_id = $(this).siblings('input[name="id_subjects"]').val();
        $.ajax({
            url: quickViewRequest,
            type: 'POST',
            data: {
                id_questions: question_id,
                id_subjects: subject_id,
                _token: csrfToken,
            },
            success: function (response) {
                $('#question').text(response.question);
                $('#option_a').text(response.option_a);
                $('#option_b').text(response.option_b);
                $('#option_c').text(response.option_c);
                $('#option_d').text(response.option_d);
                $('#answer').text(response.answer);
                $('#picture').text(response.picture);
                $('#subject').text(response.subject);
                $('#level').text(response.level);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function () {
    $('.quick_view_class_button').click(function () {
        var class_id = $(this).siblings('input[name="id_class"]').val();

        $.ajax({
            url: quickViewClassRequest,
            type: 'POST',
            data: {
                id_class: class_id,
                _token: csrfToken,
            },
            success: function (response) {
                $('#quick_view_title').text('Lớp :' + response.name + ' - Sĩ số : ' + response.number);

                $('#quick_view_class').empty();

                $.each(response.students, function (index, student) {
                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + student.student_code + '</td>' +
                        '<td>' + student.name + '</td>' +
                        '<td>' + student.gender + '</td>' +
                        '<td>' + student.birth + '</td>' +
                        '<td>' + student.cccd + '</td>' +
                        '<td>' + student.email + '</td>' +
                        '<td>' + student.phone + '</td>' +
                        '<td>' + student.school_year + '</td>' +
                        '<td><button class="btn btn-danger delete-question">Xoá</button></td>' +
                        '</tr>';
                    $('#quick_view_class').append(row);
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function () {
    $('.quick_view_students_button').click(function () {
        var description = $(this).data('description');
        $('#quick_view_description').text(description);

        var student_id = $(this).siblings('input[name="id_students"]').val();
        var class_id = $(this).siblings('input[name="class"]').val();

        $.ajax({
            url: quickViewStudentsRequest,
            type: 'POST',
            data: {
                id_student: student_id,
                id_class: class_id,
                _token: csrfToken,
            },
            success: function (response) {
                $('#quick_view_students_title').text(response.names + ' - ' + response
                    .class);
                $('#student_code').text(response.student_code);
                $('#names').text(response.names);
                $('#school_year').text(response.school_year);
                $('#birth').text(response.birth);
                $('#gender').text(response.gender);
                $('#email').text(response.email);
                $('#phone').text(response.phone);
                $('#cccd').text(response.cccd);
                $('#class').text(response.class);
                $('#images').attr('src', response.images);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function () {
    $('.quick_view_exam_button').click(function () {
        var exam_id = $(this).siblings('input[name="id_exam"]').val();
        var subjects_id = $(this).siblings('input[name="subjects_id"]').val();

        $.ajax({
            url: quickViewExamRequest,
            type: 'POST',
            data: {
                id_exam: exam_id,
                subjects_id: subjects_id,
                _token: csrfToken,
            },
            success: function (response) {
                $('#quick_view_exam_title').text(response.subject + ' - ' + response.content);

                $('#example_tbody').empty();

                $.each(response.questions, function (index, question) {
                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + question.question + '</td>' +
                        '<td>' + question.option_a + '</td>' +
                        '<td>' + question.option_b + '</td>' +
                        '<td>' + question.option_c + '</td>' +
                        '<td>' + question.option_d + '</td>' +
                        '<td>' + question.answer + '</td>' +
                        '<td>' + question.status + '</td>' +
                        '<td><button class="btn btn-danger delete-question">Xoá</button></td>' +
                        '</tr>';
                    $('#example_tbody').append(row);
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

var randomQuestions;

$(document).ready(function () {
    $("#randomize_questions").on('click', function () {
        var subjectId = $("#subject").val();
        var counts = {};
        var countFieldsFilled = 0;

        $(".count").each(function () {
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
            success: function (response) {
                displayCountQuestions(response);
                randomQuestions = response.questionsByLevel;
                displayRandomQuestions(response.questionsByLevel);
            },
            error: function (xhr, status, error) { }
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

    $.each(questions, function (levelId, levelQuestions) {
        $.each(levelQuestions, function (index, question) {
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
            row.append('<td><input type="button" class="btn btn-danger delete-question" value="Xoá"></td>');

            tbody.append(row);
        });
    });
}

$("#save_exams").on('click', function () {
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
        success: function (response) {
            window.location.href = examsRequestIndex;
        },
        error: function (xhr, status, error) {
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

$(document).ready(function () {
    $("#closing_time").on('change', function () {
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

$(document).ready(function () {
    $('#saveChanges').click(function () {
        // Lấy exam_id từ input ẩn trong modal
        var exam_id = $('input[name="id_exam"]').val();

        // Lấy ID của các lớp được chọn
        var class_ids = [];
        $('input[name="class_id[]"]:checked').each(function () {
            class_ids.push($(this).val());
        });

        $.ajax({
            url: addExamToClass,
            method: 'POST',
            data: {
                exam_id: exam_id,
                class_ids: class_ids,
                _token: csrfToken,
            },
            success: function (response) {
                console.log(response);
                // Xử lý kết quả nếu cần
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function(){
    $('.subjects_status').each(function() {
        $(this).bootstrapToggle();
    });

    $('.subjects_status').change(function(){
        var subjectId = $(this).data('subject-id');
        var checked = $(this).prop('checked') ? 0 : 1;
        $.ajax({
            type: 'POST',
            url: updateStatusSubjects,
            data: {
                id: subjectId,
                checked: checked,
                _token: csrfToken,
            },
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});


$(document).ready(function(){
    $('.levels_status').each(function() {
        $(this).bootstrapToggle();
    });

    $('.levels_status').change(function(){
        var levelsId = $(this).data('levels-id');
        var checked = $(this).prop('checked') ? 0 : 1;
        $.ajax({
            type: 'POST',
            url: updateStatusLevels,
            data: {
                id: levelsId,
                checked: checked,
                _token: csrfToken,
            },
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});

$(document).ready(function(){
    $('.question_status').each(function() {
        $(this).bootstrapToggle();
    });

    $('.question_status').change(function(){
        var questionId = $(this).data('question-id');
        var checked = $(this).prop('checked') ? 0 : 1;
        $.ajax({
            type: 'POST',
            url: updateStatusQuestions,
            data: {
                id: questionId,
                checked: checked,
                _token: csrfToken,
            },
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});

$(document).ready(function(){
    $('.exams_status').each(function() {
        $(this).bootstrapToggle();
    });

    $('.exams_status').change(function(){
        var examId = $(this).data('exam-id');
        var checked = $(this).prop('checked') ? 0 : 1;
        $.ajax({
            type: 'POST',
            url: updateStatusExams,
            data: {
                id: examId,
                checked: checked,
                _token: csrfToken,
            },
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});

$(document).ready(function(){
    $('.students_status').each(function() {
        $(this).bootstrapToggle();
    });

    $('.students_status').change(function(){
        var studentsId = $(this).data('student-id');
        var checked = $(this).prop('checked') ? 0 : 1;
        $.ajax({
            type: 'POST',
            url: updateStatusStudents,
            data: {
                id: studentsId,
                checked: checked,
                _token: csrfToken,
            },
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});

$(document).ready(function(){
    $('.classs_status').each(function() {
        $(this).bootstrapToggle();
    });

    $('.classs_status').change(function(){
        var classId = $(this).data('class-id');
        var checked = $(this).prop('checked') ? 0 : 1;
        $.ajax({
            type: 'POST',
            url: updateStatusClasss,
            data: {
                id: classId,
                checked: checked,
                _token: csrfToken,
            },
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});

$(document).ready(function(){
    $('.blocks_status').each(function() {
        $(this).bootstrapToggle();
    });

    $('.blocks_status').change(function(){
        var blockId = $(this).data('block-id');
        var checked = $(this).prop('checked') ? 0 : 1;
        $.ajax({
            type: 'POST',
            url: updateStatusBlocks,
            data: {
                id: blockId,
                checked: checked,
                _token: csrfToken,
            },
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});
