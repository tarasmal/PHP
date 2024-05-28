<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author_id = $_POST['author_id'];
    $name = $_POST['name'];

    $sql = "UPDATE authors SET name='$name' WHERE id='$author_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Author updated successfully";
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
    <title>Edit Author</title>
</head>
<body>

<h1>Edit Author</h1>
<form method="post" action="">
    Author ID: <input type="number" name="author_id" required>
    Name: <input type="text" name="name" required>
    <input type="submit" value="Update Author">
</form>

<p><a href="show_authors.php">View All Authors</a></p>

</body>
</html>
