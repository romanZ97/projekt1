<?php
//require __DIR__ . "/../config/userService.php";
session_start();
require __DIR__ . "/../src/UserService.php";
require __DIR__ . "/../src/DeliveryService.php";
if (isset($_SESSION['user_id']))
    $uS = new UserService($_SESSION["user_id"]);
$dS  = new DeliveryService();
$globalpath = "http://localhost:63342/projekt1";

if(isset($_POST["favorite-delete"])){
    $uS->deleteUserFavorite($_POST["favorite-delete"]);
}

if(isset($_POST["favorite-add"])){
    $uS->addUserFavorite($_POST["favorite-add"]);
    $_SESSION["u_item"] = $_POST["favorite-add"];
}

if(isset($_POST["order-position-add"])){
    $dS->addOrderPosition($_SESSION["order_nr"],$_POST["order-position-add"]);
    $_SESSION["u_order"] = $_POST["order-position-add"];
}

if(isset($_POST["favorite-to-order"])){
    $dS->addOrderPosition($_SESSION["order_nr"],$_POST["favorite-to-order"]);
}

if(isset($_POST["dashboard-order-position-delete"])){
    $dS->deleteOrderPosition($_POST["dashboard-order-position-delete"]);
}

header("Location: $globalpath/index.php");
exit();