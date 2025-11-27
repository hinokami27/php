<?php
include 'connectDb.php';

// Connect to the SQLite database
$db = connect();

// Fetch all students from the database
$query = "SELECT * FROM movies";
$result = $db->query($query);

$genreQuery = "SELECT DISTINCT genre FROM movies";
$genres = $db->query($genreQuery);

if (!$result) {
    die("Error fetching students: " . $db->lastErrorMsg());
}
if(!$genres){
    die("Error fetching genre: " . $db->lastErrorMsg());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Movies</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
<div style="display: flex; align-items: center; justify-content: space-between">
    <h1>Student List</h1>
    <a href="addMovieForm.php">
        Add Movie
    </a>
</div>
<div style="display: inline-block">
    <input onkeyup="filterBySearch()" id="search" type="text" placeholder="Search movies...">
</div>
<div style="display: inline-block">
    <select id="genreSelect" onchange="filterByGenre()">
        <option value="">Choose genre:</option>
        <?php while ($genre = $genres->fetchArray(SQLITE3_ASSOC)) : ?>
            <option value="<?php echo htmlspecialchars($genre['genre']); ?>">
                <?php echo htmlspecialchars($genre['genre']); ?>
            </option>
        <?php endwhile; ?>
    </select>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Genre</th>
        <th>Year</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($movie = $result->fetchArray(SQLITE3_ASSOC)): ?>
                <tr>
                <td><?php echo htmlspecialchars($movie['id']); ?></td>
            <td><?php echo htmlspecialchars($movie['title']); ?></td>
            <td><?php echo htmlspecialchars($movie['genre']); ?></td>
            <td><?php echo htmlspecialchars($movie['year']); ?></td>
            <td>
                <form action="deleteMovie.php" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
                <form action="updateMovieForm.php" method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">
                    <button type="submit">Update</button>
                </form>
            </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No movies found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<script>
    function filterBySearch() {
        let input = document.getElementById("search").value.toLowerCase();
        let rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            let title = row.cells[1].textContent.toLowerCase();
            row.style.display = title.includes(input) ? "" : "none";
        });

        filterByGenre();
    }

    function filterByGenre() {
        let selectedGenre = document.getElementById("genreSelect").value.toLowerCase();
        let rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            if (row.style.display === "none") return;
            let genre = row.cells[2].textContent.toLowerCase();
            if (selectedGenre !== "" && genre !== selectedGenre) {
                row.style.display = "none";
            }
            else{
                row.style.display = "table-row";
            }
        });
        filterBySearch();
    }
</script>
</body>
</html>