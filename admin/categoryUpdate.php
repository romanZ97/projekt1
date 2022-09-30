<?php

require_once (__DIR__ . '/partials/header.php');
?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->

    <div class="main-content">
        <div class="wrapper">
            <h1>Kategorie aktualisieren</h1>

            <br><br>


            <?php
            require_once (__DIR__ . '/includes/categoryUpdate_GETID_includes.php');
            ?>   <!-- Funktion getid -->

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Name der Kategorie: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Aktuelles Bild: </td>
                        <td>
                            <?php
                            if($current_image != "")
                            {
                                //Bild anzeigen
                                ?>
                                <img alt="aktuelles Bild" src="<?php echo URLRACINE; ?>assets/images/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Fehlermeldung anzeigen
                                echo "<div class='error'>Kein Bild hinzugefügt</div>";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Neues Bild: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Hervorheben? </td>
                        <td>
                            <input <?php if($featured=="Ja"){echo "checked";} ?> type="radio" name="featured" value="Ja"> Ja

                            <input <?php if($featured=="Nein"){echo "checked";} ?> type="radio" name="featured" value="Nein"> Nein
                        </td>
                    </tr>

                    <tr>
                        <td>Aktivieren? </td>
                        <td>
                            <input <?php if($active=="Ja"){echo "checked";} ?> type="radio" name="active" value="Ja"> Ja

                            <input <?php if($active=="Nein"){echo "checked";} ?> type="radio" name="active" value="Nein"> Nein
                        </td>
                    </tr>

                    <tr>
                        <td>Icon: </td>
                        <td>
                            <b><?php echo $icon_name; ?></b>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Kategorie aktualisieren" class="button1">
                        </td>
                    </tr>

                </table>

            </form>

            <?php
            require_once (__DIR__ . '/includes/categoryUpdate_UPDATE_includes.php');
            ?>   <!-- Funktion UPDATE KATEGORY -->

        </div>
    </div>

<?php include('partials/footer.php'); ?>