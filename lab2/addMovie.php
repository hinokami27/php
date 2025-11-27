<?php
include 'connectDb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"]?? '';
    $genre = $_POST["genre"]?? '';
    $year = $_POST["year"]?? '';

    if(empty($title) || empty($genre) || empty($year)){
        echo "Fill in all the required fields.";
        exit;
    }
    $db = connect();

    $stmt = $db->prepare("INSERT INTO movies (title, genre, year) VALUES (:title,:genre,:year)");
    $stmt->bindParam(":title", $title,SQLITE3_TEXT);
    $stmt->bindParam(":genre", $genre,SQLITE3_TEXT);
    $stmt->bindParam(":year", $year,SQLITE3_TEXT);

    if($stmt->execute()){
        header("Location:lab2.php");
    }
    else{
        echo "Error adding the movie.". $db->lastErrorMsg();
    }

    $db->close();
}
else{
    echo "Invalid request.";
}
?>