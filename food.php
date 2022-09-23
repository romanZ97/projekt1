<!doctype html>
<html lang="de">
<title>GastroWeb</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
require "views/header.view.php";
$foodS->showActiveFood();
require "views/footer.view.php";
?>