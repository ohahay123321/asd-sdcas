<?php
session_start();
include("../config/database.php");

$uid = $_SESSION['user_id'];
$content = $_POST['content'];

mysqli_query($conn, "INSERT INTO posts(user_id, content) VALUES('$uid', '$content')");

echo "posted";
?>
