<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI ESSENTIALS - Account</title>
    <link rel="stylesheet" href="../css/basicLayout.css">
    <link rel="stylesheet" href="../css/account.css">
    <script src="../JavaScript/darkMode.js"></script>
    <link rel="stylesheet" href="../css/theme.css">
    <script src="../JavaScript/previewProfilePic.js"></script>
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
            <a href="discussion.php">Discussion Forums</a>
            <a href="cart.php">Shopping Cart</a>
            <?php
            if (isset($_SESSION['firstName'])) {
                echo '<a href="account.php" class= "selected">Hi, ' . htmlspecialchars($_SESSION['firstName']) . '</a>';
            } else {
                echo '<a href="login.php">Login/Register</a>';
            }
            ?>
        </div>
        <script src="../JavaScript/menuButton.js"></script>
    </header>
    <main>
        <div class="content">
            <h2>Account Details</h2>
            <div class="accountContent">
                <form id="accountForm" class="formContainer" method="post" action="../PHP/updateInfo.php">
                <h3>User Details</h3>
                <br>
                    <div class="formGroup">
                        <label for="firstName">First Name:</label>
                        <input type="text" name="firstName" id="firstName" value="<?php echo isset($_SESSION['firstName']) ? htmlspecialchars($_SESSION['firstName']) : ''; ?>" required>
                    </div>

                    <div class="formGroup">
                        <label for="lastName">Last Name:</label>
                        <input type="text" name="lastName" id="lastName" value="<?php echo isset($_SESSION['lastName']) ? htmlspecialchars($_SESSION['lastName']) : ''; ?>" required>
                    </div>

                    <div class="formGroup">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>
                    </div>

                    <button type="submit" class="btn">Update Information</button>
                    <br>
                    <div class="errorMessage">
                    <?php
                    if (isset($_GET['success'])) {
                        echo '<p class="success">Information updated successfully!</p>';
                    } elseif (isset($_GET['error'])) {
                        echo '<p class="error">Error updating information. Please try again.</p>';
                    }
                    ?>
                    </div>
                    <br>
                </form>
                    

                <form id="passwordForm" class="formContainer" method="post" action="../PHP/updatePass.php">
                <h3>Reset Password</h3>
                <br>
                    <div class="formGroup">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" name="currentPassword" id="currentPassword" required>
                    </div>

                    <div class="formGroup">
                        <label for="newPassword">New Password:</label>
                        <input type="password" name="newPassword" id="newPassword" required>
                    </div>

                    <div class="formGroup">
                        <label for="confirmNewPassword">Confirm New Password:</label>
                        <input type="password" name="confirmNewPassword" id="confirmNewPassword" required>
                    </div>

                    <button type="submit" class="btn">Reset Password</button>
                    <br>
                    <div class="errorMessage">
                    <?php
                    if (isset($_GET['password_success'])) {
                        echo '<p class="success">Password updated successfully!</p>';
                    } elseif (isset($_GET['password_error'])) {
                        echo '<p class="error">' . htmlspecialchars($_GET['password_error']) . '</p>';
                    }
                    ?>
                    </div>
                </form>

                <div class="formContainer">
                <h3>Account Settings</h3>
                <br>
                <div class="formGroup">
                    <h4>Display Mode:</h4>
                    <script src="../JavaScript/theme.js"></script>
                    <button id="themeButton">Dark Mode</button>
                </div>
                <br>
                <form class="formGroup" id="archiveForm" method="post" action="../PHP/updateInfo.php" onsubmit="return confirmArchive()">
                    <h4>Archive Account:</h4>
                    <button type="submit" id="archiveButton" class="btn" name="archive" value="true">Archive</button>
                </form>

                <script>
                    function confirmArchive() {
                        return confirm("Are you sure you want to archive your account?");
                    }
                </script>

                <br>
                <form id="profilePicForm" class="formGroup" method="post" action="../PHP/uploadProfilePic.php" enctype="multipart/form-data">
                    <h3>Profile Picture</h3>
                    <br>
                    <?php
                    if (isset($_SESSION['profilePic']) && $_SESSION['profilePic'] !== NULL) {
                        echo '<img id="profilePicPreview" src="' . htmlspecialchars($_SESSION['profilePic']) . '" alt="Profile Picture Preview" style="max-width: 200px; margin-top: 10px;">';
                    } else {
                        echo '<img id="profilePicPreview" src="../Images/userPFP/Default.jpg" alt="Profile Picture Preview" style="max-width: 200px; margin-top: 10px;">';
                    }
                    ?>
                    <input type="file" name="profilePic" id="profilePic" accept="image/*" onchange="previewProfilePic(this)" required>
                    <button type="submit" name="submit" class="btn">Upload Picture</button>
                    <br>
                    <div class="errorMessage">
                        <?php
                        if (isset($_GET['pic_success'])) {
                            echo '<p class="success">Profile picture updated successfully!</p>';
                        } elseif (isset($_GET['pic_error'])) {
                            echo '<p class="error">' . htmlspecialchars($_GET['pic_error']) . '</p>';
                        }
                        ?>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <script src="../JavaScript/footer.js"></script>
    </footer>
</body>
</html>