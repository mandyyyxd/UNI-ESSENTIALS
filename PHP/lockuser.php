<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../html/login.php");
    exit();
}

$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_G11";
$password = "6g27lTiEeGA1";
$dbname = "COSC3046_2402_G11";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = filter_input(INPUT_POST, 'userId', FILTER_VALIDATE_INT);

if ($userId === false) {
    header("Location: ../html/admin.php?error=invalid_user_id");
    exit();
}

$sql = "UPDATE userData SET status = 'inactive' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location: ../html/admin.php?success=user_locked");
} else {
    header("Location: ../html/admin.php?error=update_failed");
}

$stmt->close();
$conn->close();
exit();
?>