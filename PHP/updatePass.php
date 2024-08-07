<?php
session_start();

$dsn = 'mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_G11';
$user = 'COSC3046_2402_G11';    
$pass = '6g27lTiEeGA1';

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$currentPassword = filter_input(INPUT_POST, 'currentPassword', FILTER_SANITIZE_STRING);
$newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
$confirmNewPassword = filter_input(INPUT_POST, 'confirmNewPassword', FILTER_SANITIZE_STRING);

if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
    header('Location: ../html/account.php?password_error=All fields are required');
    exit();
}

if ($newPassword !== $confirmNewPassword) {
    header('Location: ../html/account.php?password_error=Passwords do not match');
    exit();
}

if (isset($_SESSION['email'])) {
    $stmt = $conn->prepare("SELECT password FROM userData WHERE email = :email");
    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($currentPassword, $user['password'])) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE userData SET password = :password WHERE email = :email");
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            header('Location: ../html/account.php?password_success=true');
        } else {
            header('Location: ../html/account.php?password_error=update_failed');
        }
    } else {
        header('Location: ../html/account.php?password_error=Incorrect current password');
    }
} else {
    header('Location: ../html/login.php?error=not_logged_in');
    exit();
}
?>