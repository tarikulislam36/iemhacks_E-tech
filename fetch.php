<?php
session_start();
// Handle database connection and fetching data from the database

try {
    // Connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'root', '');

    // Define the username and user_key you want to select
    $selectedUsername = $_SESSION["username"];
    $selectedUserKey = $_SESSION["key"];

    // Prepare and execute the SQL query to fetch content by username and user_key
    $stmt = $pdo->prepare("SELECT content FROM users WHERE username = :username AND user_key = :user_key");
    $stmt->bindParam(':username', $selectedUsername, PDO::PARAM_STR);
    $stmt->bindParam(':user_key', $selectedUserKey, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the content from the result
    $result = $stmt->fetch();
    $content = $result['content'];

    echo $content;
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
