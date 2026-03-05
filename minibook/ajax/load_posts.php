<?php
session_start();
include("../config/database.php");

$page = $_POST['page'];
$limit = 5;
$start = ($page - 1) * $limit;

$q = mysqli_query($conn, "SELECT posts.*, users.fullname, users.profile_pic 
                        FROM posts 
                        JOIN users ON posts.user_id = users.id 
                        ORDER BY posts.id DESC 
                        LIMIT $start, $limit");

while($row = mysqli_fetch_assoc($q)){
    $pid = $row['id'];
    $likes = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likes WHERE post_id=$pid"));
    
    echo "<div class='card post'>";
        echo "<div class='post-header'>
                <img src='assets/uploads/" . $row['profile_pic'] . "' class='avatar-feed'> 
                <div class='post-author-info'>
                    <span class='author-name'>" . $row['fullname'] . "</span>
                    <span class='post-date'>Just Now</span>
                </div>
              </div>";
              
        echo "<div class='post-content'>" . htmlspecialchars($row['content']) . "</div>";
        echo "<hr class='sketch-sep'>";
        
        echo "<div class='comment-section'>";
            echo "<div class='post-actions'>
                    <button class='like-btn-sketch' data-id='$pid'>👍 Like ($likes)</button>
                  </div>";
                  
            echo "<div class='comments-list' id='comments-$pid'>";
                echo "<strong>Comments</strong>";
                $comment_q = mysqli_query($conn, "SELECT c.*, u.fullname FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = $pid ORDER BY c.id ASC");
                while($c = mysqli_fetch_assoc($comment_q)){
                    echo "<p class='comment-text'>".htmlspecialchars($c['comment_text'])." - " . $c['fullname'] . "</p>";
                }
            echo "</div>";
            
            // FIXED: Class changed to 'comment-field' to match script.js
            echo "<div class='add-comment-area'>
                    <input type='text' class='comment-field' placeholder='Add a comment...' data-post-id='$pid'>
                  </div>";
        echo "</div>";
    echo "</div>";
}