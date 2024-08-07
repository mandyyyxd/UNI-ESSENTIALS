<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI ESSENTIALS</title>
    <link rel="stylesheet" href="../css/basicLayout.css">
    <link rel="stylesheet" href="../css/userLogin.css">
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
        </div>
        <div class="navbar">
            <a href="index.php">Home</a>
            <a href="technology.php">Technology</a>
            <a href="accessories.php">Accessories</a>
            <a href="discussion.php">Discussion Forums</a>
            <a href="cart.php">Shopping Cart</a>
            <?php
            session_start();
            if (isset($_SESSION['firstName'])) {
                echo '<a href="account.php">Hi, ' . htmlspecialchars($_SESSION['firstName']) . '</a>';
            } else {
                echo '<a href="login.php" class="selected">Login/Register</a>';
            }
            ?>
        </div>
        <script src="../JavaScript/menuButton.js"></script>
    </header>

    <main>
        <div class="content">
            <form id="loginForm" class="formContainer" action="../PHP/login2.php" method="post">
                <h2>Login</h2>
                <div class="formGroup">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="formGroup">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="errorMessage">
                    <?php
                        if (isset($_GET['error'])) {
                            $error_message = '';
                            switch ($_GET['error']) {
                                case 'invalid_input':
                                    $error_message = 'Invalid input. Please try again.';
                                    break;
                                case 'user_not_found':
                                    $error_message = 'User not found. Please check your email.';
                                    break;
                                    case 'incorrect_password':
                                        $error_message = 'Incorrect password.';
                                        if (isset($_GET['try_left'])) {
                                            $try_left = htmlspecialchars($_GET['try_left']);
                                            $error_message .= " Attempts left: $try_left.";
                                        }
                                        break;
                                case 'locked_out':
                                    $time_left = htmlspecialchars($_GET['time_left']);
                                    $error_message = "Account locked due to too many failed login attempts. Try again in $time_left.";
                                    break;
                                case 'must_login':
                                    $error_message = 'Must log in to continue.';
                                    break;
                                default:
                                    $error_message = 'An Unknown Error Occurred. Please Contact the Admin.';
                            }
                            echo '<p class="error">' . htmlspecialchars($error_message) . '</p>';
                        }
                    ?>
                </div>
                <button type="submit" class="btn">Login</button>
                <span>Don't have an account? <a href="signup.php">Create account</a></span>
            </form>
        </div>
    </main>

    <footer>
        <script src="../JavaScript/footer.js"></script>
    </footer>
    <script src="../JavaScript/theme.js"></script>

</body>
</html>
