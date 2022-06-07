<?php
session_start();
require_once "../includes/checkIfLoggedIn.php";
require_once "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../includes/head.php"; ?>
    <title>Register New Item</title>
</head>

<body>
    <?php require_once "../includes/navbar_inventory.php"; ?>
    <div class="text-center">
        <h1>Register New Item</h1>
        <form action="../includes/config.php" method="POST" enctype="multipart/form-data">
            <table>
                <tbody>
                    <tr>
                        <th>Item Name</th>
                        <td><input name="itmName" type="text"></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input name="itmDesc" type="text"></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>
                            <select name="itmCategory" style="width: 100%;" class="text-center">
                                <option value="darkChocolates">Dark Chocolate</option>
                                <option value="milkChocolates">Milk Chocolate</option>
                                <option value="whiteChocolates">White Chocolate</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td><input name="itmPrice" type="number"></td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td><input name="itmQuantity" type="number"></td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td><input type="file" name="itmIMG" accept="image/*"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button name="registerNewItem" type="submit" class="pad-horizontal-2">Save</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>