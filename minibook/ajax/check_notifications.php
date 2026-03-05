<?php
session_start();
include("../config/database.php");

$uid = $_SESSION['user_id'];
$q = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id=$uid AND is_read=0");

echo mysqli_num_rows($q);
?>
