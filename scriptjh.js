$(document).ready(function() {
    $("#generate-btn").click(function() {
        let randomUsername = generateUsername();
        $("#username").val(randomUsername);
    });

    $("#submit-btn").click(function() {
        let username = $("#username").val();
        let key = $("#key").val();

        $.ajax({
            type: "POST",
            url: "register.php",
            data: { username: username, key: key },
            success: function(response) {
                $("#message").text(response);
            }
        });
    });
});

function generateUsername() {
    return "user" + Math.floor(Math.random() * 1000);
}
