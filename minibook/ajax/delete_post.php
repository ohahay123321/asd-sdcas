<?php
// delete_post.php

// Connect to database
require_once 'db_connection.php';

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Prepare the SQL statement to delete the post
    $stmt = $conn->prepare('DELETE FROM posts WHERE id = ?');
    $stmt->bind_param('i', $post_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Post deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete post.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No post ID provided.']);
}
?>