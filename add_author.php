<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $sql = "INSERT INTO authors (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        echo "New author added successfully";
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
    <title>Add Author</title>
</head>
<body>

<h1>Add Author</h1>
<form method="post" action="">
    Name: <input type="text" name="name">
    <input type="submit" value="Add Author">
</form>

<p><a href="show_authors.php">View All Authors</a></p>

</body>
</html>
