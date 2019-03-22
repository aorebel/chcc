$(document).ready(function() {
    $("#student_login").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'app/student_login.php',
            type: 'POST',
            data: { username: $("#user").val(), password: $("#pass").val() },
            success: function(resp) {
                if (resp == "invalid") {
                    $("#errorMsg").html("Invalid username and password!");
                } else {
                    window.location.href = resp;
                }
            }
        });
    });
});