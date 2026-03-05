<?php
// Assuming you have a function to connect to the database
include 'db_connection.php';

// Get the user ID here (you may need to adjust based on your authentication logic)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
    // Prepare the SQL statement with user_id
    $query = "INSERT INTO comments (post_id, user_id, comment_text, created_at) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    // Assuming $post_id and $comment_text are defined
    $stmt->bind_param('iisi', $post_id, $user_id, $comment_text, $current_time);
    $stmt->execute();
} else {
    // Handle the error for missing user_id
    echo 'Error: User ID not found.';
}
?>
