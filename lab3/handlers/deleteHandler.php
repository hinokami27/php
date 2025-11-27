<?php
include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $type = $_POST['type']?? "";
    $db = connectDatabase();

    if($type == "public") {
        $stmt = $db->prepare("DELETE FROM events WHERE id = :id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
        $db->close();

        header("Location: ../index.php");
        exit();
    }
    else{
        echo "Cant't delete a private event";
        echo "<button onclick='history.back()'>Go back</button>";
    }
    $db->close();
} else {
    echo "Invalid request.";
}
?>