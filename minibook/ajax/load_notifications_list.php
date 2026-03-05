<?php
session_start();
include("../config/database.php");

$uid = $_SESSION['user_id'];
$q = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id=$uid ORDER BY id DESC LIMIT 10");

if(mysqli_num_rows($q) > 0){
    while($row = mysqli_fetch_assoc($q)){
        $readClass = ($row['is_read'] == 0) ? 'unread-notif' : '';
        echo "<a class='dropdown-item notif-item $readClass'>" . $row['message'] . "</a>";
    }
} else {
    echo "<p class='dropdown-item text-center'>No notifications yet</p>";
}
?>