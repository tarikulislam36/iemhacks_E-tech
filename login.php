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
        
        header("Location: welcome.php"); // Redirect to a welcome page
    } else {
        // Authentication failed
        echo "Invalid username or password.";
    }

    $conn->close();
}
?>
