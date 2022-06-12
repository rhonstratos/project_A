<?php
session_start();
require_once "../includes/checkIfLoggedIn.php";
require_once "../includes/config.php";
$inventory = new Inventory(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php"; ?>
    <title>Inventory</title>
</head>

<body class="loginBG text-white">
    <?php require_once "../includes/navbar_inventory.php"; ?>
    <div class="text-center m-auto">
        <div class="row text-center">
            <div class="fit pad-vertical-1">
                <select name="category" id="category" class="form-control w-25 m-auto my-5" onchange="changeInventory(event)">
                    <option value="" selected disabled>Show Inventory</option>
                    <option value="dark_chocolate">Dark Chocolate</option>
                    <option value="milk_chocolate">Milk Chocolate</option>
                    <option value="white_chocolate">White Chocolate</option>
                </select>
            </div>
        </div>
        <div class="container-fluid text-white" style="align-items: flex-start;">
            <div id="targetInventory" class="row">
            </div>
        </div>
    </div>
    <div class="modal fade" id="UpdateInventoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="UpdateInventoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-black">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateInventoryModalLabel">Update Inventory Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group my-3">
                        <span class="input-group-text" id="basic-addon1">Item Name</span>
                        <input class="form-control text-center" type="text" name="itemInventoryNameModal" id="itemInventoryNameModal" placeholder="ItemName" readonly="readonly">
                    </div>
                    <div class="input-group my-3">
                        <span class="input-group-text" id="basic-addon1">Price</span>
                        <input class="form-control text-center" type="number" name="itemInventoryPriceModal" id="itemInventoryPriceModal" placeholder="Price">
                    </div>
                    <div class="input-group my-3">
                        <span class="input-group-text" id="basic-addon1">Quantity</span>
                        <input class="form-control text-center" type="number" name="itemInventoryQuantityModal" id="itemInventoryQuantityModal" placeholder="Quantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="invUpdate" onclick="updateInventoryModal()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DeleteInventoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DeleteInventoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-black">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteInventoryModalLabel">Update Inventory Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 id="deletItemName">Continue to Remove item from cart?</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="itmDelete" onclick="deleteInventoryModal()">Yes</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>