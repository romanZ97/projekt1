<?php
require __DIR__ . "/../src/FoodService.php";
$globalpath = "http://localhost:8888/projekt1";
$foodS = new FoodService();
$foodS->loadActiveData();
$order = null;
if (isset($_POST["order_positions"])){
    $order = $data = json_decode($_POST["order_positions"],true);
}
?>
<option value="">Hier die Speisen auswählen</option>
<?php foreach ($foodS->getActiveCategories() as $category):?>
<optgroup label="<?php echo $category["category_name"] ?>">
    <?php foreach ($foodS->getFootByCategory($category["id"]) as $food):?>
        <?php if($order AND ($order["order_total_qty"] > 0)): ?>
            <?php if(!in_array($food["id"],array_keys($order["order_positions"]))): ?>
                <option id="select-foot-<?php echo $food["id"] ?>" value="<?php echo $food["id"] ?>"><?php echo $food["title"] ?></option>';
            <?php endif; ?>
        <?php else: ?>
            <option id="select-foot-<?php echo $food["id"] ?>" value="<?php echo $food["id"] ?>"><?php echo $food["title"] ?></option>';
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>