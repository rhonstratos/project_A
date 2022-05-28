<?php
session_start();
require "../includes/checkIfLoggedIn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "../includes/head.php" ?>
    <title>Home</title>
</head>

<body>
    <?php 
    require "../includes/navbar.php"; 
        if(isset($_SESSION['LOGGED_IN'])&&isset($_SESSION['ADMIN'])){
            
        }
        else if (isset($_SESSION['LOGGED_IN'])/*&&isset($_SESSION['USER'])*/){
            require "./browse.php";
        }
        else{
            header("location: ./");
        }
    ?>
</body>

</html>