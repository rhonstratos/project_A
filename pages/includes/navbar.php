<?php include_once "config.php";
$user = new User(); ?>
<nav class="navbar navbar-expand-lg navbar-dark text-white" style="background-color: #332015 !important;">
    <div class="container-fluid mt-2">
        <div>
            <img class="mb-2 me-2" src="https://cdn.discordapp.com/attachments/798061933567017002/984770891177160754/Untitled_design_2.png" alt="... " height="40">
            <a class="navbar-brand" href="./home.php">Willy Wonka's Chocolate Factory</a>
        </div>
    </div>
    <div class="container-fluid collapse navbar-collapse" id="navbarSupportedContent">
        <div class="row"></div>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span id="user"><?php echo ucwords($user->getUser()); ?></span>
                </a>
                <ul class="dropdown-menu align-self-start" aria-labelledby="navbarDropdown">
                    <li><a href="../includes/logout.php" class="nav-link text-black" style="text-align: center;">Logout</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="./checkout.php" class="nav-link">Checkout Cart</a></li>
            <li class="nav-item"><a href="./purchases.php" class="nav-link">Purchase History</a></li>
        </ul>
    </div>
</nav>