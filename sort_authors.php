<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sql = "SELECT * FROM authors ORDER BY $sort";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort Authors</title>
</head>
<body>

<h1>Authors</h1>
<table>
    <thead>
    <tr>
        <th><a href="?sort=id">ID</a></th>
        <th><a href="?sort=name">Name</a></th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<p><a href="add_author.php">Add New Author</a></p>

</body>
</html>
