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

if (isset($_POST['archive']) && $_POST['archive'] === 'true') {
    if (isset($_SESSION['email'])) {
        $stmt = $conn->prepare("UPDATE userData SET status = 'inactive' WHERE email = :email");
        $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            session_destroy();
            header('Location: ../html/login.php?success=archived');
            exit();
        } else {
            header('Location: ../html/account.php?error=archive_failed');
            exit();
        }
    } else {
        header('Location: ../html/login.php?error=not_logged_in');
        exit();
    }
}

$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if (empty($firstName) || empty($lastName) || empty($email)) {
    header('Location: ../html/account.php?error=All fields are required');
    exit();
}

if (isset($_SESSION['email'])) {
    $stmt = $conn->prepare("UPDATE userData SET firstName = :firstName, lastName = :lastName, email = :email WHERE email = :currentEmail");
    $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':currentEmail', $_SESSION['email'], PDO::PARAM_STR);

    if ($stmt->execute()) {
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        header('Location: ../html/account.php?success=true');
    } else {
        header('Location: ../html/account.php?error=update_failed');
        exit();
    }
} else {
    header('Location: ../html/login.php?error=not_logged_in');
    exit();
}
?>