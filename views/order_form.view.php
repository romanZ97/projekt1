<!doctype html>
<html lang="de">
<title>Bestellen</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
session_start();
echo $_SESSION['order_nr'];
$globalpath = "http://localhost:8888/projekt1";
if (isset($_SESSION['user_id'])) {
    require __DIR__ . "/../src/UserService.php";
    $uS = new UserService($_SESSION['user_id']);
}
require_once "../views/header.view.php";
?>

<!-- Bestellformular -->
<?php if (!isset($_SESSION["user_id"])): ?>
<div class="container mt-3">
    <h3>Bestellformular</h3>
    <p>Füllen Sie bitte alle Felder aus</p>

    <form name="order-customer-form" action="<?php echo $globalpath ?>/includes/user_actions.inc.php" method="post">
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
            <input type="text" class="form-control" id="order-c-c" name="order-c-c" placeholder="+49..." required>

        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-success px-5" id="order-access" name="order-customer-data" role="button" type="submit">zur Kasse</button>
            <a class="btn btn-secondary ml-1" id="order-cancel" onclick="" href="<?php $dS->getglobalpath() ?>/projekt1/ordering.php">abbrechen</a>
        </div>
    </form>
</div>
<?php else: ?>
<script>
    function modalUserData(){

    }
</script>
<div class="container mt-3">
    <h3>Bestellformular</h3>
    <p>Füllen Sie bitte alle Felder aus</p>

    <form name="order-customer-form" action="<?php echo $globalpath ?>/includes/user_actions.inc.php" method="post">
        <div class="mb-3 mt-3">
            <label for="order-c-ln" class="form-label">Name:</label>
            <input type="text" class="form-control" id="order-c-ln" name="order-c-ln" placeholder="Mustermann" value="<?php echo $uS->getUserSurname() ?>" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-fn" class="form-label">Vorname:</label>
            <input type="text" class="form-control" id="order-c-fn" name="order-c-fn" placeholder="Max" value="<?php echo $uS->getUserForename() ?>" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-e" class="form-label">E-Mail:</label>
            <input type="email" class="form-control" id="order-c-e" name="order-c-e" placeholder="MaxMustermann@muster.de" value="<?php echo $uS->getUserMail() ?>" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-a" class="form-label">Adresse:</label>
            <input type="text" class="form-control" id="order-c-a" name="order-c-a" placeholder="PLZ Ort, Strasse Haus-nr." value="<?php echo $uS->getUserAddress() ?>" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="order-c-c" class="form-label">Telefonnummer:</label>
            <input type="text" class="form-control" id="order-c-c" name="order-c-c" placeholder="+49..." value="<?php echo $uS->getUserContact() ?>" required>

        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-success px-5" id="order-access" name="order-customer-data" type="button" data-toggle="modal" data-target="#saveUserDaten">jetzt bestellen</button>
            <a class="btn btn-secondary ml-1" id="order-cancel" onclick="" href="<?php $dS->getglobalpath() ?>/projekt1/ordering.php">abbrechen</a>
        </div>
    </form>
</div>
    <!-- Modal -->
    <div class="modal fade" id="saveUserDaten" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Die eingegebenen Daten für zukünftige Bestellungen speichern?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
<!--                <div class="modal-body">-->
<!--                    ...-->
<!--                </div>-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Nein</button>
                    <button type="button" class="btn btn-primary">Ja</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php
require_once "../views/footer.view.php";
?>