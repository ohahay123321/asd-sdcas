<?php
session_start();
include("../config/database.php");

$uid = $_SESSION['user_id'];
$post_id = $_POST['post_id'];

$check = mysqli_query($conn, "SELECT * FROM likes WHERE user_id=$uid AND post_id=$post_id");

if(mysqli_num_rows($check) > 0){
    mysqli_query($conn, "DELETE FROM likes WHERE user_id=$uid AND post_id=$post_id");
} else {
    mysqli_query($conn, "INSERT INTO likes(user_id, post_id) VALUES($uid, $post_id)");
    
    $post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM posts WHERE id=$post_id"));
    
    if($post['user_id'] != $uid){
        mysqli_query($conn, "INSERT INTO notifications(user_id, message) VALUES(" . $post['user_id'] . ", 'Someone liked your post')");
    }
}
?>


