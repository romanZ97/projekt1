<?php
require __DIR__ . "/../config/userService.php";


if(isset($_POST["uf-favorite-delete"])){
    $uS->deleteUserFavorite($_POST["uf-favorite-delete"]);
    header("Location: $globalpath/index.php");
    exit();
}

if(isset($_POST["dashboard-favorite"])){
    $uS->addUserFavorite($_POST["dashboard-favorite"]);
    header("Location: $globalpath/index.php");
    exit();
}