<?php include('../admin/config/constants.php'); //Verbindung mit der DB

include('login-check.php');

?>



<!doctype html>
<html lang="de">

<head>
    <title>GastroWeb Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../admin/assets/css/admin.css">
    <link rel="stylesheet" href="../admin/assets/css/admin2.css">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="categoryManage.php">Kategorien</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="dishManage.php">Gerichte</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="orderManage.php">Bestellungen</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="reservationManage.php">Tische</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="logout.php">Abmelden</a></li>
        </ul>
    </div>
    </div>
</nav>

