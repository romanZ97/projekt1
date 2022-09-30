<?php
$globalpath = "http://localhost:8888/projekt1";
$order = null;
if (isset($_POST["order_positions"])){
    $order = $data = json_decode($_POST["order_positions"],true);
}?>
<?php if($order): ?>
    <?php if($order["order_total_qty"] > 0): ?>
        <?php foreach ($order["order_positions"] as $position): ?>
            <li id="list-position-<?php echo $position["id"] ?>" class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
                <span id="title"><?php echo $position["title"] ?></span>
                <input name="order_position-view" value="<?php echo $position["id"] ?>" hidden/>
                <p style="margin-left: 15px"><?php echo $position["portion"] ?></p>
            </div>
            <div class="d-flex flex-row align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <button class="dropdown-button" type="button" value="<?php echo $position["id"] ?>" onclick="add(this.value)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    </button>
                    <div class="counter" style=" margin-left: 15px;">
                        <span id="down-<?php echo $position["id"] ?>" class="down" onClick="decreaseCount(event, this,<?php echo $position["id"] ?>)" >-</span>
                        <input id="position_qty-<?php echo $position["id"] ?>" type="text" value="<?php echo $position["qty"] ?>" readonly>
                        <span id="up-<?php echo $position["id"] ?>" class="up" onClick="increaseCount(event, this,<?php echo $position["id"] ?>)">+</span>
                    </div>
                </div>
                <span class="list-price" id="price-<?php echo $position["id"] ?>"><?php echo number_format($position["price"] * $position["qty"], 2, ",",".") ?> €</span>
            </div>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
                <div class="d-flex justify-content-md-center order-positions-summ">
                    <div class="d-flex flex-row align-items-center">
                        <span style="font-weight: bold">Ihre Bestellung ist leer, wählen Sie was aus</span>
                    </div>
                </div>
    <?php endif; ?>
<?php else: ?>
    <div class="d-flex justify-content-md-center order-positions-summ">
        <div class="d-flex flex-row align-items-center">
            <span style="font-weight: bold">Ihre Bestellung ist leer, wählen Sie was aus</span>
        </div>
    </div>
<?php endif; ?>
