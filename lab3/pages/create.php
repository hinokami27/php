<?php
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}
?>

<form action="../handlers/createHandler.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <br />
    <label for="date">Date:</label>
    <input type="date" name="date" id="date" required>
    <br />
    <label for="location">Location:</label>
    <input type="text" name="location" id="location" required>
    <br />
    <label for="type">Event type</label>
    <select name="type" id="type">
        <option value="public">Public</option>
        <option value="private">Private</option>
    </select>
    <br />
    <button type="submit">Add Event</button>
</form>