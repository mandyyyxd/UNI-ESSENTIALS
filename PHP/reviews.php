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

function displayPosts() {
    $conn = connectToDatabase();
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

    switch ($sort) {
        case 'oldest':
            $order_by = 'ORDER BY p.post_date ASC';
            break;
        case 'popular':
            $order_by = 'ORDER BY like_count DESC, p.post_date DESC';
            break;
        case 'newest':
        default:
            $order_by = 'ORDER BY p.post_date DESC';
            break;
    }

    $sql = "SELECT p.post_id, p.title, p.username AS post_author, p.post_content, p.post_date, p.upload,
                   COUNT(pl.id) AS like_count
            FROM posts p
            LEFT JOIN postLikes pl ON p.post_id = pl.post_id
            WHERE p.status = 'active'";

    if (!empty($search_query)) {
        $sql .= " AND p.title LIKE ?";
    }

    $sql .= " GROUP BY p.post_id, p.title, p.username, p.post_content, p.post_date $order_by";

    $stmt = $conn->prepare($sql);

    if (!empty($search_query)) {
        $search_param = "%{$search_query}%";
        $stmt->bind_param("s", $search_param);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='table-container'>";
    echo "<h2>Posts</h2><br>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>
                    <div class='title'>" . htmlspecialchars($row["title"]) . "</div>
                    <p class='post-content'>" . htmlspecialchars($row["post_content"]) . "</p>";

            if (!empty($row["upload"])) {
                $file_extension = pathinfo($row["upload"], PATHINFO_EXTENSION);
                if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    echo "<img src='" . htmlspecialchars($row["upload"]) . "' alt='Post Image' style='max-width: 100%;'>";
                } elseif (in_array($file_extension, ['mp4', 'webm', 'ogg'])) {
                    echo "<video controls style='max-width: 100%;'>
                            <source src='" . htmlspecialchars($row["upload"]) . "' type='video/" . htmlspecialchars($file_extension) . "'>
                          Your browser does not support the video tag.
                          </video>";
                }
            }

            echo "<div class='post-details'>
                        <p class='username'>Author: " . htmlspecialchars($row["post_author"]) . "</p>
                        <p class='post-date'>Posted on: " . htmlspecialchars($row["post_date"]) . "</p>
                    </div>
                    <div class='post-actions'>";

                    if (canDeletePost($row['post_author'])) {
                        echo "<form action='../PHP/deleteHandler.php' method='post'>
                                <input type='hidden' name='post_id' value='" . $row['post_id'] . "'>
                                <button type='submit' name='delete_post'>Archive Post</button>
                              </form>";
                    }
            echo"<br>";

            $user_id = isset($_SESSION['username']) ? $_SESSION['username'] : null;
            $post_id = $row['post_id'];
            $like_text = getLikeButtonText($conn, $post_id, $user_id);

            echo '<form action="../PHP/likeHandler.php" method="post">
                    <input type="hidden" name="post_id" value="' . htmlspecialchars($row['post_id']) . '">
                    <button type="submit" name="like_post">' . htmlspecialchars($like_text) . ": " . htmlspecialchars($row["like_count"]) . '</button>
                    <br>
                </form>';

            echo "<form action='../PHP/commentHandler.php' method='post'>
                    <input type='hidden' name='post_id' value='" . htmlspecialchars($row['post_id']) . "'>
                    <input type='text' id='comment' name='comment_content' placeholder='Enter your comment here...' style='width: 100%;' required>
                    <br>
                    <br>
                    <button type='submit' name='submit_comment'>Post Comment</button>
                </form>";

            echo "</div>";
            displayComments($conn, $row['post_id']);
            echo "</div>";
        }
    } else {
        echo "<p>No Posts found.</p>";
    }
    echo "</div>";

    $stmt->close();
    $conn->close();
}
function getLikeButtonText($conn, $post_id, $user_id) {
    $query = "SELECT id FROM userData WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_id);
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
            return "Unlike";
        } else {
            return "Like";
        }
    } else {
        return "Like"; 
    }
}

function displayComments($conn, $post_id) {
    $sql = "SELECT r.replyContent, r.replyTime, u.username AS replyAuthor
            FROM replies r
            LEFT JOIN userData u ON r.user_id = u.id
            WHERE r.post_id = ?
            ORDER BY r.replyTime ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    echo "<div class='comments-section'>";
    echo "<br>";
    echo "<h4>Comments:</h4>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='comment'>
                    <p class='comment-content'>" . htmlspecialchars($row["replyContent"]) . "</p>
                    <br>
                    <p class='comment-details'>- " . htmlspecialchars($row["replyAuthor"]) . " on " . htmlspecialchars($row["replyTime"]) . "</p>
                  </div>";
        }
    } else {
        echo "<p>No Comments yet.</p>";
    }
    echo "</div>";

    $stmt->close();
}

function canDeletePost($postAuthor) {
    if (isset($_SESSION['username'])) {
        $loggedInUser = $_SESSION['username'];
        if ($loggedInUser === 'admin' || $loggedInUser === $postAuthor) {
            return true;
        }
    }
    return false;
}

function insertPost($conn, $username, $post_content, $title, $upload_path) {
    $query = "SELECT id FROM userData WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        $sql = "INSERT INTO posts (user_id, username, post_content, post_date, title, upload) VALUES (?, ?, ?, NOW(), ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            error_log("Prepare statement error: " . $conn->error);
            return false;
        }

        $stmt->bind_param("issss", $user_id, $username, $post_content, $title, $upload_path);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error adding post: " . $stmt->error);
            $stmt->close();
            return false;
        }
    } else {
        error_log("Error: Username not found or multiple users found.");
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_post'])) {
    if (!isset($_SESSION['username'])) {
        header('Location: ../html/login.php?error=must_login');
        exit();
    }

    $title = $_POST['post_title'];
    $content = $_POST['post_content'];
    $username = $_SESSION['username'];

    $upload_path = "";

    if (isset($_FILES['post_file']) && $_FILES['post_file']['error'] == UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['post_file']['tmp_name'];
        $file_name = basename($_FILES['post_file']['name']);
        $upload_path = "../Images/reviewsPic/" . $file_name;
        move_uploaded_file($file_tmp_name, $upload_path);
    }

    $conn = connectToDatabase();
    if (insertPost($conn, $username, $content, $title, $upload_path)) {
        $sort = isset($_POST['sort']) ? $_POST['sort'] : 'newest';
        header("Location: ../html/discussion.php?sort=$sort&post_success=1");
        exit();
    } else {
        $sort = isset($_POST['sort']) ? $_POST['sort'] : 'newest';
        header("Location: ../html/discussion.php?sort=$sort&post_error=Failed to add post");
        exit();
    }
}
?>