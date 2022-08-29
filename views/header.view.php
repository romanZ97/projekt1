<!doctype html>
<html lang="de">

<head>
    <title>GastroWeb</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $globalpath ?>/assets/css/style.css">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2">
        <div class="container-fluid justify-content-between p-0">
            <!-- Left elements -->
            <div class="d-flex p-0 ml-0">
                <a class="navbar-brand d-flex p-0 m-0" href="#" style="margin: 10px">
                    <img src="<?php echo $globalpath ?>/assets/images/title.png" height="30" alt="">
                </a>
                <ul class="navbar-nav align-items-center p-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Kategorien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Speisen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Bestellen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Tischreservieren</a>
                    </li>
                    <li class="nav-item ml-1">
                        <a class="nav-link align-items-center p-0" href="#" style="margin: 10px">
                            <?php require __DIR__ . "/../assets/icons/info_icon.php";?>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav flex-row">
                <?php if (!isset($_SESSION["user_id"])): ?>
                    <li class="nav-item">
                        <a class="nav-link " style="margin: 10px">
                            <?php require __DIR__ . "/../assets/icons/order_icon.php";?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                           data-display="static" aria-haspopup="true" aria-expanded="false" style="margin: 10px">
                            <?php require __DIR__ . "/../assets/icons/user_icon.php";?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-text-right">
                            <form id="signout-form" action="<?php echo $globalpath ?>/views/signin.view.php"
                                  method="post" style="margin: 0">
                                <input name="signout" value="out" hidden>
                                <a class="dropdown-item" onclick="document.getElementById('signout-form').submit();">
                                    <?php require __DIR__ . "/../assets/icons/exit_icon.php";?>
                                    Anmelden</a>
                            </form>
                        </div>
                    </li>
                <?php else: ?>
                    <!-- User Favorites List - Star -->
                    <li class="nav-item"  style="">
                        <a class="nav-link dropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" style="margin: 10px">
                            <?php require __DIR__ . "/../assets/icons/favorite_icon.php";?>
                        </a>
                        <form id="user-favorite-form" name="user-favorite-form" action="<?php echo $globalpath ?>/includes/user_favorites.inc.php" method="post">
                            <div class="dropdown-menu dropdown-menu-xl-right" style=" min-width: 100px !important;">
                                <?php require "user_favorites_dropdown.view.php"?>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " style="margin: 10px">
                            <?php require __DIR__ . "/../assets/icons/order_icon.php";?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown" role="button" data-toggle="dropdown"
                           data-display="static" aria-haspopup="true" aria-expanded="false" style="margin: 10px">
                            <?php require __DIR__ . "/../assets/icons/user_icon.php";?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-text-right">
                            <a class="dropdown-item" href="#">
                                <?php require __DIR__ . "/../assets/icons/favorite_icon.php";?>
                                Favoriten</a>
                            <a class="dropdown-item" href="#">
                                <?php require __DIR__ . "/../assets/icons/profile_icon.php";?>
                                Konto</a>
                            <div class="dropdown-divider"></div>
                            <form id="signout-form" action="<?php echo $globalpath ?>/includes/signout.inc.php"
                                  method="post" style="margin: 0">
                                <input name="signout" value="out" hidden>
                                <a class="dropdown-item" onclick="document.getElementById('signout-form').submit();">
                                    <?php require __DIR__ . "/../assets/icons/exit_icon.php";?>
                                    abmelden</a>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</head>