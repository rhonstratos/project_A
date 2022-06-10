<?php
session_start();
require_once "../includes/checkIfLoggedIn.php";
require_once "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php" ?>
    <title>Welcome</title>
</head>

<body class="loginBG m-5 p-5">
    <div class="container-fluid m-auto mt-5 py-5 w-25 text-white">
        <?php
        if (isset($_SESSION['LOGGED_IN'])) {
            if (isset($_SESSION['USER'])) {
                header("location: ./home.php");
            } else if (isset($_SESSION['ADMIN'])) {
        ?>
                <h2>Admin Panel</h2>
                <div class="row" style="gap:10px;">
                    <button class="btn btn-primary" type="button" onclick="location.href='./home.php';">Browse Shop</button>
                    <button class="btn btn-primary" type="button" onclick="location.href='./inventory.php';">Inventory</button>
                    <button class="btn btn-primary" type="button" onclick="location.href='../includes/logout.php';">Logout</button>
                </div>
        <?php }
        } ?>
    </div>
</body>

</html>