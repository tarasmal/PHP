<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$author_id = isset($_GET['author_id']) ? intval($_GET['author_id']) : 0;

if ($author_id > 0) {
    $sql = "SELECT images.id, authors.id AS author_id, authors.name AS author, images.filename, images.upload_date, images.timestamp
            FROM images
            JOIN authors ON images.author_id = authors.id
            WHERE authors.id = $author_id";
    $heading = "Images by Author ID: $author_id";
} else {
    $sql = "SELECT images.id, authors.id AS author_id, authors.name AS author, images.filename, images.upload_date, images.timestamp
            FROM images
            JOIN authors ON images.author_id = authors.id";
    $heading = "All Images";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h1><?php echo $heading; ?></h1>

<?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Image ID</th><th>Author</th><th>Filename</th><th>Upload Date</th><th>Timestamp</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td><a href='http://localhost:63343/htdocs/tasks/show_author.php?author_id=" . $row["author_id"] . "'>" . $row["author"] . "</a></td><td>" . $row["filename"] . "</td><td>" . $row["upload_date"] . "</td><td>" . $row["timestamp"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No images found.</p>";
}

$conn->close();
?>

<p><a href="show_authors.php">View All Authors</a></p>

</body>
</html>
