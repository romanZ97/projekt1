<?php
require __DIR__ . "/../src/FoodService.php";
require __DIR__ . "/../src/DeliveryService.php";
$dS  = new DeliveryService();
$foodS = new FoodService();
$foodS->loadDashboardData();
$foodS->loadActiveData();
?>

<script src="<?php echo $globalpath ?>/includes/js/user_action.js"></script>

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $globalpath ?>/assets/css/style.css">

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
        <div class="container-fluid ">
            <ul class="navbar-nav align-items-center p-0">
                <a class="navbar-brand p-0 m-0" href="<?php echo $globalpath ?>/index.php" style="margin: 10px">
                    <img src="<?php echo $globalpath ?>/assets/images/logo1_xs.png" height="30" alt="">
                </a>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Kategorien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Speisen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $globalpath ?>/ordering.php">Bestellen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $globalpath ?>/reservation.php">Tischreservieren</a>
                </li>
                <li class="nav-item ml-1">
                    <a class="nav-link align-items-center p-0" href="#" style="margin: 10px">
                        <?php require __DIR__ . "/../assets/icons/info_icon.php"; ?>
                    </a>
                </li>
            </ul>
            <!--            <a class="navbar-brand  p-0 m-0" href="-->
            <?php //echo $globalpath ?><!--/index.php" style="margin: 10px">-->
            <!--                <img src="-->
            <?php //echo $globalpath ?><!--/assets/images/logo1_s.png" height="30" alt="">-->
            <!--            </a>-->
            <ul class="navbar-nav flex-row">
                <?php if (!isset($_SESSION["user_id"])): ?>
                    <li class="nav-item">
                        <a class="nav-link dropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" style="margin: 10px" onclick="checkOrders()">
                            <?php require __DIR__ . "/../assets/icons/order_icon.php"; ?>
                        </a>
                        <div id="orders-nav-dropdown" class="dropdown-menu dropdown-menu-xl-right"
                             style=" min-width: 300px">
                            <?php require "user_order_dropdown.view.php" ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" style="margin: 10px">
                            <?php require __DIR__ . "/../assets/icons/user_icon.php"; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-text-right">
                            <form id="signout-form" action="<?php echo $globalpath ?>/signin.php"
                                  method="post" style="margin: 0">
                                <input name="signout" value="out" hidden>
                                <a class="dropdown-item" onclick="document.getElementById('signout-form').submit();">
                                    <?php require __DIR__ . "/../assets/icons/exit_icon.php"; ?>
                                    Anmelden</a>
                            </form>
                        </div>
                    </li>
                <?php else: ?>
                    <!-- User Favorites List - Star -->
                    <li class="nav-item" style="">
                        <a class="nav-link dropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" style="margin: 10px">
                            <?php require __DIR__ . "/../assets/icons/favorite_icon.php"; ?>
                        </a>
                        <form id="user-favorite-nav-form"
                              action="<?php echo $globalpath ?>/includes/user_actions.inc.php" method="post">
                            <div class="dropdown-menu dropdown-menu-xl-right" style=" min-width: 300px">
                                <?php require "user_favorites_dropdown.view.php" ?>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" style="margin: 10px" onclick="checkOrders()">
                            <?php require __DIR__ . "/../assets/icons/order_icon.php"; ?>
                        </a>
                        <div id="orders-nav-dropdown" class="dropdown-menu dropdown-menu-xl-right"
                             style=" min-width: 300px">
                            <?php require "user_order_dropdown.view.php" ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown" role="button" data-toggle="dropdown"
                           data-display="static" aria-haspopup="true" aria-expanded="false" style="margin: 10px">
                            <?php require __DIR__ . "/../assets/icons/user_icon.php"; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-text-right">
                            <a class="dropdown-item" href="#">
                                <?php require __DIR__ . "/../assets/icons/favorite_icon.php"; ?>
                                Favoriten</a>
                            <a class="dropdown-item" href="#">
                                <?php require __DIR__ . "/../assets/icons/profile_icon.php"; ?>
                                Konto</a>
                            <div class="dropdown-divider"></div>
                            <form id="signout-form" action="<?php echo $globalpath ?>/includes/signout.inc.php"
                                  method="post" style="margin: 0">
                                <input name="signout" value="out" hidden>
                                <a class="dropdown-item" onclick="document.getElementById('signout-form').submit();">
                                    <?php require __DIR__ . "/../assets/icons/exit_icon.php"; ?>
                                    abmelden</a>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</head>
