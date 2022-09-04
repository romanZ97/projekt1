<!doctype html>
<html lang="de">
<title>GastroWeb</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<?php
session_start();
//unset($_SESSION['order_nr']);
if (isset($_SESSION['user_id'])) {
    require "src/UserService.php";
   $uS = new UserService($_SESSION['user_id']);
}

$globalpath = "http://localhost:63342/projekt1";
require "views/header.view.php";
require "views/dashboard.view.php";
require "views/footer.view.php";