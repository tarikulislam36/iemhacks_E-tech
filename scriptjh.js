$(document).ready(function() {
    $("#generate-btn").click(function() {
        let randomUsername = generateUsername();
        let randomPassword = generatePassword();
        $("#username").val(randomUsername);
        $("#key").val(randomPassword);
    });

    $("#registration-form").submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting

        let username = $("#username").val();
        let key = $("#key").val();

        $.ajax({
            type: "POST",
            url: "register.php",
            data: { username: username, key: key },
            success: function(response) {
                $("#message").text(response);

                if (response === "Registration successful") {
                    // Redirect to room.html after successful registration
                    window.location.href = "room.html";
                }
            }
        });
    });








const characters ='123456789abcdefghijklmnopqrstuvwxyz0123456789';
let result = ' ';

function generatePassword() {
    var length = 8;
    const charactersLength = characters.length;
    for ( let i = 0; i < length; i++ ) {
        result = characters.charAt(Math.floor(Math.random() * charactersLength))+characters.charAt(Math.floor(Math.random() * charactersLength))+characters.charAt(Math.floor(Math.random() * charactersLength))+characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    var keyValue = document.getElementById("key").value;
    if( keyValue != null){
        document.getElementById("key").value='';
        console.log(result);
    }
    else{
        document.getElementById("key").value=result;
    }
    
    
    return result;
  
}

function generateUsername() {
    
    
    return "user" + Math.floor(Math.random() * 1000);
    
}




function checkUsernameAvailability(username) {
    $.ajax({
        type: "POST",
        url: "check_username.php",
        data: { username: username },
        success: function(response) {
            if (response === "available") {
                $("#username-status").text("Username available.");
            } else {
                $("#username-status").text("Username already taken.");
            }
        }
    });
}
});

//check username
$("#username").keyup(function() {
    let username = $("#username").val();
    checkUsernameAvailability(username);
});

function checkUsernameAvailability(username) {
    $.ajax({
        type: "POST",
        url: "check_username.php",
        data: { username: username },
        success: function(response) {
            if (response === "available") {
                $("#username-status").text("Username available.");
            } else {
                $("#username-status").text("Username already taken.");
            }
        }
    });
}