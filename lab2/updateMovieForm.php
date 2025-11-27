<?php
include 'connectDb.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connect();

    // Fetch the current details of the student
    $stmt = $db->prepare("SELECT * FROM movies WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $movie = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid student ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Movie</title>
</head>
<body>
<h1>Update Movie</h1>

<?php if ($movie): ?>
    <form action="updateMovie.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($movie['id']); ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" required><br><br>
        <label for="genre">Genre:</label>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($movie['genre']); ?>" required><br><br>
        <label for="Year">Age:</label>
        <input type="text" name="year" value="<?php echo htmlspecialchars($movie['year']); ?>" required><br><br>
        <button type="submit">Update Movie</button>
    </form>
<?php else: ?>
    <p>Movie not found.</p>
<?php endif; ?>
</body>
</html>