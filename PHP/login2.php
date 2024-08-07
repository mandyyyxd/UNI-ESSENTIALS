<?php
session_start();

$host = 'talsprddb02.int.its.rmit.edu.au';
$dbname = 'COSC3046_2402_G11';
$username = 'COSC3046_2402_G11';
$password = '6g27lTiEeGA1';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($email === false || $password === false) {
        header('Location: ../html/login.php?error=invalid_input');
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM userData WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($user['status'] == 'inactive') {
            header('Location: ../html/login.php?error=account_inactive');
            exit();
        }

        $current_time = new DateTime();
        $lockTime = new DateTime($user['lockTime']);
        
        if ($user['try'] >= 3 && $current_time < $lockTime) {
            $time_left = $lockTime->diff($current_time)->format("%i minutes %s seconds");
            header('Location: ../html/login.php?error=locked_out&time_left=' . $time_left);
            exit();
        }

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['firstName'] = $user['firstName'];
            $_SESSION['lastName'] = $user['lastName'];
            $_SESSION['profilePic'] = $user['profilePic'];

            if ($user['email'] == 'admin@admin.com') {
                $_SESSION['role'] = 'admin';
                header('Location: ../html/admin.php');
            } else {
                $_SESSION['role'] = 'user';
                header('Location: ../html/index.php');
            }

            $stmt = $pdo->prepare("UPDATE userData SET try = 0, lockTime = NULL WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            exit();
        } else {
            $try = $user['try'] + 1;
            $lockTime = null;
            if ($try >= 3) {
                $lockTime = $current_time->add(new DateInterval('PT1H'))->format('Y-m-d H:i:s');
            }
            $try_left = 3 - $try;

            $stmt = $pdo->prepare("UPDATE userData SET try = :try, lockTime = :lockTime WHERE email = :email");
            $stmt->bindParam(':try', $try, PDO::PARAM_INT);
            $stmt->bindParam(':lockTime', $lockTime, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            header('Location: ../html/login.php?error=incorrect_password&try_left=' . $try_left);
            exit();
        }
    } else {
        header('Location: ../html/login.php?error=user_not_found');
        exit();
    }
} else {
    header('Location: ../html/login.php');
    exit();
}
?>