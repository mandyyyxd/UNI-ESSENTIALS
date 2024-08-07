<?php
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $status = 'active';

try {
    $dsn = 'mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_G11';
    $user = 'COSC3046_2402_G11';
    $pass = '6g27lTiEeGA1';
    $conn = new PDO($dsn, $user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO userData (firstName, lastName, email, username, password, status) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $firstName);
    $stmt->bindParam(2, $lastName);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $username);
    $stmt->bindParam(5, $hashedPassword);
    $stmt->bindParam(6, $status);

    $stmt->execute();

    header('Location: ../html/login.php');
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
?>