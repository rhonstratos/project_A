<?php
session_start();
require_once "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php" ?>
    <title>Home</title>
    <style>
        head,
        body {
            height: 95vh;
        }
    </style>
</head>

<body>
    <div class="big-center pad-horizontal-3 pad-vertical-1 shadow-2">
        <?php if (!isset($_SESSION['LOGGED_IN'])) { ?>
            <h2>Avie's Chocolate Store</h2>
            <p>Please login/register to continue</p>
            <input type="button" value="Proceed to Login or Register" onclick="location.href='./login.php';">
            <?php } else if (isset($_SESSION['LOGGED_IN'])) {
            if (isset($_SESSION['USER'])) {
                header("location: ./home.php");
            } else if (isset($_SESSION['ADMIN'])) {
            ?>
                <h2>Admin Panel</h2>
                <div class="row" style="gap:10px;">
                    <input type="button" value="Browse Shop" onclick="location.href='./home.php';">
                    <input type="button" value="Inventory" onclick="location.href='./inventory.php';">
                    <input type="button" value="Logout" onclick="location.href='../includes/logout.php';">
                </div>
        <?php }
        } ?>
    </div>
</body>

</html>