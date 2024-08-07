<?php
$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_G11";
$password = "6g27lTiEeGA1";
$dbname = "COSC3046_2402_G11";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productType = isset($_GET['productType']) ? $_GET['productType'] : 'All';
$priceRanges = isset($_GET['price']) ? $_GET['price'] : [];
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'none';


$sql = "SELECT m.itemNo, m.category, m.name, m.description, m.price, i.imgPath 
        FROM products m
        LEFT JOIN productImg i ON m.itemNo = i.itemNo
        WHERE m.category IN ('Calculator', 'Headphone', 'Packs', 'Bagpack', 'Computer Accessories')";

if ($productType != 'All') {
    $sql .= " AND m.category = '" . $conn->real_escape_string($productType) . "'";
}

if (!empty($priceRanges)) {
    $priceConditions = [];
    foreach ($priceRanges as $priceRange) {
        if ($priceRange == '250+') {
            $priceConditions[] = "m.price >= 250";
        } else {
            list($min, $max) = explode('-', $priceRange);
            $priceConditions[] = "(m.price >= $min AND m.price <= $max)";
        }
    }
    $sql .= " AND (" . implode(' OR ', $priceConditions) . ")";
}

if ($sort == 'lowToHigh') {
    $sql .= " ORDER BY m.price ASC";
} elseif ($sort == 'highToLow') {
    $sql .= " ORDER BY m.price DESC";
}

$result = $conn->query($sql);

if ($result === FALSE) {
    echo "Error: " . $conn->error;
} else if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-container'>";
        echo "<img src='" . $row["imgPath"] . "' alt='" . $row["name"] . "' class='product-image'>";
        echo "<div class='product-info'>";
        echo "<h2>" . $row["name"] . "</h2>";
        echo "<br><h4>Description:</h4>";
        echo "<p class='desc'>" . $row["description"] . "</p>";
        echo "</div>";
        echo "<div class='add-to-cart'>";
        echo "<p class='price-highlight'>Price: $" . $row["price"] . "</p>";
        echo "<form method='POST' action='../PHP/cart2.php'>";
        echo "<input type='hidden' name='itemNo' value='" . $row["itemNo"] . "'>";
        echo "<input type='hidden' name='action' value='add'>";
        echo "<button type='submit'>Add to Cart</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
