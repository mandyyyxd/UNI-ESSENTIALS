<?php
session_start();

$_SESSION = array();

session_destroy();

header('Location: ../html/login.php?logout=true');
exit();
?>