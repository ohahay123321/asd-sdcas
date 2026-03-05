<?php
include("../config/database.php");

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$filename = "default.png";

if(!empty($_FILES['profile_pic']['name'])){
    $filename = time() . $_FILES['profile_pic']['name'];
}

move_uploaded_file($_FILES['profile_pic']['tmp_name'], "../assets/uploads/".$filename);

mysqli_query($conn,"INSERT INTO users(fullname, email, password, profile_pic) VALUES('$fullname', '$email', '$password', '$filename')");

echo "Registered Successfully";
?>
