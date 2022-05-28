<?php include "config.php";
$user = new User(); ?>
<nav class="row">
    <div>
        <span>Avie's Chocolate Store</span>
    </div>
    <div>
        <form action="./home.php" method="get" class="row search-form">
            <input type="text" class="search pad-horizontal-1" placeholder="Search" name="search" id="search">
            <button type="submit" class="search-btn"><img src="../../src/assets/search.png" width="10" alt="Search"></button>
        </form>
    </div>
    <div class="row-end">
        <?php if (isset($_SESSION['ADMIN'])) { ?>
            <a href="#" class="nav-item">Inventory</a>
        <?php } ?>
        <a href="#" class="nav-item">Checkout Cart</a>
        <a href="../includes/logout.php" class="nav-item">Logout as <?php echo $user->getUser(); ?></a>
    </div>
</nav>