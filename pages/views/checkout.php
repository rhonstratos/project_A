<?php session_start();
require_once "../includes/config.php";
$cart = new Cart() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php"; ?>
    <title>Checkout</title>
</head>

<body>
    <?php require_once "../includes/navbar_inventory.php"; ?>
    <div class="row" style="align-items: flex-start;">
        <div class="fit">
            <h2>Your Cart</h2>
            <h3>Total: 000000</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cart->fillCart($_SESSION['USER']); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>