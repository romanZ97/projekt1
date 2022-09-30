<div class="container">
    <h1 class="fw-light text-left text-lg-start mt-4 mb-2" style="padding-left: 20px">Speisen</h1>
    <div class="col-12">
        <div class="input-group mb-3">
<!--            Selektor mit aktiven Speisen, die nicht als Bestellposition angelegt wurden-->
            <select id="food-to-position" class="form-control">
                <option value="">Hier die Speisen auswählen</option>
<!--                Durchlauf über alle aktiven Kategorien-->
                <?php foreach ($foodS->getActiveCategories() as $category){
                    echo '
                <optgroup label="'. $category["category_name"] . '">';

                    foreach ($foodS->getFootByCategory($category["id"]) as $food) {
//                        Deklarieren von Selektorauswahl-Option mit unbestellten Speisen
                        if(!$dS->isPosition($food["id"])){
                            echo '
                <option id="select-foot-' . $food["id"] . '" value="' . $food["id"] . '">' . $food["title"] . '</option>';
                        }
                    }
                } ?>
            </select>
            <div class="input-group-append">
                <button class="btn btn-info" id="select-food-to-position" type="button" onclick="addSelectToOrderPosition()">Hinzufügen</button>
            </div>
        </div>
    </div>
<!--    Bestellposition-Übersicht mit Gesamtpreis und Gesamtmenge-->
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
        <ul id="order-positions-list" class="list list-inline"></ul>
        <div class="d-flex justify-content-end align-items-center">
            <a class="btn btn-success px-5" id="order-access" role="button"
               href="<?php $dS->getglobalpath() ?>/projekt1/views/order_form.view.php">Auswahl bestätigen</a>
            <a class="btn btn-secondary ml-1" id="order-cancel" onclick=""
               href="<?php $dS->getglobalpath() ?>/projekt1/index.php">zurück</a>
        </div>
    </div>
</div>