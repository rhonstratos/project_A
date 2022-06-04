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

<body>
    <div class="text-center">
        <h1>Purchases</h1>
        <div style="flex-direction: column-reverse !important; margin-bottom: 5rem;">
            <?php $transac->fillPurchases($_SESSION['USER']); ?>
        </div>
    </div>
</body>

</html>