<?php
session_start();
include("../config/database.php");

if(isset($_POST['post_id']) && isset($_POST['comment_text'])){
    $pid = $_POST['post_id'];
    $uid = $_SESSION['user_id'];
    $text = mysqli_real_escape_string($conn, $_POST['comment_text']);

    $q = "INSERT INTO comments (post_id, user_id, comment_text) VALUES ($pid, $uid, '$text')";
    if(mysqli_query($conn, $q)){
        echo "success";
    }
}
?>
