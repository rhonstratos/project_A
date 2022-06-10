<?php
session_start();
require_once "../includes/checkIfLoggedIn.php";
require_once "../includes/config.php";
$transac = new Transactions();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php"; ?>
    <title>Purchases</title>
</head>
<?php require_once "../includes/navbar.php"; ?>

<body style="background-color: #a26f45 !important;">
    <div class="text-center text-white p-5">
        <h1>Purchases</h1>
        <div class="d-flex flex-column-reverse m-5 mx-auto">
            <?php $transac->fillPurchases($_SESSION['USER']); ?>
        </div>
    </div>
</body>

</html>