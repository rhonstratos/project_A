<?php
require_once "../includes/config.php";
$browseShop = new Shop();
if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])){
    echo $browseShop->search($_REQUEST['search']);
}
else if (isset($_REQUEST['category']) && !empty($_REQUEST['category'])){
    echo $browseShop->filterByCategory($_REQUEST['category']);
}