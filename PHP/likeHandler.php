<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../html/login.php?error=must_login');
    exit();
}

if (isset($_POST['like_post']) && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $username = $_SESSION['username'];
 
    $servername = "talsprddb02.int.its.rmit.edu.au";
    $username_db = "COSC3046_2402_G11";
    $password_db = "6g27lTiEeGA1";
    $dbname = "COSC3046_2402_G11";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT id FROM userData WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        $sql_check_like = "SELECT * FROM postLikes WHERE post_id = ? AND user_id = ?";
        $stmt_check_like = $conn->prepare($sql_check_like);
        $stmt_check_like->bind_param("ii", $post_id, $user_id);
        $stmt_check_like->execute();
        $result_like = $stmt_check_like->get_result();

        if ($result_like->num_rows > 0) {
            $sql_delete_like = "DELETE FROM postLikes WHERE post_id = ? AND user_id = ?";
            $stmt_delete_like = $conn->prepare($sql_delete_like);
            $stmt_delete_like->bind_param("ii", $post_id, $user_id);

            if ($stmt_delete_like->execute()) {
                header('Location: ../html/discussion.php');
                exit();
            } else {
                echo "<p>Error unliking post: " . $stmt_delete_like->error . "</p>";
            }

            $stmt_delete_like->close();
        } else {
            $sql_insert_like = "INSERT INTO postLikes (post_id, user_id) VALUES (?, ?)";
            $stmt_insert_like = $conn->prepare($sql_insert_like);
            $stmt_insert_like->bind_param("ii", $post_id, $user_id);

            if ($stmt_insert_like->execute()) {
                header('Location: ../html/discussion.php');
                exit();
            } else {
                echo "<p>Error liking post: " . $stmt_insert_like->error . "</p>";
            }

            $stmt_insert_like->close();
        }
    } else {
        echo "<p>Error: Username not found or multiple users found.</p>";
    }

    $stmt_check_like->close();
    $conn->close();
}
?>