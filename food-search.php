<!doctype html>
<html lang="de">
<title>Bestellen</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
require_once "views/header.view.php";
?>
<!-- Produkte suchen start hier-->
<section class="product-search text-center">
    <div class="container">
        <?php

        // das Suchwort nehmen
        $search = mysqli_real_escape_string($conn, $_POST['search']); //diese Funktion erlaubt keine SQL-Injection

        ?>

        <!-- Hier wird der Titel angezeigt mit dem Namen des Produkts-->

        <h2 class="text-green">Ergebnis Ihrer Suche für <a href="#" class="text-green">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- Produkte suchen endet hier-->



<!-- Das Ergenis der Suche fängt hier an -->
<section class="product-gallery">
    <div class="container">
        <h2 class="text-center">Gefundene Produkte</h2>

        <?php

        //SQL-Abfrage zum Abrufen der Produkte basierend auf dem Suchschlüsselwort
        $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        //die Abfrage ausführen
        $res = mysqli_query($conn, $sql);

        //Anzahl der Zeilen
        $count = mysqli_num_rows($res);

        //Prüfen ob Daten in der Datenbank vorhanden sind.
        if($count>0)
        {
            //Es gibt Produkte in der DB für diese Suche.
            while($row=mysqli_fetch_assoc($res))
            {
                //Nehme die Infos
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                $food_portion = $row['food_portion'];
                $food_portion_unit = $row['food_portion_unit'];
                ?>

        <div class="col-md-3" style="margin-bottom: 1em;">
            <div class="card-sl h-100">
                <div class="card-image">

                    <?php
                        // Ist ein Bild vorhanden ?
                        if($image_name=="")
                        {
                            //Kein Bild vorhanden
                            echo "<div class='error'>Kein Bild vorhanden</div>";
                        }
                        else
                        {
                            // Bild vorhanden
                            ?>
                            <img src="<?php echo URLRACINE; ?>assets/images/<?php echo $image_name; ?>" width="300px" alt="" class="img-responsive img-curve">
                            <?php

                        }  echo '
                        <a class="card-action" id="order_position_' . $id. '" type="button" 
                        onclick="addOrderPosition(\'' . $id . '\')"title="Bestellen">
                        <input name="order-position-add" value="' . $id . '" hidden/>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                 class="bi bi-basket2-fill" viewBox="0 0 16 16">
                                <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z"/>
                            </svg>
                        </a>
                        
                        <div id="food-' . $id . '" class="card-details">
                            <div id="title-' . $id . '" class="card-heading h-100">
                                ' . $title . '
                            </div>
                            <div id="portion-' . $id. '" class="card-text-left">
                                ' . $food_portion . ' ' . $food_portion_unit["food_portion_unit"] . '
                            </div>
                            <div id="price-' . $id . '" class="card-text-right">
                                ' . $price . '€
                            </div>
                        </div>
                        <a class="card-button" role="button" type="button" tabindex="1" onclick="showFoodModal(' . $id . ')"> weitere Details</a>
                    </div>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="food-modal-' . $id . '" tabindex="-1" role="dialog" aria-labelledby="modal-' . $id . '" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-' . $id . '">' . $title . '</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';

                    if($description) {
                        echo '
                            <div class="modal-body food-details" >
                                ' . $description . '
                             </div>';
                    }
                    echo '
                            <div class="modal-footer">
                                <div id="text-left">
                                   Eine Portion: ' . $food_portion . ' ' . $food_portion_unit . '
                                </div>
                                <div id="text-right">
                                    Preis: ' . $price . '€
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
                        ?>



                <?php
            }
        }
        else
        {
            //Kein Produkt verfügbar
            echo "<div class='error'>Kein Produkt verfügbar</div>";
        }

        ?>



        <div class="clearfix"></div>



    </div>

</section>
<!-- das Ergebnis der Suche endet hier -->


<?php
require "views/footer.view.php";
?>
