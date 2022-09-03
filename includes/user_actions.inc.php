<?php
//require __DIR__ . "/../config/userService.php";
session_start();
require __DIR__ . "/../src/UserService.php";
require __DIR__ . "/../src/DeliveryService.php";
if (isset($_SESSION['user_id']))
    $uS = new UserService($_SESSION["user_id"]);
$dS  = new DeliveryService();
$globalpath = "http://localhost:63342/Projekt1";

if(isset($_POST["dashboard-favorite-delete"])){
    $uS->deleteUserFavorite($_POST["dashboard-favorite-delete"]);
}

if(isset($_POST["dashboard-favorite-add"])){
    $uS->addUserFavorite($_POST["dashboard-favorite-add"]);
}

if(isset($_POST["dashboard-order-position-add"])){
    $dS->addOrderPosition($_SESSION["order_nr"],$_POST["dashboard-order-position-add"]);
}

if(isset($_POST["dashboard-order-position-delete"])){
    $dS->deleteOrderPosition($_SESSION["order_nr"],$_POST["dashboard-order-position-delete"]);
}

header("Location: $globalpath/index.php");
exit();