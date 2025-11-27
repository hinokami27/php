<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Movie</title>
</head>
<body>
<form action="addMovie.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>
    <br />
    <label for="genre">Genre:</label>
    <input type="text" name="genre" id="genre" required>
    <br />
    <label for="year">Year:</label>
    <input type="text" name="year" id="year" required>
    <br />
    <button type="submit">Add Movie</button>
</form>
</body>