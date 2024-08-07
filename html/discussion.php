<?php
include('../PHP/reviews.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_post'])) {
    if (!isset($_SESSION['username'])) {
        echo "<p>Unauthorized access.</p>";
        exit();
    }

    $post_id = $_POST['post_id'];
    $conn = connectToDatabase();

    $username = $_SESSION['username'];
    $sql = "SELECT username FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $postAuthor = $row['username'];

        if ($username === 'admin' || $username === $postAuthor) {
            $sql_delete = "DELETE FROM posts WHERE post_id = ?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("i", $post_id);

            if ($stmt_delete->execute()) {
                echo "<p>Post deleted successfully.</p>";
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI ESSENTIALS</title>
    <link rel="stylesheet" href="../css/basicLayout.css">
    <link rel="stylesheet" href="../css/indexLayout.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/discussion.css">
    <link rel="stylesheet" href="../css/theme.css">
</head>
<body>
    <header>
        <div class="pageHeading">
            <div class="menu">
                <form>
                    <button type="button" name="menu" id="menu"><img src="../Images/NavImages/Menu_Icon.png" alt="Menu Button"></button>
                </form>
            </div>
            <div class="logo">
                <a href="index.php"><img src="../Images/NavImages/Uni-Essentials-Logo.png" alt="Uni Essentials Logo"></a>
            </div>
            <div class="search">
                <form>
                    <input type="text" placeholder="Search.." name="searchBar" id="searchBar">
                    <button type="submit" name="searchButton" id="searchButton">Search</button>
                </form>
            </div>
            <?php
            if (isset($_SESSION['profilePic']) && $_SESSION['profilePic'] !== NULL) {
                echo '<img alt="User Profile Picture" id="userProfilePic" src="' . htmlspecialchars($_SESSION['profilePic']) . '" alt="Profile Picture Preview" style="max-width: 200px;">';
            } else {
                echo '<img alt="User Profile Picture" id="userProfilePic" src="../Images/userPFP/Default.jpg" alt="Profile Picture Preview" style="max-width: 200px;">';
            }

            if (isset($_SESSION['firstName'])) {
                echo '<div class="logout">
                        <form action="../PHP/logout.php" method="post">
                            <button type="submit" class="logoutBTN"><img src="../Images/NavImages/Logout.png" alt="Logout Button"></button>
                        </form>
                      </div>';
            }
            ?>
        </div>
        <div class="navbar">
            <a href="index.php">Home</a>
            <a href="technology.php">Technology</a>
            <a href="accessories.php">Accessories</a>
            <a href="discussion.php" class="selected">Discussion Forums</a>
            <a href="cart.php">Shopping Cart</a>
            <?php
            if (isset($_SESSION['firstName'])) {
                echo '<a href="account.php">Hi, ' . htmlspecialchars($_SESSION['firstName']) . '</a>';
            } else {
                echo '<a href="login.php">Login/Register</a>';
            }
            ?>
        </div>
        <script src="../JavaScript/menuButton.js"></script>
    </header>

    <main>
        <div class="content">
        <h2>Discussion Forum</h2>
            <div class="container">
                <div class="forumPostandFilters">
                    <br>
                    <div class="user_input_container">
                        <h2>Create Post</h2>
                        <br>
                        <form action="../PHP/reviews.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="sort" value="<?php echo isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : 'newest'; ?>">
                            <p><input type="text" name="post_title" placeholder="Enter your post title here..."></p>
                            <p><textarea name="post_content" placeholder="Enter your post content here..." rows="4" cols="50"></textarea></p>
                            <p><input type="file" name="post_file" accept="image/*,video/*"></p>
                            <br>
                            <p><button type="submit" name="submit_post">Submit Post</button></p>
                        </form>

                    </div>
                    <br>
                    <div class="search_engine">
                        <h2>Search Posts</h2>
                        <form id="searchForm" method="GET">
                            <input type="text" id="searchQuery" name="search_query" placeholder="Enter search keywords...">
                            <button type="submit">Search</button>
                        </form>

                        <form action="" method="get" id="filterForm">
                            <label for="sort">Sort by:</label>
                            <select name="sort" id="sort" onchange="document.getElementById('filterForm').submit();">
                            <option value="newest" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'newest') echo 'selected'; ?>>Newest</option>
                            <option value="oldest" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'oldest') echo 'selected'; ?>>Oldest</option>
                            <option value="popular" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'popular') echo 'selected'; ?>>Popular</option>
                            </select>
                        </form>
                    </div>
                </div>

                <?php
                displayPosts();
                ?>

            </div>
        </div>
    </main>

    <footer>
        <script src="../JavaScript/footer.js"></script>
    </footer>
    <script src="../JavaScript/theme.js"></script>

</body>
</html>