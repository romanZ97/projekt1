<?php
$globalpath = "http://localhost/projekt1";
if(isset($_POST['signout'])){
    session_start();
    session_unset();
    session_destroy();
    // Remove cookie variables
    $days = 30;
    setcookie ("remember","", time() - ($days * 24 * 60 * 60 * 1000));

    header("Location: $globalpath/index.php");
    exit();
}