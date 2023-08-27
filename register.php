<?php
session_start();

// Database connection code (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $key = $_POST["key"];

    // Check if the username already exists
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Username already exists.";
    } else {
        // Insert the user's data into the database
        $insert_query = "INSERT INTO users (username, user_key) VALUES ('$username', '$key')";

        if ($conn->query($insert_query) === TRUE) {
            // Set session variables with the username and key
            $_SESSION["username"] = $username;
            $_SESSION["key"] = $key;


            

            // Redirect to home.php after successful registration
            echo "Registration successful";


            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
