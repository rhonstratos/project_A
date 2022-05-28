<?php session_start();
require_once "../includes/config.php"; 
$inventory = new Inventory();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php"; ?>
    <title>Inventory</title>
</head>

<body>
    <?php require_once "../includes/navbar_inventory.php"; ?>
    <div>
        <div class="row" style="align-items: flex-start;">
            <div class="fit">
                <h2>Dark Chocolates</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $inventory->loadInventory("darkChocolates");?>
                    </tbody>
                </table>
            </div>
            <div class="fit">
                <h2>Milk Chocolates</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $inventory->loadInventory("milkChocolates");?>
                    </tbody>
                </table>
            </div>
            <div class="fit">
                <h2>White Chocolates</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $inventory->loadInventory("whiteChocolates");?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>