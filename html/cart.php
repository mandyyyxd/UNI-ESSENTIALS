<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI ESSENTIALS</title>
    <link rel="stylesheet" href="../css/basicLayout.css">
    <link rel="stylesheet" href="../css/cart.css">
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
            <a href="technology.php">Technology</a>
            <a href="accessories.php">Accessories</a>
            <a href="discussion.php">Discussion Forums</a>
            <a href="cart.php" class="selected">Shopping Cart</a>
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
            <?php
            echo '<div class="cartTitle"><h2>Shopping cart</h2></div>';
            echo '<div class="cartContent">';
                if (isset($_SESSION['firstName'])) {
                    if (!empty($_SESSION['cart'])) {
                        echo '<div class="itemContent">';
                            echo '<ul id="cart-items">';
                            foreach ($_SESSION['cart'] as $itemNo => $item) {
                                echo '<li>';
                                echo '<img alt="Product image" src="' . htmlspecialchars($item['imgPath']) . '" alt="' . htmlspecialchars($item['name']) . '" class="product-image">';
                                echo '<h3 class="name">' . htmlspecialchars($item['name']) . '</h3>';
                                echo '<p class="price">$<span class="item-price">' . htmlspecialchars($item['price']) . '</span></p>';
                                echo '<form action="../PHP/cart2.php" method="post">';
                                echo '<input type="hidden" name="itemNo" value="' . htmlspecialchars($itemNo) . '">';
                                echo '<p class="quantity">';
                                echo '<button type="submit" name="action" value="decrease">-</button>';
                                echo '<span class="item-quantity">' . htmlspecialchars($item['quantity']) . '</span>';
                                echo '<button type="submit" name="action" value="increase">+</button>';
                                echo '</p><br>';
                                echo '<button class="remove" type="submit" name="action" value="remove">Remove</button>';
                                echo '</form>';
                                echo '</li>';
                            }
                            echo '</ul>';
                            echo '<form action="../html/technology.php" method="POST">';
                            echo '<button class="continue" type="submit" name="continue" value="continue">Continue Shopping</button>';
                            echo '</form>';
                        echo '</div>';

                        echo '<div class="userContent">';
                            $total = 0;
                            foreach ($_SESSION['cart'] as $item) {
                                $total += $item['price'] * $item['quantity'];
                            }
                            if (isset($_SESSION['coupon'])) {
                                $total *= 0.5;
                            }
                            echo '<p id="total-amount">Total: $<span id="total">' . number_format($total, 2) . '</span></p>';

                            echo '<form action="../PHP/cart2.php" method="post">';
                            echo '<p>Use <strong>FANTASTIC4</strong> as the coupon code to get 50% off on total amount.</p>';
                            echo '<br>';
                            echo '<label for="coupon">Coupon Code:</label>';
                            echo '<input type="text" id="coupon" name="coupon" placeholder="Enter coupon code">';
                            echo '<button type="submit" name="action" value="applyCoupon" id="applyCoupon">Apply</button>';
                            echo '</form>';

                            echo '<div class="address-details">';
                            echo '<h2>Address Details</h2>';
                            echo '<label for="streetAddress">Street Address:</label>';
                            echo '<input type="text" id="streetAddress" name="streetAddress" required>';
                            echo '<div id="addressValidation" class="autocomplete"></div>';
                            
                            echo '<div class="card-details">';
                            echo '<h2>Card Details</h2>';
                            echo '<label for="cardNumber">Card Number:</label>';
                            echo '<input type="text" id="cardNumber" name="cardNumber" required>';
                            echo '<span id="cardNumberError" class="errorMessage"></span>';
                            echo '<br>';
                            
                            echo '<label for="cardName">Name on Card:</label>';
                            echo '<input type="text" id="cardName" name="cardName" required>';
                            echo '<span id="cardNameError" class="errorMessage"></span>';
                            echo '<br>';
                            
                            echo '<label for="expDate">Expiry Date:</label>';
                            echo '<input type="text" id="expDate" name="expDate" placeholder="MM/YY" required>';
                            echo '<span id="expDateError" class="errorMessage"></span>';
                            echo '<br>';
                            
                            echo '<label for="cvv">CVV:</label>';
                            echo '<input type="text" id="cvv" name="cvv" required>';
                            echo '<span id="cvvError" class="errorMessage"></span>';
                            echo '<br>';
                            echo '</div>';
                            
                            echo '<button type="submit" class="checkoutButton" id="checkoutButton">Checkout</button>';
                            echo '</form>';
                        echo '</div>';
                    } 
                    else 
                    {
                        echo '<div id="continueShopping">';
                            echo '<b><p>Your cart is empty. Please add an Item to continue.</p><b><br>';
                            echo '<form action="../html/technology.php" method="POST">';
                            echo '<button class="continue" type="submit" name="continue" value="continue">Continue Shopping</button>';
                            echo '</form>';
                        echo '</div>';
                    }
                } 
                else
                {
                    echo '<div id="continueShopping">';
                        echo '<form action="../html/technology.php" method="POST">';
                        echo '<button class="continue" type="submit" name="continue" value="continue">Continue Shopping</button>';
                        echo '</form>';
                    echo '</div>';

                    echo '<div id="authModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Sign Up or Log In</h2>
                                <p>You need to sign up or log in to continue to the shopping cart.</p>
                                <button id="loginButton" onclick="window.location.href=\'login.php\'">Login</button>
                                <button id="signupButton" onclick="window.location.href=\'signup.php\'">Sign Up</button>
                            </div>
                        </div>';
                }
                echo '</div>';
            ?>
        </div>
    </main>
    
    <script src="../JavaScript/cart.js"></script>
    <script src="../JavaScript/apiAddress.js"></script>
    <script src="../JavaScript/checkoutValidation.js"></script>

    <footer>
        <script src="../JavaScript/footer.js"></script>
    </footer>
    <script src="../JavaScript/theme.js"></script>

</body>
</html>