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
            <form id="signUpForm" class="formContainer" action="../PHP/signup.php" method="post">
                <h2>Sign Up</h2>
                <div class="formGroup">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName" placeholder="First Name" >
                </div>
                <div id="firstNameError" class="errorMessage"></div>
                
                <div class="formGroup">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" placeholder="Last Name" >
                </div>
                <div id="lastNameError" class="errorMessage"></div>

                <div class="formGroup">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email" >
                </div>
                <div id="emailError" class="errorMessage"></div>

                <div class="formGroup">
                    <label for="username">Username:</label>
                    <input type="username" name="username" id="username" placeholder="Username" >
                </div>
                <div id="usernameError" class="errorMessage"></div>

                <div class="formGroup">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password" >
                </div>
                <div id="passwordError" class="errorMessage"></div>

                <div class="formGroup">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" >
                </div>
                <div id="confirmPasswordError" class="errorMessage"></div>
                
                <div class="formGroup">
                    <label for="captcha">Captcha:</label>
                    <input type="text" name="captcha" id="captcha" placeholder="Enter the Captcha text" >
                </div>
                
                <div id="captchaError" class="errorMessage"></div>
                <br>
                <div id="captchaText"></div>
                <script src="../JavaScript/captcha.js"></script>

                <button type="submit" class="btn">Create Account</button>
                <span>Already have an account? <a href="login.php">Login</a></span>
            </form>
            <script src="../JavaScript/signUpValidation.js"></script>
        </div>
    </main>

    <footer>
        <script src="../JavaScript/footer.js"></script>
    </footer>
    <script src="../JavaScript/theme.js"></script>

</body>
</html>