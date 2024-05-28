<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author_id = $_POST['author_id'];
    $filename = $_POST['filename'];
    $upload_date = $_POST['upload_date'];
    $timestamp = $_POST['timestamp'];

    $sql = "INSERT INTO images (author_id, filename, upload_date, timestamp) VALUES ('$author_id', '$filename', '$upload_date', '$timestamp')";
    if ($conn->query($sql) === TRUE) {
        echo "New image added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Image</title>
</head>
<body>

<h1>Add Image</h1>
<form method="post" action="">
    Author ID: <input type="text" name="author_id"><br>
    Filename: <input type="text" name="filename"><br>
    Upload Date: <input type="date" name="upload_date"><br>
    Timestamp: <input type="datetime-local" name="timestamp"><br>
    <input type="submit" value="Add Image">
</form>

<p><a href="show_images.php">View All Images</a></p>

</body>
</html>
