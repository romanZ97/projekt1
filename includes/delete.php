<?php
require __DIR__ . "/../src/DeliveryService.php";
$dS  = new DeliveryService();
if($dS->getStatus() != "in Lieferung" OR $dS->getStatus() != "in Bearbeitung" OR $dS->getStatus() != "Geliefert"){
    $dS->deleteOrder($dS->getNumber());
}
//onbeforeunload="deleteNAOrder(<?php echo $_SESSION["order_nr"] ?>);"