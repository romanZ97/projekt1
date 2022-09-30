<!doctype html>
<html lang="de">
<title>GastroWeb</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php
session_start();
$globalpath = "http://localhost:8888/projekt1";
require "../src/UserService.php";
$uS = new UserService($_SESSION['user_id']);

?>
<script src="<?php echo $globalpath ?>/assets/js/user_action.js"></script>
<body>
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $globalpath ?>/assets/css/style.css">

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
        <div class="container-fluid ">
            <ul class="navbar-nav align-items-center p-0">
                <a id="home-link" class="navbar-brand p-0 m-0" href="<?php echo $globalpath ?>/index.php" style="margin: 10px">
                    <img src="<?php echo $globalpath ?>/assets/images/logo1_xs.png" height="30" alt="">
                </a>
                <!--                <li class="nav-item">-->
                <!--                    <a class="nav-link active" aria-current="page" href="#">Kategorien</a>-->
                <!--                </li>-->
                <li class="nav-item">
                    <a id="food-link" class="nav-link active" href="<?php echo $globalpath ?>/food.php">Speisen</a>
                </li>
                <li class="nav-item">
                    <a id="ordering-link" class="nav-link active" type="button" href="<?php echo $globalpath ?>/ordering.php">Bestellen</a>
                </li>
                <li class="nav-item">
                    <a id="reservation-link" class="nav-link active" href="<?php echo $globalpath ?>/reservation.php">Tischreservieren</a>
                </li>
                <li class="nav-item ml-1">
                    <a  id="info-link" class="nav-link align-items-center p-0" href="#" style="margin: 10px">
                        <?php require __DIR__ . "/../assets/icons/info_icon.php"; ?>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</head>
<div class="container container-content">
    <div class="container mt-3">
        <h3>Kontodetails</h3>
        <h5>Füllen Sie bitte alle Felder aus. Hier können Sie ihre Daten einfügen und ändern.</h5>
        <form action="<?php echo $globalpath ?>/includes/user_actions.inc.php" method="post">
            <?php $uS->showUserProfileData(); ?>
            <!-- Buttons -->
            <button type="submit" class="btn btn-success" name="user-profile-submit">Änderungen speichern</button>
            <a class="btn btn-secondary" href="<?php echo $globalpath ?>/index.php">zurück</a>
        </form>
    </div>
<?php require_once("footer.view.php"); ?>