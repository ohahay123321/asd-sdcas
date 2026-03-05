<?php
session_start();
include("config/database.php");

$user = null;
$count = 0;

if(isset($_SESSION['user_id'])){
    $uid = $_SESSION['user_id'];
    $res = mysqli_query($conn, "SELECT * FROM users WHERE id=$uid");
    $user = mysqli_fetch_assoc($res);
    
    $notif = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id=$uid AND is_read=0");
    $count = mysqli_num_rows($notif);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MiniBook</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="<?php echo !isset($_SESSION['user_id']) ? 'login-bg' : ''; ?>">
    <?php if($user): ?>
    <header class="navbar">
        <div class="logo">MiniBook</div>
        <div class="nav-right">
            
            <div class="dropdown">
                <div id="notifTrigger" class="icon-wrapper">
                    <span class="bell-icon">🔔</span>
                    <?php if($count > 0): ?>
                        <span class="badge"><?php echo $count; ?></span>
                    <?php endif; ?>
                </div>
                <div class="dropdown-content notif-dropdown" id="notifList">
                    <div class="dropdown-header">Notifications</div>
                    <div id="notifContent"></div>
                </div>
            </div>

            <div class="dropdown">
                <div id="profileTrigger" class="icon-wrapper">
                    <img src="assets/uploads/<?php echo $user['profile_pic']; ?>" class="avatar-nav">
                </div>
                <div class="dropdown-content profile-dropdown">
                    <a href="profile.php">Profile</a>
                    <a href="#" id="darkToggle">Dark Mode</a>
                    <hr style="border: 0; border-top: 1px solid #eee; margin: 5px 0;">
                    <a href="logout.php">Logout</a>
                </div>
            </div>

        </div>
    </header>
    <?php endif; ?>
    <div class="container">