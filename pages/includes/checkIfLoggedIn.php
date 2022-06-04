<?php
    if(!isset($_SESSION['LOGGED_IN'])){
        header("Location: ../views/index.php");
    }