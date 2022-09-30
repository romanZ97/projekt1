<?php   

//Verbindung zur DB
require_once(__DIR__ . '/config/constants.php');

//  die ID des Administrators holen, der aus der Datenbank gelöscht werden soll
$id = $_GET['id'];

// eine SQL-Abfrage erstellen, um den Administrator zu löschen
$sql = "DELETE FROM admin WHERE id=$id";

//die Abfrage ausführen
$res = mysqli_query($conn, $sql);

// Überprüfen, ob die Abfrage erfolgreich ausgeführt wurde oder nicht
switch ($res) {
    case true:
        //Abfrage wurde erfolgreich ausgeführt und der Admin wurde gelöscht
        //Erstellen der Sitzungsvariable, um die Nachricht anzuzeigen
        $_SESSION['delete'] = "<div class='success'>Der Admin wurde gelöscht</div>";
        //Weiterleitung zur Seite "index.php"
        header('location:' . URLRACINE . 'adminManage/index.php');

        break;
    default:


        $_SESSION['delete'] = "<div class='error'>Admin konnte nicht gelöscht werden. Versuchen Sie es später noch einmal</div>";
        header('location:' . URLRACINE . 'adminManage/index.php');
        break;
}

?>
