<?php
class User {
    private $admin; private $user;
    public function __construct()
    {
        if(isset($_SESSION["ADMIN"]))
        $this->admin = $_SESSION["ADMIN"];
        if(isset($_SESSION["USER"]))
        $this->user = $_SESSION["USER"];
    }
    public function getUser() {
        if(empty($this->admin))
        return $this->user;
        else if(empty($this->user))
        return $this->admin;
    }
}