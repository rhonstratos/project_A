<?php include_once "config.php";
$user = new User(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="./home.php">Willy Wonka's Chocolate Factory</a>
    </div>
    <div class="container-fluid collapse navbar-collapse">
        <div class="row"></div>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo ucwords($user->getUser()); ?>
                </a>
                <ul class="dropdown-menu align-self-start" aria-labelledby="navbarDropdown">
                    <li><a href="../includes/logout.php" class="nav-link" style="text-align: center;">Logout</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="./checkout.php" class="nav-link">Checkout Cart</a></li>
            <li class="nav-item"><a href="./purchases.php" class="nav-link">Purchase History</a></li>
        </ul>
    </div>
</nav>