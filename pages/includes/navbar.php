<?php include_once "config.php";
$user = new User(); ?>
<nav class="row">
    <div class="row">
        <a class="nostyle" style="width:100%" href="./home.php">Willy Wonka's Chocolate Factory</a>
    </div>
    <div class="row-end">
        <a href="./checkout.php" class="nav-item nostyle">Checkout Cart</a>
        <a href="./purchases.php" class="nav-item nostyle">Purchase History</a>
        <div class="dropdown fit">
            <button class="dropbtn" type="button" id="user"><?php echo ucwords($user->getUser()); ?></button>
            <div class="dropdown-content">
                <a href="../includes/logout.php" class="nostyle" style="text-align: center;">Logout</a>
            </div>
        </div>
    </div>
</nav>