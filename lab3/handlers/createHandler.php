<?php
include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $date = $_POST['date'] ?? '';
    $location = $_POST['location'] ?? '';
    $type = $_POST['type'] ?? '';


    $db = connectDatabase();

    $stmt = $db->prepare("INSERT INTO events (name, date, location, type) VALUES (:name, :date, :location, :type)");
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':location', $location);
    $stmt->bindValue(':type', $type);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Error adding event: " . $db->lastErrorMsg();
    }

    $db->close();
} else {
    echo "Invalid request method.";
}