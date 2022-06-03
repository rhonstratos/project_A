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
                        <th>Subtotal</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cart->fillCart($_SESSION['USER']); ?>
                </tbody>
            </table>
            <div class="pad-vertical-1 fit">
                <h3 id="total">Total: [PHP <?php echo $cart->getTotal(); ?>]</h3>
                <input class="fit text-center" type="number" name="payment" id="payment" placeholder="Enter Payment">
                <input class="fit mar-vertical-1" type="button" value="Purchase All" id="purchase" onclick="purchaseCart()">
                <input class="fit" type="button" value="Browse Again" onclick="location.href='./home.php'">
            </div>
        </div>
    </div>
    <div id="modals">
        <!-- The Modal -->
        <div id="UpdateCheckoutModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content fit">
                <span class="close" onclick="closeAllModal();">&times;</span>
                <h2>Update Item</h2>
                <input class="fit" type="text" name="itemNameModal" id="itemNameModal" placeholder="ItemName" readonly="readonly">
                <input class="fit" type="number" name="itemPriceModal" id="itemPriceModal" placeholder="Price" readonly="readonly">
                <input class="fit" type="number" name="itemQuantityModal" id="itemQuantityModal" placeholder="Quantity">
                <input class="fit" type="button" value="Yes" onclick="updateCheckoutModal()">
                <button class="fit" type="button" onclick="closeAllModal()">No</button>
            </div>
        </div>
        <div id="modal2" class="modal">
            <!-- Modal content -->
            <div class="modal-content fit">
                <span class="close" onclick="closeAllModal(); location.href='./checkout.php';">&times;</span>
                <h2>Cart Item Updated!</h2>
                <input class="fit" type="button" value="Okay" onclick="closeAllModal(); location.href='./checkout.php';">
            </div>
        </div>
        <div id="DeleteCheckoutModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content fit">
                <span class="close" onclick="closeAllModal();">&times;</span>
                <h2 id="deletItemName">Continue to Remove item from cart?</h2>
                <input class="fit" id="itmDelete" type="button" value="Yes" onclick="deleteCheckoutModal()">
                <button class="fit" type="button" onclick="closeAllModal()">No</button>
            </div>
        </div>
        <div id="modal3" class="modal">
            <!-- Modal content -->
            <div class="modal-content fit">
                <span class="close" onclick="closeAllModal(); location.href='./checkout.php';">&times;</span>
                <h2>Cart Item Deleted!</h2>
                <input class="fit" type="button" value="Okay" onclick="closeAllModal(); location.href='./checkout.php';">
            </div>
        </div>
    </div>
</body>

</html>