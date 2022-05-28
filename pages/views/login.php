<?php
session_start();
class SearchUser
{
    private $path = "../data/users.xml";
    private $xml;
    public function __construct()
    {
        $this->xml = new DOMDocument("1.0");
        $this->xml->preserveWhiteSpace = true;
        $this->xml->formatOutput = true;
        $this->xml->load($this->path, LIBXML_NOBLANKS);
        $this->xml->save($this->path);
        $this->xml->load($this->path);
    }
    public function search($username, $password)
    {
        foreach ($this->xml->getElementsByTagName('user') as $node) {
            $getUsername = $node->getElementsByTagName('username')[0]->nodeValue;
            $getPassword = $node->getElementsByTagName('password')[0]->nodeValue;
            if ($getUsername == $username && $getPassword == $password) {
                $getUserType = $node->getElementsByTagName('type')[0]->nodeValue;
                if ($getUserType == 'admin') {
                    return true;
                } else if ($getUserType == 'user') {
                    return false;
                }
                break;
            }
        }
        return null;
    }
    public function register($username, $password)
    {
        $save = $this->xml;
        $userTypeNode = $save->createElement('type', 'user');
        $userUsernameNode = $save->createElement('username', $username);
        $userPasswordNode = $save->createElement('password', $password);
        $userNode = $save->createElement("user");

        $userNode->appendChild($userTypeNode);
        $userNode->appendChild($userUsernameNode);
        $userNode->appendChild($userPasswordNode);
        $save->getElementsByTagName('users')[0]->appendChild($userNode);
        $save->save($this->path);
    }
}
#run below first
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new SearchUser();
    if (isset($_POST['login'])) {
        #if user click login btn
        $result = $user->search($username, $password);
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
    <?php include("../includes/head.php") ?>
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