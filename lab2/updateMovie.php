<?php
include 'connectDb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $year = intval($_POST['year']);

    $db = connect();

    // Update student details
    $stmt = $db->prepare("UPDATE movies SET title = :title, genre = :genre, year = :year WHERE id = :id");
    $stmt->bindValue(':title', $title, SQLITE3_TEXT);
    $stmt->bindValue(':genre', $genre, SQLITE3_TEXT);
    $stmt->bindValue(':year', $year, SQLITE3_TEXT);
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