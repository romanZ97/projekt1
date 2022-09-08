<div class="container">
    <h1 class="fw-light text-left text-lg-start mt-4 mb-2" style="padding-left: 20px">Speisen</h1>
    <div class="col-12">
        <div class="input-group mb-3">
            <input id="userinput" type="text" class="form-control" placeholder="Suche nach einer Speise.."
                   aria-label="Add an item" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-info" id="enter" type="button">Hinzufügen</button>
            </div>
        </div>

    </div>
    <div class="col-12">
        <div id="order-positions-summ" class="d-flex justify-content-between order-positions-summ">
            <div class="d-flex flex-row align-items-center">
                <span id="title">Bestellpositionen:</span>
            </div>
            <div class="d-flex flex-row align-items-center">
                <span id="title">Summe:</span>
                <span id="total-price">-,- €</span>
            </div>
        </div>
        <ul id="order-positions-list" class="list list-inline">
            <?php $dS->showPositions() ?>
        </ul>
        <div class="d-flex justify-content-end align-items-center">
            <div class="btn btn-success px-5" id="order-access" role="button" onclick="submitOrder()">zur Kasse</div>
            <a class="btn btn-secondary ml-1" id="order-cancel" onclick="" href="<?php $dS->getglobalpath() ?>/projekt1/index.php">abbrechen</a>
        </div>
    </div>
</div>




