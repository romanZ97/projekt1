
<title>Bestellvorgang erfolgreich</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php require "header.view.php"; ?>

<div class="container mt-3">
    <h2>Ihre Bestellung wurde erfolgreich angenommen</h2>
    <span class="bold-text" >Informationen:</span>
    <ul style="margin-top: 5px">
        <li>Ihre Bestellung wird innerhalb <span class="bold-text">50 Minuten</span> geliefert.</li>
        <li><span class="bold-text">Zahlen Sie bitte bar</span> an unserem Lieferanten bei der Annahme der Bestellung</li>
        <li>Wenn Sie ihre Bestellung stornieren wollen, kontaktieren Sie uns <span class="bold-text">innerhalb nächsten 10 Minuten</span>, nach dieser Zeit muss die Bestellung vom Empfänger bezahlt werden.</li>
    </ul>
    <hr>
    <p><span class="bold-text" >Ihre Bestellungsnummer : </span><span><?php echo $dS->getOrderNr()?></span></p>
    <hr>
    <p><span class="bold-text" >Bestellzeit : </span><span><?php echo $dS->getOrderDate()?></span></p>
    <hr>
    <span class="bold-text" >Ihre Bestellpositionen:</span>
    <div class="table-responsive">
    <table class="table" style="margin-top: 5px">
        <thead class="thead-dark">
        <tr>
            <th style="width: 12px">Nr.</th>
            <th>Bezeichnung</th>
            <th style="width: 120px; text-align: center">Menge</th>
            <th style="width: 120px; text-align: center">Portion</th>
            <th style="width: 120px; text-align: center">Preis</th>
        </tr>
        </thead>
        <tbody style="background-color: rgba(255,255,255,0.53)">
        <?php $dS->showDelivery(); ?>
        </tbody>
        <tfoot style="background-color: rgba(255,255,255,0.74)">
        <tr>
            <th>Summe</th>
            <th> </th>
            <th> </th>
            <th> </th>
            <th class="list-price"><?php echo $dS->getTotalPrice()?> €</th>
        </tr>
        </tfoot>
    </table>
        <a class="btn btn-secondary ml-1" id="order-cancel" onclick=""
           href="<?php $dS->getglobalpath() ?>/projekt1/index.php">zurück</a>
</div>
</div>

</div>
<?php
unset($_SESSION['order_nr']);
require "footer.view.php"; ?>