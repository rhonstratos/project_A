<?php require_once "config.php"; ?>
<nav class="row">
    <div>
        <span>Willy Wonka's Chocolate Factory</span>
    </div>
    <div>
        <form action="./inventory.php" method="get" class="row search-form">
            <input type="text" class="search pad-horizontal-1" placeholder="Search" name="search" id="search">
            <button type="submit" class="search-btn"><img src="../assets/search.png" width="10" alt="Search"></button>
        </form>
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