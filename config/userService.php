<?php
session_start();
require __DIR__ . "/../src/UserService.php";
$uS = new UserService($_SESSION["user_id"]);
$globalpath = "/Projekt1";