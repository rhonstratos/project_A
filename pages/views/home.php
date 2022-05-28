<?php
session_start();
require_once "../includes/checkIfLoggedIn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php" ?>
    <title>Home</title>
</head>

<body>
    <?php require_once "../includes/navbar.php";
    if (isset($_SESSION['LOGGED_IN']) && isset($_SESSION['USER'])) {
        require_once "./browse.php";
    } else {
        header("location: ../includes/logout.php");
    } ?>
</body>

</html>