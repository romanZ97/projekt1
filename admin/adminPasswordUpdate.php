<?php

require_once(__DIR__ . '/partials/header.php');
?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->

<div class="main-content">
    <div class="wrapper">
        <h1>Passwort aktualisieren</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Aktuelles Passwort: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="aktualles Posswort">
                    </td>
                </tr>

                <tr>
                    <td>Neues Passwort:</td>
                    <td>
                        <input type="password" name="new_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Neues Passwort">
                    </td>
                </tr>

                <tr>
                    <td>Passwort bestätigen: </td>
                    <td>
                        <input type="password" name="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Passwort bestätigen">
                    </td>
                </tr>



                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Passwort ändern" class="button1">
                    </td>
                </tr>

            </table>
<br> <br>
            <p>
                Beacten Sie, dass Ihr neues Passwort mindestens eine Zahl, einen Groß- und Kleinbuchstaben und mindestens 8 oder mehr Zeichen enthalten muss.
            </p>

        </form>



    </div>
</div>

<?php
require_once(__DIR__ . '/includes/adminPasswordUpdate_includes.php'); //Funktion password ändeern
require_once(__DIR__ . '/partials/footer.php'); //footer hinzufügn
?>
