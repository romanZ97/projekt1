<!doctype html>
<html lang="de">
<title>GastroWeb</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
// Zugriff auf Navigationsleiste
require "views/header.view.php";
// Anzeige von aktiven Speisen mit Kategorie Gruppierung
$foodS->showActiveFood();
// zugriff auf Seiten-Footer
require "views/footer.view.php";
?>