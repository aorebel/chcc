$(document).ready(function() {
    $("#btn-login").click(function(e) {
        //alert("you clicked login");
        //$("#errorMsg").html("Invalid username and password!");
        e.preventDefault();
        $.ajax({
            url: 'app/trial_login.php',
            type: 'POST',
            data: { uname: $("#uname").val(), pass: $("#pass").val() },
            success: function(resp) {
                if (resp == "invalid") {
                    $("#errorMsg").html("Invalid username and password!");
                } else if (resp == "error") {
                    $("#errorMsg").html("Please complete the Form!");

                } else if (resp == "Invalid Access") {
                    $("#errorMsg").html("Invalid Access!");
                } else {
                    //window.location.href = resp;
                    $("#errorMsg").html("Invalid Access! Server error.");
                }
            }
        });
    });
});