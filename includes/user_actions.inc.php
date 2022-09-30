<?php
session_start();
require __DIR__ . "/../src/UserService.php";
require __DIR__ . "/../src/DeliveryService.php";
require __DIR__ . "/../src/FoodService.php";
require __DIR__ . "/../config/globalpath.php";

if (isset($_SESSION['user_id']))
    $uS = new UserService($_SESSION["user_id"]);
$dS  = new DeliveryService();
$foodS = new FoodService();



if(isset($_POST["submit-order"])){
    $data = json_decode($_POST["submit-order"],true);
    $dS->addOrder($data);
}

if(isset($_POST["update_order"])){
    $data = json_decode($_POST["submit-order"],true);
}

//if(isset($_POST["order-position-delete"])){
//    $dS->deleteOrderPosition($_POST["order-position-delete"]);
//    $dS->showPositions();
//}

if(isset($_POST["delete_all_order_positions"])) {
    $dS->deleteAllOrderPositions();
    die();
}

if(isset($_POST["favorite-add"])){
    if(!($uS->addUserFavorite($_POST["favorite-add"]))){
        echo "delete";
    }
    die();
}

if(isset($_POST["order-select-add"])){
    echo $foodS->getFoodById($_POST["order-select-add"],"ordering");
}

if (isset($_POST['user-profile-submit'])){
    $data = array();
    if (isset($_POST['user-n'])){
        $data["user_name"] = $_POST['user-n'];
    }
    if (isset($_POST['user-sn'])){
        $data["user_surname"] = $_POST['user-sn'];
    }
    if (isset($_POST['user-fn'])){
        $data["user_forename"] = $_POST['user-fn'];
    }
    if (isset($_POST['user-e'])){
        $data["email"] = $_POST['user-e'];
    }
    if (isset($_POST['user-a'])){
        $data["address"] = $_POST['user-a'];
    }
    if (isset($_POST['user-c'])){
        $data["contact"] = $_POST['user-c'];
    }
    $uS->setUserData($data);
    header("Location: $globalpath/views/user_profile.view.php");
    die();
}

if (isset($_POST['order-user-data'])){
    $data = json_decode($_POST["order-user-data"],true);
    if (isset($_SESSION['user_id'])){
        $uS->setUserData($data);
    }
}

if (isset($_POST['order-customer-data'])){
    $data = array();
    if (isset($_POST['order-c-ln'])){
        $data["customer_surname"] = $_POST['order-c-ln'];
    }
    if (isset($_POST['order-c-fn'])){
        $data["customer_forename"] = $_POST['order-c-fn'];
    }
    if (isset($_POST['order-c-e'])){
        $data["customer_email"] = $_POST['order-c-e'];
    }
    if (isset($_POST['order-c-a'])){
        $data["customer_address"] = $_POST['order-c-a'];
    }
    if (isset($_POST['order-c-c'])){
        $data["customer_contact"] = $_POST['order-c-c'];
    }
    $dS->submitOrder($data,"views/order_form.view");

    header("Location: $globalpath/views/order_confirmation.view.php?order=".$_SESSION['order_nr']);
    die();
}

if (isset($_POST["delete-order"])){
    $dS->deleteOrder($_SESSION['order_nr']);
    unset($_SESSION['order_nr']);
}

//if(isset($_POST["dashboard-order-position-delete"])){
//    $dS->deleteOrderPosition($_POST["dashboard-order-position-delete"]);
//}

die();