<?php
include('reviews.php'); 
if (!isset($_SESSION['username'])) {
    echo "<p>Unauthorized access.</p>";
    exit();
}

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $conn = connectToDatabase();

    $sql = "SELECT username FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $postAuthor = $row['username'];
        
        $username = $_SESSION['username'];
        if ($username === 'admin' || $username === $postAuthor) {
            $sql_delete = "UPDATE posts set status = 'inactive' WHERE post_id = ?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("i", $post_id);

            if ($stmt_delete->execute()) {
                header('Location: ../html/discussion.php');
            } else {
                echo "<p>Error deleting post: " . $stmt_delete->error . "</p>";
            }
        } else {
            echo "<p>Unauthorized to delete this post.</p>";
        }
    } else {
        echo "<p>Post not found.</p>";
    }

    $stmt->close();
    $stmt_delete->close();
    $conn->close();
} else {
    echo "<p>Invalid request.</p>";
}
?>