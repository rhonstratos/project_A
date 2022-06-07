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

<body>
    <?php require_once "../includes/navbar_inventory.php"; ?>
    <div>
        <div class="row text-center">
            <div class="fit pad-vertical-1">
                <select name="category" id="category" class="mar-vertical-1 pad-horizontal-1 pad-vertical-1" onchange="showInventory(event)">
                    <option value="" selected disabled>Show Inventory</option>
                    <option value="dark_chocolate">Dark Chocolate</option>
                    <option value="milk_chocolate">Milk Chocolate</option>
                    <option value="white_chocolate">White Chocolate</option>
                </select>
            </div>
        </div>
        <div class="row" style="align-items: flex-start;">
            <div id="dark_chocolate" class="fit" style="display: none;">
                <h2>Dark Chocolates</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $inventory->loadInventory("darkChocolates"); ?>
                    </tbody>
                </table>
            </div>
            <div id="milk_chocolate" class="fit" style="display: none;">
                <h2>Milk Chocolates</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $inventory->loadInventory("milkChocolates"); ?>
                    </tbody>
                </table>
            </div>
            <div id="white_chocolate" class="fit" style="display: none;">
                <h2>White Chocolates</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $inventory->loadInventory("whiteChocolates"); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="modals">
        <!-- The Modal -->
        <div id="UpdateInventoryModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content fit">
                <span class="close" onclick="closeAllModal();">&times;</span>
                <h2>Update Item</h2>
                <input class="fit" type="text" name="itemInventoryNameModal" id="itemInventoryNameModal" placeholder="ItemName" readonly="readonly">
                <input class="fit" type="number" name="itemInventoryPriceModal" id="itemInventoryPriceModal" placeholder="Price">
                <input class="fit" type="number" name="itemInventoryQuantityModal" id="itemInventoryQuantityModal" placeholder="Quantity">
                <button class="fit" type="button" id="invUpdate" onclick="updateInventoryModal()">Yes</button>
                <button class="fit" type="button" onclick="closeAllModal()">No</button>
            </div>
        </div>
        <div id="modal2" class="modal">
            <!-- Modal content -->
            <div class="modal-content fit">
                <span class="close" onclick="closeAllModal(); location.href='./inventory.php';">&times;</span>
                <h2>Inventory Item Updated!</h2>
                <input class="fit" type="button" value="Okay" onclick="closeAllModal(); location.href='./inventory.php';">
            </div>
        </div>
        <div id="DeleteInventoryModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content fit">
                <span class="close" onclick="closeAllModal();">&times;</span>
                <h2 id="deletItemName">Continue to remove item from Inventory?</h2>
                <button class="fit" id="itmDelete" type="button" onclick="deleteInventoryModal()">Yes</button>
                <button class="fit" type="button" onclick="closeAllModal()">No</button>
            </div>
        </div>
        <div id="modal3" class="modal">
            <!-- Modal content -->
            <div class="modal-content fit">
                <span class="close" onclick="closeAllModal(); location.href='./checkout.php';">&times;</span>
                <h2>Inventory Item Deleted!</h2>
                <input class="fit" type="button" value="Okay" onclick="closeAllModal(); location.href='./inventory.php';">
            </div>
        </div>
    </div>
</body>

</html>