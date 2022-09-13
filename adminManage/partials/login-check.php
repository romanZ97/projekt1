<?php 

    //Man kann nicht zur Admin Panel zugreifen ohne sich vorher anzumelden
    if(!isset($_SESSION['user'])) //wenn die Benutzersitzung nicht eingestellt ist
    {
        //der benutzer ist nicht eigeloggt
        //der muss sich erst anmelden
        $_SESSION['no-login-message'] = "<div class='error text-center'>Bitte melden sie sich an, um die Webseite zu verwalten</div>";
        //login-seite 
        header('location:'.URLRACINE.'adminManage/login.php');
    }

?>