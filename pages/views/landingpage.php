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

<body>
    <div class="big-center pad-horizontal-3 pad-vertical-1 shadow-2">
        <h2>Avie's Chocolate Store</h2>
        <p>Please login/register to continue</p>
        <input type="button" value="Proceed to Login or Register" onclick="location.href='./login.php';">
    </div>
</body>

</html>