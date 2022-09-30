<?php

require_once(__DIR__ . '/partials/header.php');
?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->

<div class="main-content">

        <div class="wrapper">
            <h1>Admin aktualaisieren</h1>

            <br> <br>

            <?php //SQL Abfrage ID Der Admin holen

            require_once(__DIR__ . '/includes/adminUpdate_GETID_includes.php');

            ?>

            <form action="" method="POST">

                <table>
                    <div class="container">
                        <div class="row">

                            <!-- Volltändiger Name hinzufügen  -->
                            <div class="col-sm-4">
                                <label>Name</label>
                                <div class="form-group">
                                    <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                                </div>

                                <!-- Benutzername hinzufügfen  -->
                                <label>Benutzername</label>
                                <div class="form-group">
                                    <input type="text" name="username" value="<?php echo $username; ?>">
                                </div>

                                <!-- email hinzufügfen  -->
                                <label>email</label>
                                <div class="form-group">
                                    <input type="email" name="email" value="<?php echo $email; ?>">
                                </div>


                                <div class="form-group pass_show">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </div>

                            </div>
                        </div>


                        <div>
                            <button type="submit" name="submit" id="brrr">Admin aktualisieren</button>
                        </div>

            </table>

        </form>

        </div>

</div>


<?php
require_once(__DIR__ . '/includes/adminUpdate_UPDATE_includes.php'); //--> QUERY UPDATE adminUpdate_GETID_includes.php

?>