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
            <a href="technology.php" class="selected">Technology</a>
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
        <div class="filter">
            <h2>Filters</h2>
            <form id="filterForm" method="GET" action="technology.php">
                <label for="brand">Brand:</label>
                <select id="brand" name="brand">
                    <option value="All">All</option>
                    <option value="Apple">Apple</option>
                    <option value="Acer">Acer</option>
                    <option value="Lenovo">Lenovo</option>
                    <option value="HP">HP</option>
                    <option value="Asus">Asus</option>
                    <option value="Samsung">Samsung</option>
                    <option value="MSI">MSI</option>
                </select>
                <br><br>
                <label for="product-type">Product Type:</label>
                <select id="product-type" name="productType">
                    <option value="All">All</option>
                    <option value="Laptop">Laptop</option>
                    <option value="Handheld Devices">Tablet</option>
                </select>
                <br><br>
                <label for="price">Price Range:</label>
                <div id="price-range-filters">
                    <input type="checkbox" id="price1" name="price[]" value="1-500">
                    <label for="price1">$1 - $500</label><br>
                    <input type="checkbox" id="price2" name="price[]" value="501-1000">
                    <label for="price2">$501 - $1000</label><br>
                    <input type="checkbox" id="price3" name="price[]" value="1001-1500">
                    <label for="price3">$1001 - $1500</label><br>
                    <input type="checkbox" id="price4" name="price[]" value="1501-2000">
                    <label for="price4">$1501 - $2000</label><br>
                    <input type="checkbox" id="price5" name="price[]" value="2001-2500">
                    <label for="price5">$2001 - $2500</label><br>
                    <input type="checkbox" id="price6" name="price[]" value="2500+">
                    <label for="price6">$2500+</label><br>
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
            <?php include '../PHP/tech.php'; ?>
        </div>
    </div>
    </main>

    <footer>
        <script src="../JavaScript/footer.js"></script>
    </footer>
    <script src="../JavaScript/theme.js"></script>

</body>
</html>