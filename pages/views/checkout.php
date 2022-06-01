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
        <!-- The Modal -->
        <div id="UpdateCheckoutModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content fit">
            <span class="close" onclick="modal.style.display = 'none';">&times;</span>
            <h2>Update Item</h2>
            <input class="fit" type="text" name="itemNameModal" id="itemNameModal" placeholder="ItemName" readonly="readonly">
            <input class="fit" type="number" name="itemPriceModal" id="itemPriceModal" placeholder="Price" readonly="readonly">
            <input class="fit" type="number" name="itemQuantityModal" id="itemQuantityModal" placeholder="Quantity" >
            <input class="fit" type="button" value="Yes" onclick="updateCheckoutModal()">
            <button class="fit" type="button" onclick="closeAllModal()">No</button>
        </div>
    </div>
    <div id="DeleteCheckoutModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content fit">
            <span class="close" onclick="document.getElementById('modal2').style.display='none';">&times;</span>
            <h2>Continue to Remove item from cart?</h2>
            <input class="fit" type="button" value="Yes" onclick="deleteCheckoutModal()">
            <button class="fit" type="button" onclick="closeAllModal()">No</button>
        </div>
    </div>
</body>

</html>