<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "mydatabase");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["key"];

    // Sanitize user input (to prevent SQL injection, use prepared statements)
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query the database for the user
    $sql = "SELECT * FROM users WHERE username='$username' AND user_key='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful
       
        $_SESSION["username"] = $username;
        $_SESSION["key"] = $password;

        header("Location: room.html"); // Redirect to a welcome page
        exit; // Ensure that no more code is executed after the redirect
    } else {
        // Authentication failed
        echo "Invalid username or password.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <title>Two Divs</title>
    <style>
      @font-face {
        font-family: algebraFont;
        src: url(Alegreya-Regular.ttf);
      }
        /* Style for div A */
        #divA {
            
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Style for div B */
        #divB {
            /* background-color: ; */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media only screen and (max-width: 719px) {
            #divA {
            background-color: #c0c2c2;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Style for div B */
        #divB {
            background-color: #060505;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        } 
}


/* You can customize this CSS as needed */
body {
  background-color: #f4f4f4;
}

.card {
  margin-top: 0px;
  padding: 15px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

#login{
  margin-top: 0px;
    padding: 15px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  

  --bs-card-spacer-y: 1rem;
    --bs-card-spacer-x: 1rem;
    --bs-card-title-spacer-y: 0.5rem;
    --bs-card-title-color: ;
    --bs-card-subtitle-color: ;
    --bs-card-border-width: var(--bs-border-width);
    --bs-card-border-color: var(--bs-border-color-translucent);
    --bs-card-border-radius: var(--bs-border-radius);
    --bs-card-box-shadow: ;
    --bs-card-inner-border-radius: calc(var(--bs-border-radius) - (var(--bs-border-width)));
    --bs-card-cap-padding-y: 0.5rem;
    --bs-card-cap-padding-x: 1rem;
    --bs-card-cap-bg: rgba(var(--bs-body-color-rgb), 0.03);
    --bs-card-cap-color: ;
    --bs-card-height: ;
    --bs-card-color: ;
    --bs-card-bg: var(--bs-body-bg);
    --bs-card-img-overlay-padding: 1rem;
    --bs-card-group-margin: 0.75rem;
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    height: var(--bs-card-height);
    color: var(--bs-body-color);
    word-wrap: break-word;
    background-color: var(--bs-card-bg);
    background-clip: border-box;
    border: var(--bs-card-border-width) solid var(--bs-card-border-color);
    border-radius: var(--bs-card-border-radius);
  
}

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Div A -->
            <div class="col-md-7" id="divA">
          <p>        <h1 style="padding-right: 20px;font-family: inherit;">NoteDrive </h1> </p>
                <br>
                <br>
                <!-- div A here -->
<div>



                <button onclick="createBtn()"> Create</button>
                <button onclick="loginBtn()"> Login</button>   
</div>
      </div>
            <!-- Div B -->
            <div class="col-md-5" id="divB">
                
                <div class="col-md-10">
                <div  id="create" class="card">
                    <div class="card-header">
                      <b>Create </b>
                    </div>
                    <button type="submit" class="btn btn-secondary" id="generate-btn" style="position: absolute;right: 1px;">Auto Generate</button> 
                   

                     
                    <div class="card-body">
                   <!-- Modify the form in the Create section -->
<form id="registration-form" action="" method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Username</label>
        <input type="text" class="form-control"  id="username" placeholder="Username" required>
        <p id="username-status"></p>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Key</label>
        <input type="text" class="form-control" id="key" placeholder="Key" required>
    </div>
  
    <button type="submit" class="btn btn-primary" id="submit-btn" style="width: 100%;">GO</button>
</form>

                      
                    </div>
            </div>

            <!-- Login start here -->
            <div id="login"   style="display: none;">   
              <div class="card-header">
                <b>Login </b>
              </div>
              <!-- <button type="submit" class="btn btn-secondary" id="generate-btn" style="position: absolute;right: 1px;">Auto Generate</button>  -->
             

               
              <div class="card-body">
                 
              <form method="POST" action="">
                  <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username"  id="username" placeholder="Username" required>
                    
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Key</label>
                    <input type="text" class="form-control" name="key" id="key" placeholder="Key" required>
                  </div>
                  <p id="message"></p>

                  <button type="submit" value="login" class="btn btn-primary" id="submit-btn" style="width: 100%;">LOGIN</button>
                </form>
              </div>
      </div>
                 
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scriptjh.js"></script>    

    <!-- Bhubon Code start here -->
    <script>
        function loginBtn(){
          document.getElementById("login").style.display="block";
          document.getElementById("create").style.display="none";
          console.log("hell no")
      }
        function createBtn(){
          document.getElementById("create").style.display="block";
          document.getElementById("login").style.display="none";
         
        }

       
    </script>
    <script src="js_password_genarator.js"></script>
    <!-- Bhubon code end here -->
</body>
</html>












