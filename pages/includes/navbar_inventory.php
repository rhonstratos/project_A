<?php require_once "config.php"; ?>
<nav class="row">
    <div>
        <span>Willy Wonka's Chocolate Factory</span>
    </div>
    <div class="row-end">
        <a href="./registerItem.php" class="nav-item nostyle">Register Item</a>
        <a href="./inventory.php" class="nav-item nostyle">Inventory</a>
        <div class="dropdown fit">
            <button class="dropbtn" type="button">Admin</button>
            <div class="dropdown-content">
                <a href="./" class="nostyle">Admin Panel</a>
                <a href="../includes/logout.php" class="nostyle">Logout</a>
            </div>
        </div>
    </div>
</nav>