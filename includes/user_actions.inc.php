<?php
//require __DIR__ . "/../config/userService.php";
session_start();
require __DIR__ . "/../src/UserService.php";
require __DIR__ . "/../src/DeliveryService.php";
if (isset($_SESSION['user_id']))
    $uS = new UserService($_SESSION["user_id"]);
$dS  = new DeliveryService();
$globalpath = "http://localhost/projekt1";

if(isset($_POST["favorite-delete"])){
    $uS->deleteUserFavorite($_POST["favorite-delete"]);
}

if(isset($_POST["dashboard-favorite-add"])){
    $uS->addUserFavorite($_POST["dashboard-favorite-add"]);
    $_SESSION["u_item"] = $_POST["dashboard-favorite-add"];

}elseif (isset($_POST["food-favorite-add"])){
    $uS->addUserFavorite($_POST["food-favorite-add"]);
    $_SESSION["u_item"] = $_POST["food-favorite-add"];
    header("Location: $globalpath/food.php");
    exit();
}

if(isset($_POST["dashboard-order-position-add"])){
    $dS->addOrderPosition($_SESSION["order_nr"],$_POST["dashboard-order-position-add"]);
    $_SESSION["u_order"] = $_POST["dashboard-order-position-add"];

} elseif(isset($_POST["food-order-position-add"])){
    $dS->addOrderPosition($_SESSION["order_nr"],$_POST["food-order-position-add"]);
    $_SESSION["u_order"] = $_POST["food-order-position-add"];
    header("Location: $globalpath/food.php");
    exit();
}

if(isset($_POST["favorite-to-order"])){
    $path = basename($_SERVER["HTTP_REFERER"]);
    $dS->addOrderPosition($_SESSION["order_nr"],$_POST["favorite-to-order"]);
    header("Location: $globalpath/$path");
    exit();
}

if(isset($_POST["dashboard-order-position-delete"])){
    $dS->deleteOrderPosition($_POST["dashboard-order-position-delete"]);
}

header("Location: $globalpath/index.php");
exit();