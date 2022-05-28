<?php require "config.php";
$user = new User(); ?>
<nav class="row">
    <div>
        <span>Willy Wonka's Chocolate Factory</span>
    </div>
    <div>
        <form action="./home.php" method="get" class="row search-form">
            <input type="text" class="search pad-horizontal-1" placeholder="Search" name="search" id="search">
            <button type="submit" class="search-btn"><img src="../assets/search.png" width="10" alt="Search"></button>
        </form>
    </div>
    <div class="row-end">
        <a href="./checkout.php" class="nav-item nostyle">Checkout Cart</a>
        <a href="../includes/logout.php" class="nav-item nostyle">Logout as <?php echo $user->getUser(); ?></a>
    </div>
</nav>