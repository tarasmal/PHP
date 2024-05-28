<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$total_authors = $conn->query("SELECT COUNT(*) AS count FROM authors")->fetch_assoc()['count'];
$total_images = $conn->query("SELECT COUNT(*) AS count FROM images")->fetch_assoc()['count'];

$last_month = date('Y-m-d', strtotime('-1 month'));
$authors_last_month = $conn->query("SELECT COUNT(*) AS count FROM authors WHERE DATE(created_at) >= '$last_month'")->fetch_assoc()['count'];
$images_last_month = $conn->query("SELECT COUNT(*) AS count FROM images WHERE DATE(upload_date) >= '$last_month'")->fetch_assoc()['count'];

$last_author = $conn->query("SELECT * FROM authors ORDER BY created_at DESC LIMIT 1")->fetch_assoc();

$top_author = $conn->query("SELECT authors.*, COUNT(images.id) AS image_count FROM authors LEFT JOIN images ON authors.id = images.author_id GROUP BY authors.id ORDER BY image_count DESC LIMIT 1")->fetch_assoc();

$search_results = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_term'])) {
    $search_term = $conn->real_escape_string($_POST['search_term']);
    $search_results = $conn->query("SELECT * FROM images WHERE filename LIKE '%$search_term%'")->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Statistics</title>
</head>
<body>

<h1>Website Statistics</h1>
<ul>
    <li>Total records in authors table: <?php echo $total_authors; ?></li>
    <li>Total records in images table: <?php echo $total_images; ?></li>
    <li>Records in authors table from last month: <?php echo $authors_last_month; ?></li>
    <li>Records in images table from last month: <?php echo $images_last_month; ?></li>
    <li>Last record in authors table: <?php echo $last_author['name']; ?> (ID: <?php echo $last_author['id']; ?>)</li>
    <li>Author with most related records in images table: <?php echo $top_author['name']; ?> (ID: <?php echo $top_author['id']; ?>) with <?php echo $top_author['image_count']; ?> images</li>
</ul>

<h2>Search Images</h2>
<form method="post" action="">
    Search Term: <input type="text" name="search_term" required>
    <input type="submit" value="Search">
</form>

<?php if (!empty($search_results)): ?>
    <h3>Search Results</h3>
    <ul>
        <?php foreach ($search_results as $result): ?>
            <li><?php echo $result['filename']; ?> (ID: <?php echo $result['id']; ?>)</li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
