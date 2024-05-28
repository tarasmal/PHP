<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image_id = $_POST['image_id'];

    $sql = "DELETE FROM images WHERE id='$image_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Image deleted successfully";
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
    <title>Delete Image</title>
</head>
<body>

<h1>Delete Image</h1>
<form method="post" action="">
    Image ID: <input type="number" name="image_id" required>
    <input type="submit" value="Delete Image">
</form>

<p><a href="show_images.php">View All Images</a></p>

</body>
</html>
