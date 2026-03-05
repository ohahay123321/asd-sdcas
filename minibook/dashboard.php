<?php
include("templates/header.php");

if(!isset($_SESSION['user_id'])) {
    header("Location:index.php");
}
?>

<div class="container">
    
    <div class="card create-post-card">
        <form id="postForm">
            <div class="create-post-header">
                <img src="assets/uploads/<?php echo $user['profile_pic']; ?>" class="avatar">
                <textarea name="content" placeholder="Want to post something, <?php echo explode(' ', trim($user['fullname']))[0]; ?>?" required></textarea>
            </div>
            <div class="create-post-footer">
                <button type="submit">Post</button>
            </div>
        </form>
    </div>

    <div id="posts"></div>
    <div id="loader" class="text-center card">No more post.</div>

</div>

<?php include("templates/footer.php"); ?>