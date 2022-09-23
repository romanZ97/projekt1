
<?php
session_start();
require_once __DIR__ . "/../src/Main.php";
$main = new Main();
$test =$_SERVER["host"];
if($_SERVER["host"])
if(isset($_GET["nr"])){
    $sql = "DELETE FROM `ordering` WHERE `order_nr` = ?
            AND (status = 'open' OR status = 'calculated');";
    $main->executeQuery($sql,"i", array($_GET["nr"]));
    unset($_SESSION["order_nr"]);
}

//onbeforeunload="deleteNAOrder(<?php echo $_SESSION["order_nr"] ?>);"