<?php
//require __DIR__ . "/../config/userService.php";
session_start();
require __DIR__ . "/../src/UserService.php";
require __DIR__ . "/../src/DeliveryService.php";
if (isset($_SESSION['user_id']))
    $uS = new UserService($_SESSION["user_id"]);
$dS  = new DeliveryService();
$globalpath = "http://localhost/projekt1";


if(isset($_POST["submit-order"])){
    $data = json_decode($_POST["submit-order"],true);
    $dS->updateOrderPositionsCount($data);
}

if(isset($_POST["order-position-delete"])){
    $dS->deleteOrderPosition($_POST["order-position-delete"]);
    $dS->showPositions();
}

if(isset($_POST["delete_all_order_positions"])) {
    $dS->deleteAllOrderPositions();
    $dS->showPositions();
    die();
}

if(isset($_POST["favorite-add"])){
    if(!($uS->addUserFavorite($_POST["favorite-add"]))){
        echo "delete";
    }
    die();
}

if(isset($_POST["get-ordering"])){
    $dS->showPositions();
    die();
}

if(isset($_POST["order-position-add"])){
    if(!isset($_POST["ordering"])){
        if(!($dS->addOrderPosition($_SESSION["order_nr"],$_POST["order-position-add"]))){
            echo "delete";
        }
    } else {
        $dS->addOrderPosition($_SESSION["order_nr"],$_POST["order-position-add"]);
        $dS->showPositions();
    }
    die();
}


if(isset($_POST["dashboard-order-position-delete"])){
    $dS->deleteOrderPosition($_POST["dashboard-order-position-delete"]);
}

die();