<?php
// Handle database connection and fetching data from the database

try {
    // Connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'root', '');

    // Define the ID you want to select
    $selectedId = 66;

    // Prepare and execute the SQL query to fetch content by ID
    $stmt = $pdo->prepare("SELECT content FROM documents WHERE id = :selectedId");
    $stmt->bindParam(':selectedId', $selectedId, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch();
    $content = $result['content'];

    echo $content;
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
