
<?php
session_start();
require_once __DIR__ . "/../src/Main.php";
$main = new Main();
if($_SERVER["host"])
if($_POST["order_status"] != "in Lieferung" OR $_POST["order_status"] != "in Bearbeitung" OR $_POST["order_status"] != "Geliefert"){
    $sql = "DELETE FROM `ordering` WHERE `order_nr` = ?;";
    $main->executeQuery($sql,"i", array($_POST["order_nr"]));
    unset($_SESSION["order_nr"]);
}
//onbeforeunload="deleteNAOrder(<?php echo $_SESSION["order_nr"] ?>);"