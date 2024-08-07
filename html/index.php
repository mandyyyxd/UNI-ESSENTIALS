<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI ESSENTIALS</title>
    <link rel="stylesheet" href="../css/basicLayout.css">
    <link rel="stylesheet" href="../css/indexLayout.css">
    <link rel="stylesheet" href="../css/theme.css">
</head>
<body>
    <header>
        <div class="pageHeading">
            <div class="menu">
                <form>
                    <button type="button" name="menu" id="menu"><img src="../Images/NavImages/Menu_Icon.png" alt="Menu button"></button>
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
            session_start();
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
            <a href="index.php" class="selected">Home</a>
            <a href="technology.php">Technology</a>
            <a href="accessories.php">Accessories</a>
            <a href="discussion.php">Discussion Forums</a>
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
            <div class="container">
                <div id="banner"></div>
            </div>
          
                <div class="cards-container">
          
                    <div class="card">
                        <div id="slideshow1"></div>
                    </div>
  
                    <div class="card">
                        <div id="slideshow2"></div>
                    </div>
        
                    <div class="card">
                            <div class="disCaptions">
                                <h2>Discussion Forums</h2>
                            </div>
                            <a href="discussion.php"> <img src="../Images/discussionImages/reviews.png" alt="Post"> </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <script src="../JavaScript/footer.js"></script>
    </footer>

    <script src="../JavaScript/slideshowImages.js"></script>
    <script src="../JavaScript/theme.js"></script>

    <div id="cookieConsentModal" class="cookie-consent-modal">
        <div class="cookie-consent-content">
            <p>We use cookies to enhance your browsing experience and provide personalized content. By continuing to use our website, you consent to our use of cookies.</p>
            <button id="acceptCookiesButton">Accept Cookies</button>
        </div>
    </div>

    </body>
</html>