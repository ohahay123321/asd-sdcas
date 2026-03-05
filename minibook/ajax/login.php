<?php
session_start();
include("../config/database.php");

$email = $_POST['email'];
$password = $_POST['password'];

$res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($res);

if($user && password_verify($password, $user['password'])){
    $_SESSION['user_id'] = $user['id'];
    echo "success";
} else {
    echo "Invalid Credentials";
}
?>
