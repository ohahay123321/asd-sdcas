<?php
session_start();
include("../config/database.php");

$uid = $_SESSION['user_id'];
mysqli_query($conn, "UPDATE notifications SET is_read=1 WHERE user_id=$uid");
echo "success";
?>