<!doctype html>
<html lang="de">
<title>Bestellen</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
require_once "header.view.php";
?>

<!-- Bestellformular -->
<?php if (!isset($_SESSION["user_id"])): ?>
<div class="container mt-3">
    <h3>Bestellformular</h3>
    <p>Füllen Sie bitte alle Felder aus</p>

    <form name="order-customer-form" action="<?php echo $globalpath ?>/includes/user_actions.inc.php" method="post" onsubmit="submitOrder()">
        <div class="mb-3 mt-3">
            <label for="order-c-ln" class="form-label">Name:</label>
            <input type="text" class="form-control" id="order-c-ln" name="order-c-ln" placeholder="Mustermann" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-fn" class="form-label">Vorname:</label>
            <input type="text" class="form-control" id="order-c-fn" name="order-c-fn" placeholder="Max" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-e" class="form-label">E-Mail:</label>
            <input type="email" class="form-control" id="order-c-e" name="order-c-e" placeholder="MaxMustermann@muster.de" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-a" class="form-label">Adresse:</label>
            <input type="text" class="form-control" id="order-c-a" name="order-c-a" placeholder="PLZ Ort, Strasse Haus-nr." required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-c" class="form-label">Telefonnummer:</label>
            <input type="tel" class="form-control" id="order-c-c" name="order-c-c" placeholder="+49..." pattern="(((\+|00+)49)|0)[1-9]\d+" required>

        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-success px-5" id="order-access" name="order-customer-data" role="button" type="submit">jetzt bestellen</button>
            <a class="btn btn-secondary ml-1" id="order-cancel" href="<?php echo $globalpath ?>/projekt1/ordering.php">abbrechen</a>
        </div>
    </form>
</div>
<?php else: ?>
    <script src="<?php echo $globalpath ?>/assets/js/order_confirmation.js"></script>
<div class="container mt-3">
    <h3>Bestellformular</h3>
    <p>Füllen Sie bitte alle Felder aus</p>

    <form id="order-customer-form" name="order-customer-form" action="<?php echo $globalpath ?>/includes/user_actions.inc.php" method="post" onsubmit="submitOrder()">
        <?php $uS->showOrderUserProfileData(); ?>
        <input name="order-customer-data" hidden>
        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-success px-5" id="order-access" type="button" onclick="checkUserData()">jetzt bestellen</button>
            <a class="btn btn-secondary ml-1" id="order-cancel" href="<?php echo $globalpath ?>/ordering.php">abbrechen</a>
        </div>
    </form>
</div>
    <!-- Modal -->
    <div class="modal fade" id="saveUserData" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Wollen Sie die eingegebenen Daten für zukünftige Bestellungen speichern?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button id="ds-userOrderChanges-btn" type="button" class="btn btn-secondary" onclick="$('#order-customer-form').submit();">Nein</button>
                    <button id="s-userOrderChanges-btn" type="button" class="btn btn-primary" onclick="setUserData()">Ja</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php
require_once "footer.view.php";
?>