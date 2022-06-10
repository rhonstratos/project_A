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
        $user->register();
        header("location: ./login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("../includes/head.php") ?>
    <title>Login</title>
</head>

<body class="loginBG w-100 h-100 p-5">
    <div class="container-fluid w-50 m-auto mt-5 text-white p-5">
        <form class="m-auto" action="login.php" method="post" autocomplete="off">
            <h1>Login</h1>
            <div class="form-group mb-1">
                <input autofocus class="form-control text-center" type="text" name="username" id="username" placeholder="Username" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control text-center" type="password" name="password" id="password" placeholder="Password" autocomplete="off">
            </div>
            <div class="form-group mt-2 d-flex flex-row justify-content-end gap-2">
                <button class="btn btn-secondary" type="reset">Clear</button>
                <button class="btn btn-primary" type="submit" name="register">Register</button>
                <button class="btn btn-success" type="submit" name="login">Login</button>
            </div>
        </form>
        <?php if (isset($loginFailed) && $loginFailed) { ?>
            <span>Login failed, please try again.</span>
        <?php } ?>
    </div>
</body>

</html>