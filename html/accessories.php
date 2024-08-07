<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI ESSENTIALS</title>
      <link rel="stylesheet" href="../css/basicLayout.css">
      <link rel="stylesheet" href="../css/tech.css">
      <link rel="stylesheet" href="../css/theme.css">
    </head>

<body>
    <header>
        <div class="pageHeading">
            <div class="menu">
                <form>
                    <button type="button" name="menu" id="menu"><img src="../Images/NavImages/Menu_Icon.png" alt="Menu Icon"></button>
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
            <a href="index.php">Home</a>
            <a href="technology.php">Technology</a>
            <a href="accessories.php" class="selected">Accessories</a>
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
            <div class="filter">
                <h2>Filters</h2>
                <form id="filterForm" method="GET" action="accessories.php">
                    <label for="product-type">Product Type:</label>
                    <select id="product-type" name="productType">
                    <option value="All">All</option>
                    <option value="Calculator">Calculator</option>
                    <option value="Headphone">Headphone</option>
                    <option value="Packs">Packs</option>
                    <option value="Computer Accessories">Computer Accessories</option>
                    <option value="Bagpack">Bagpack</option>
                    </select>
                    <br><br>
                    <label for="price">Price Range:</label>
                    <div id="price-range-filters">
                    <input type="checkbox" id="price1" name="price[]" value="1-50">
                    <label for="price1">$1 - $50</label><br>
                    <input type="checkbox" id="price2" name="price[]" value="51-100">
                    <label for="price2">$51 - $100</label><br>
                    <input type="checkbox" id="price3" name="price[]" value="101-150">
                    <label for="price3">$101 - $150</label><br>
                    <input type="checkbox" id="price3" name="price[]" value="151-200">
                    <label for="price3">$151 - $200</label><br>
                    <input type="checkbox" id="price4" name="price[]" value="250+">
                    <label for="price4">$250+</label><br>
                </div>
                <br>
                    <label for="sort">Sort by:</label>
                    <select id="sort" name="sort">
                        <option value="none">None</option>
                        <option value="lowToHigh">Price: Low to High</option>
                        <option value="highToLow">Price: High to Low</option>
                    </select>
                <br><br>
                <button type="submit">Apply Filters</button>
            </form>
            </div>

            <div class="main-section">
                <?php include '../PHP/access.php'; ?>
            </div>
        </div>
    </main>

    <footer>
        <script src="../JavaScript/footer.js"></script>
    </footer>
    <script src="../JavaScript/theme.js"></script>

</body>
</html>