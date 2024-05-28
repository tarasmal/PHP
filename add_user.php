<?php
$link = mysqli_connect("localhost", "root", "");

if (!$link) {
    die("Не вдалося підключитися: " . mysqli_connect_error());
}
mysqli_query($link, "USE mysql");
mysqli_query($link, "DROP USER admin@localhost");
$create_user_query = "create user admin@localhost identified by 'admin'";
mysqli_query($link, $create_user_query);

$add_privileges = "GRANT ALL PRIVILEGES ON gallery_db.* TO 'admin'@'localhost' IDENTIFIED BY 'admin' WITH GRANT OPTION";


if (mysqli_query($link, $add_privileges)) {
    mysqli_query($link, "FLUSH PRIVILEGES");
    echo "Нового користувача 'admin' успішно створено";
} else {
    echo "Помилка при створенні користувача:  " . mysqli_error($link);
}

mysqli_close($link);
?>
