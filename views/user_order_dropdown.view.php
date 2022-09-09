<?php
session_start();
require __DIR__ . "/../src/DeliveryService.php";
$dS  = new DeliveryService();
$dropdown_category = null;
?>
<?php if(isset($_SESSION["order_nr"])): ?>
<?php
    $userPositions = $dS->getSortedOrderPositions();
?>
<?php if($dS->getTotalQty() > 0): ?>
<?php foreach ($userPositions as $position): ?>
    <a class="dropdown-item mt-0 px-0.5" >
        <?php if ($dropdown_category != $position["category_id"]): ?>
            <?php $dropdown_category = $position["category_id"]; ?>
        <div class="dropdown-header mt-2 mb-0 p-0"></div>
            <link rel="icon" type="image/png"
                  href="<?php $dS->getglobalpath() ?>/assets/icons/<?php echo $position["icon_name"] ?>.png"><?php echo $position["category_name"] ?>

        <div class="dropdown-divider"></div>
        <?php endif; ?>
        <button class="dropdown-button" type="button" onclick="addOrderPosition(this.value,true)"
                       value="<?php echo $position["id"] ?>" style="margin-left: 5px; float: right;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                       <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                       <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                   </svg>
        </button>
        <span>
            <?php echo $position["title"] ?>
        </span>
    </a>
<?php endforeach; ?>
        <div class="dropdown-divider"></div>
        <div class="d-grid col-12 mx-auto">
            <a class="order-action-btn" type="button" onclick="deleteAllOrderPositions()">Bestellkorb leeren</a>
        </div>
        <?php if (!(basename($_SERVER["HTTP_REFERER"]) == "ordering.php")): ?>
        <div class="d-grid col-12 mx-auto">
            <a class="order-action-btn btn-success " type="button" href="<?php $dS->getglobalpath() ?>/projekt1/ordering.php" style="text-decoration: none">Zur Bestellung</a>
        </div>
        <?php endif; ?>
<?php else: ?>
    <a class="dropdown-item mt-0 px-0.5" style="animation-duration: 1000ms;">
    <span>
        Bestellkorb ist leer!
    </span>
    </a>
<?php endif; ?>
<?php else: ?>
    <a class="dropdown-item mt-0 px-0.5" style="animation-duration: 1000ms;">
        <span>
            Bestellkorb ist leer!
        </span>
    </a>
<?php endif; ?>
