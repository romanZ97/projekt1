<!doctype html>
<html lang="de">
<title>Bestellen</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
session_start();
echo $_SESSION['order_nr'];
$globalpath = "http://localhost:8888/projekt1";
require_once "views/header.view.php";
?>
<!--<div id="page-container">-->
<!--    <div id="content-wrap">-->
<?php
require "views/order_positions.view.php";
//require "views/order_form.view.php";
require "views/footer.view.php";
?>
