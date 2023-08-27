<?php
// Start the session
session_start();

// Get the username and user_key from the session
$u_name = $_SESSION["username"];
$u_key = $_SESSION["key"];

if (isset($_POST['content'])) {
    $content = $_POST['content'];
    
    try {
        // Connect to the database
        $pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'root', '');

        // Prepare and execute the SQL query to update content based on username and user_key
        $stmt = $pdo->prepare("UPDATE users SET content = :content WHERE username = :username AND user_key = :user_key");
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':username', $u_name, PDO::PARAM_STR);
        $stmt->bindParam(':user_key', $u_key, PDO::PARAM_STR);
        $stmt->execute();

        echo 'Updated successfully!';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
