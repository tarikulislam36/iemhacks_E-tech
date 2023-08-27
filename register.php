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
            echo "Signup successful!";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
