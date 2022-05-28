<?php
session_start();
include "../includes/checkIfLoggedIn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/head.php" ?>
    <title>Home</title>
</head>

<body>
    <?php 
    include "../includes/navbar.php"; 
        if(isset($_SESSION['LOGGED_IN'])&&isset($_SESSION['ADMIN'])){
            
        }
        else if (isset($_SESSION['LOGGED_IN'])/*&&isset($_SESSION['USER'])*/){
            include "./browse.php";
        }
        else{
            header("location: ./");
        }
    ?>
</body>

</html>