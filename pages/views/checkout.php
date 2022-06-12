<?php
session_start();
require_once "../includes/checkIfLoggedIn.php";
require_once "../includes/config.php";
$cart = new Cart() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php"; ?>
    <title>Checkout</title>
</head>

<body class="loginBG text-white">
    <?php require_once "../includes/navbar.php"; ?>
    <div class="row m-5 text-white" style="align-items: flex-start;">
        <?php
        if ($cart->checkCart($_SESSION['USER'])) {
        ?>
            <div class="container-fluid text-white text-center rounded-3 w-50 border border-5 border-dark p-5 text-black" style="background-color: #c8a37b !important;">
                <h2>Your Cart is Empty!</h2>
            </div>
        <?php
        } else {
        ?>

            <div class="container-fluid text-white rounded-3 w-75 border border-5 border-dark p-5 text-black" style="background-color: #c8a37b !important;">
                <h2>Your Cart</h2>
                <table class="table text-center">
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
                        <?php $cart->fillCart($_SESSION['USER']);
                        ?>
                    </tbody>
                </table>
                <div class="container-fluid navbar mt-3">
                    <h3 id="total">Total: PHP <?php echo $cart->getTotal(); ?></h3>
                    <div>
                        <input class="fit text-center" type="number" name="payment" id="payment" placeholder="Enter Payment">
                        <input class="btn btn-success" type="button" value="Purchase All" id="purchase" onclick="purchaseCart()">
                        <input class="btn btn-outline-secondary" type="button" value="Browse Again" onclick="location.href='./home.php'">
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="modal fade" id="UpdateCheckoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="UpdateCheckoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-black">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateCheckoutModalLabel">Update Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group my-3">
                        <span class="input-group-text" id="basic-addon1">Item Name</span>
                        <input class="form-control text-center" type="text" name="itemNameModal" id="itemNameModal" placeholder="ItemName" readonly="readonly">
                    </div>
                    <div class="input-group my-3">
                        <span class="input-group-text" id="basic-addon1">Price</span>
                        <input class="form-control text-center" type="number" name="itemPriceModal" id="itemPriceModal" placeholder="Price" readonly="readonly">
                    </div>
                    <div class="input-group my-3">
                        <span class="input-group-text" id="basic-addon1">Quantity</span>
                        <input class="form-control text-center" type="number" name="itemQuantityModal" id="itemQuantityModal" placeholder="Quantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-success" onclick="updateCheckoutModal()">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DeleteCheckoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DeleteCheckoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-black">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteCheckoutModalLabel">Delete Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 id="deletItemName">Continue to Remove item from cart?</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="itmDelete" onclick="deleteCheckoutModal()">Yes</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>