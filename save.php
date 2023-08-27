<?php

<?php
// Start the session
session_start();

$_SESSION["favcolor"]

$_SESSION["favcolor"]


$_SESSION["username"]
$_SESSION["key"] 

// Handle database connection and saving data to the database


$_SESSION["favcolor"]
if (isset($_POST['content'])) {
    $content = $_POST['content'];
    $uniqueId = '66'; // Set the unique ID you want to target
    
    try {
        // Connect to the database
        $pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'root', '');

        // Prepare and execute the SQL query to update content based on unique ID
        $stmt = $pdo->prepare("UPDATE documents SET content = :content WHERE id = :id");
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':id', $uniqueId, PDO::PARAM_STR);
        $stmt->execute();

        echo 'Updated successfully!';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
