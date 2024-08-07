<?php
session_start();

function connectToDatabase() {
    $servername = "talsprddb02.int.its.rmit.edu.au";
    $username = "COSC3046_2402_G11";
    $password = "6g27lTiEeGA1";
    $dbname = "COSC3046_2402_G11";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function insertComment($conn, $user_id, $post_id, $comment_content) {
    $sql = "INSERT INTO replies (user_id, post_id, replyContent, replyTime) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        error_log("Prepare statement error: " . $conn->error);
        return false;
    }

    $stmt->bind_param("iis", $user_id, $post_id, $comment_content);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        error_log("Error adding comment: " . $stmt->error);
        $stmt->close();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_comment'])) {
    if (!isset($_SESSION['username'])) {
        header('Location: ../html/login.php?error=must_login');
        exit();
    }

    $comment_content = htmlspecialchars($_POST['comment_content']);
    $username = $_SESSION['username'];
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : null;

    $conn = connectToDatabase();

    $query = "SELECT id FROM userData WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        if (insertComment($conn, $user_id, $post_id, $comment_content)) {
            header("Location: ../html/discussion.php");
            exit();
        } else {
            echo "<p>Error adding comment. Please try again later.</p>";
        }
    } else {
        echo "<p>Error: Username not found or multiple users found.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>