<?php
require_once "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php" ?>
    <title>Welcome</title>
    <style>
        head,
        body {
            height: 95vh;
        }
    </style>
</head>

<body class="loginBG m-5 p-5">
    <div class="container-fluid m-auto mt-5 py-5 w-25 text-white">
        <h2>Avie's Chocolate Store</h2>
        <p>Please login/register to continue</p>
        <button type="button" class="btn btn-primary" onclick="location.href='./login.php';">Proceed to Login or Register</button>
    </div>
</body>

</html>