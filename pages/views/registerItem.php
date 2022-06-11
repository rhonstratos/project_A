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

<body class="loginBG text-white">
    <?php require_once "../includes/navbar_inventory.php"; ?>
    <div class="text-center m-auto mt-5 w-50 border border-dark border-5 p-5" style="background-color: #a26f45 !important; border-radius: 25px !important;">
        <h1>Register New Item</h1>
        <form action="../includes/config.php" method="POST" enctype="multipart/form-data">
            <table class="table text-white">
                <tbody>
                    <tr>
                        <th>Item Name</th>
                        <td><input class="form-control text-center" name="itmName" type="text"></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input class="form-control text-center" name="itmDesc" type="text"></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>
                            <select name="itmCategory" style="width: 100%;" class="text-center form-control">
                                <option value="" selected disabled>Category</option>
                                <option value="darkChocolates">Dark Chocolate</option>
                                <option value="milkChocolates">Milk Chocolate</option>
                                <option value="whiteChocolates">White Chocolate</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td><input class="form-control text-center" name="itmPrice" type="number"></td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td><input class="form-control text-center" name="itmQuantity" type="number"></td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td><input class="form-control text-center" type="file" name="itmIMG" accept="image/*"></td>
                    </tr>
                </tbody>
            </table>
            <button name="registerNewItem" type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</body>

</html>