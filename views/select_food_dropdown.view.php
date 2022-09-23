<?php
session_start();
require __DIR__ . "/../src/FoodService.php";
require __DIR__ . "/../src/DeliveryService.php";
$foodS = new FoodService();
$dS  = new DeliveryService();
$foodS->loadActiveData();
?>
<option value="">Hier die Speisen auswählen</option>
                <?php foreach ($foodS->getActiveCategories() as $category){
    echo '
                <optgroup label="'. $category["category_name"] . '">';

    foreach ($foodS->getFootByCategory($category["id"]) as $food) {
        if(!$dS->isPosition($food["id"])){
            echo '
                <option id="select-foot-' . $food["id"] . '" value="' . $food["id"] . '">' . $food["title"] . '</option>';
        }

    }
} ?>