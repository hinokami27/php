<?php
include 'connectDb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $db = connect();

    // Delete student by ID
    $stmt = $db->prepare("DELETE FROM movies WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    // Close the database connection
    $db->close();

    // Redirect back to the view page
    header("Location: lab2.php");
    exit();
} else {
    echo "Invalid request.";
}