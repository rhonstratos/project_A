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
    <?php require_once "../includes/navbar.php"; ?>
    <div class="row" style="align-items: flex-start;">
        <div class="fit">
            <h2>Your Cart</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cart->fillCart($_SESSION['USER']); ?>
                </tbody>
            </table>
            <div class="pad-vertical-1">
                <h3>Total: [PHP <?php echo $cart->getTotal(); ?>]</h3>
                <form action="./checkout.php" method="post">
                    <button type="submit" name="purchase">Purchase All</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>