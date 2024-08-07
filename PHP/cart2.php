<?php
session_start();

$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_G11";
$password = "6g27lTiEeGA1";
$dbname = "COSC3046_2402_G11";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $itemNo = isset($_POST['itemNo']) ? $_POST['itemNo'] : null;
    $couponCode = isset($_POST['coupon']) ? $_POST['coupon'] : null;

    if ($action == 'add') {
        $sql = "SELECT p.itemNo, p.name, p.price, i.imgPath FROM products p
                LEFT JOIN productImg i ON p.itemNo = i.itemNo
                WHERE p.itemNo = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $itemNo);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if ($product) {
            if (isset($_SESSION['cart'][$itemNo])) {
                $_SESSION['cart'][$itemNo]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$itemNo] = array(
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'imgPath' => $product['imgPath'],
                    'quantity' => 1
                );
            }
        }
    } else {
        if (isset($_SESSION['cart'][$itemNo])) {
            switch ($action) {
                case 'increase':
                    $_SESSION['cart'][$itemNo]['quantity'] += 1;
                    break;
                case 'decrease':
                    if ($_SESSION['cart'][$itemNo]['quantity'] > 1) {
                        $_SESSION['cart'][$itemNo]['quantity'] -= 1;
                    } else {
                        unset($_SESSION['cart'][$itemNo]);
                    }
                    break;
                case 'remove':
                    unset($_SESSION['cart'][$itemNo]);
                    break;
            }
        }

        if ($action == 'applyCoupon') {
            if ($couponCode) {
                $sql = "SELECT coupon FROM coupon WHERE coupon = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $couponCode);
                $stmt->execute();
                $result = $stmt->get_result();
                $coupon = $result->fetch_assoc();

                if ($coupon) {
                    $_SESSION['coupon'] = $couponCode;
                } else {
                    unset($_SESSION['coupon']);
                }
            }
        }
    }
}

header('Location: ../html/cart.php');
exit();
?>