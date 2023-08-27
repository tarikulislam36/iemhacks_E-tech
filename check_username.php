<?php
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

    // Check if the username already exists in the database
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "taken";
    } else {
        echo "available";
    }

    $conn->close();
}
?>
