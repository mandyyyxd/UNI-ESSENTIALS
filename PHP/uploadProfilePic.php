<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../html/login.php?error=not_logged_in');
    exit();
}

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

if (isset($_POST['submit'])) {
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == 0) {
        $uploadDir = '../Images/userPFP/';

        if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
            header("Location: ../html/account.php?pic_error=Upload directory is not writable");
            exit();
        }

        $fileExtension = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
        
        $newFileName = uniqid() . '.' . $fileExtension;
        
        $uploadFile = $uploadDir . $newFileName;

        if (!is_uploaded_file($_FILES['profilePic']['tmp_name'])) {
            header("Location: ../html/account.php?pic_error=Temporary file is not accessible");
            exit();
        }

        error_log("Upload directory: " . $uploadDir);
        error_log("Upload file path: " . $uploadFile);
        error_log("Temp file path: " . $_FILES['profilePic']['tmp_name']);
        error_log("Upload directory writable: " . (is_writable($uploadDir) ? 'yes' : 'no'));
        
        if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFile)) {
            $profilePicPath = '../Images/userPFP/' . $newFileName;
            
            $stmt = $pdo->prepare("UPDATE userData SET profilePic = :profilePic WHERE email = :email");
            $stmt->execute([
                ':profilePic' => $profilePicPath,
                ':email' => $_SESSION['email']
            ]);

            $_SESSION['profilePic'] = $profilePicPath;
            
            header("Location: ../html/account.php?pic_success=1");
            exit();
        } else {
            header("Location: ../html/account.php?pic_error=File upload failed at move_uploaded_file");
            exit();
        }  
    } else {
        header("Location: ../html/account.php?pic_error=No file uploaded or file upload error");
        exit();
    }
} else {
    header("Location: ../html/account.php");
    exit();
}
?>