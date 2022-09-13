<?php 

require_once(__DIR__ . '/partials/header.php');
?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->


    <div class="main-content">
    <div class="wrapper">
        <h1>Admin hinzufügen</h1>

        <br />   <br />   <br />

    <!--Nachricht anzeigen, wenn alles richtig gelaufen ist, oder wenn ein Fehler aufgetreten ist. -->
    <?php 
            if(isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']); 
            }
        ?>

    <!-- Formular startet hier  -->
    <form action="" method="POST">

        <table>
        <div class="container">
            <div class="row">

                <!-- Volltändiger Name hinzufügen  -->
                <div class="col-sm-4">
                    <label>Name</label>
                    <div class="form-group">
                        <input type="text" name="full_name" >
                    </div>

                    <!-- Benutzername hinzufügfen  -->
                    <label>Benutzername</label>
                    <div class="form-group">
                        <input type="text" name="username">
                    </div>

                    <!-- email hinzufügfen  -->
                    <label>email</label>
                    <div class="form-group">
                        <input type="email" name="email">
                    </div>

                    <!-- Passwort hinzufügen  -->
                    <label>Passwort</label>
                    <div class="form-group pass_show">
                        <input type="password"  name="password" class="form-control" placeholder="New Password">
                    </div>

                </div>
            </div>


            <div>
                <button type="submit" name="submit" id="brrr">Admin hinzufügen</button>
            </div>

            </table>
    </form>
    <!-- das Formular endet hier  -->

</div>
</div>

<?php
require_once(__DIR__ . '/includes/adminadd_includes.php'); //--> funktion admin hinzufügen (Logik)
require_once(__DIR__ . '/partials/footer.php'); //--> footer hinzufügen
?>


