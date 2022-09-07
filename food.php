<!doctype html>
<html lang="de">
<title>GastroWeb</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
session_start();
echo $_SESSION['order_nr'];
$globalpath = "http://localhost/projekt1";
require "views/header.view.php";
?>

<body>

<?php
$foodS->showActiveFood();
require "views/footer.view.php";
?>

<!--<h2 class="fw-light text-center text-lg-start mt-4 mb-0">Vorpeisen</h2>-->
<!--<hr class="mt-2 mb-5">-->
<!---->
<!--<div class="container">-->
<!---->
<!--    <div class="suchergebnisse">-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/spaghetti.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Spaghetti mit Sauce</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/pommes.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Pommes mit Ketchup</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/hamburger.jpg" alt="Spaghetti">-->
<!--            <div class="lexContainer">-->
<!--                <h1 class="rezeptTitel">Hamburger</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!---->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<br>-->
<!--<br>-->
<!---->
<!---->
<!--<h2 class="fw-light text-center text-lg-start mt-4 mb-0">Hauptspeisen</h2>-->
<!--<hr class="mt-2 mb-5">-->
<!---->
<!---->
<!--<div class="container">-->
<!---->
<!--    <div class="suchergebnisse">-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/spaghetti.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Spaghetti mit Sauce</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/pommes.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Pommes mit Ketchup</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/hamburger.jpg" alt="Spaghetti">-->
<!--            <div class="lexContainer">-->
<!--                <h1 class="rezeptTitel">Hamburger</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!---->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<br>-->
<!--<br>-->
<!---->
<!--<h2 class="fw-light text-center text-lg-start mt-4 mb-0">Desserts</h2>-->
<!--<hr class="mt-2 mb-5">-->
<!---->
<!--<div class="container">-->
<!---->
<!--    <div class="suchergebnisse">-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/spaghetti.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Spaghetti mit Sauce</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/pommes.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Pommes mit Ketchup</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/hamburger.jpg" alt="Spaghetti">-->
<!--            <div class="lexContainer">-->
<!--                <h1 class="rezeptTitel">Hamburger</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!--        <div class="item">-->
<!--            <img src="assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--            <div class="flexContainer">-->
<!--                <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--                <a class="viewButton" href="#">Speise anzeigen</a>-->
<!--            </div>-->
<!--            <p class="itemData">Kalorien: 200kcal</p>-->
<!--        </div>-->
<!---->
<!---->
<!--    </div>-->
<!--</div>-->

</body>

</html>
