<!doctype html>
<html lang="de">
<title>GastroWeb</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
session_start();
echo $_SESSION['order_nr'];
$globalpath = "http://localhost:8888/projekt1";
require "views/header.view.php";
$foodS->showActiveFood();
require "views/footer.view.php";
?>