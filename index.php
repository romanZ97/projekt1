<?php session_start();
if (isset($_SESSION['user_id'])) {
    require "src/UserService.php";
    $uS = new UserService($_SESSION['user_id']);
}

$globalpath = "/Projekt1";
require "views/header.view.php";
require "views/dashboard.view.php";
require "views/footer.view.php";