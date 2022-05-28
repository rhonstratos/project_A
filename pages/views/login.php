<?php
session_start();
require_once "../includes/config.php";
#run below first
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new SearchUser($username,$password);
    if (isset($_POST['login'])) {
        #if user click login btn
        $result = $user->search();
        if (!is_null($result) && $result) {
            $_SESSION['ADMIN'] = 'Admin';
            $_SESSION['LOGGED_IN'] = 'true';
            header("location: ./");
        } else if (!is_null($result) && $result == false) {
            $_SESSION['USER'] = $username;
            $_SESSION['LOGGED_IN'] = 'true';
            header("location: ./");
        } else {
            $loginFailed = true;
        }
    } else if (isset($_POST['register'])) {
        #if user click register btn
        $user->register($username, $password);
        header("location: ./login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("../includes/head.php") ?>
    <title>Login</title>
    <style>
        head,
        body {
            height: 95vh;
        }
    </style>
</head>

<body>
    <div class="big-center pad-horizontal-3 pad-vertical-1 shadow-2">
        <form action="login.php" method="post" autocomplete="off">
            <h1>Login</h1>
            <div class="row mar-vertical-1">
                <input class="" type="text" name="username" id="username" placeholder="Username" autocomplete="off">
            </div>
            <div class="row mar-vertical-1">
                <input class="" type="password" name="password" id="password" placeholder="Password" autocomplete="off">
            </div>
            <div class="row login-buttons">
                <button class="mar-1 pad-horizontal-1" type="reset">Clear</button>
                <button class="mar-1 pad-horizontal-1" type="submit" name="login">Login</button>
                <button class="mar-1 pad-horizontal-1" type="submit" name="register">Register</button>
            </div>
        </form>
        <?php if (isset($loginFailed) && $loginFailed) { ?>
            <span>Login failed, please try again.</span>
        <?php } ?>
    </div>
</body>

</html>