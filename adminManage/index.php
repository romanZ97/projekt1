<?php

require_once (__DIR__ . '/partials/header.php');
?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->


    <!-- Titel-->
    <div class="main-content">
    <div class="wrapper">
    <h1>Administratoren verwalten</h1>

<br />

    <!--Nachricht anzeigen, wenn alles richtig gelaufen ist oder wenn ein Fehler aufgetreten ist. -->
<?php
   if(isset($_SESSION['add']))
   {
       echo $_SESSION['add']; //Nachricht Anzeigen
       unset($_SESSION['add']); //Nachricht geht wieder weg, nachdem die Seite Aktualisiert wird.
   }

   if(isset($_SESSION['delete'])) 
   {
       echo $_SESSION['delete'];
       unset($_SESSION['delete']);
   }
   if(isset($_SESSION['update']))
   {
       echo $_SESSION['update'];
       unset($_SESSION['update']);
   }
   if(isset($_SESSION['user-not-found']))
   {
       echo $_SESSION['user-not-found'];
       unset($_SESSION['user-not-found']);
   }


?>
    <br /> <br />
    <!-- Button zum Hinzufügen des Administrators -->
            <a href="adminAdd.php" class="button1">Admin hinzufügen</a>


            <!-- Gesamte Liste der Administratoren-->
                <div class="container mt-5">

                    <table class="table table-borderless table-responsive card-1 p-4">
                        <thead>
                        <tr class="border-bottom">
                            <th>
                                <span class="ml-2">Nr.</span>
                            </th>
                            <th>
                                <span class="ml-2">Name</span>
                            </th>
                            <th>
                                <span class="ml-2">Benutzer</span>
                            </th>

                            <th>
                                <span class="ml-2">email</span>
                            </th>
                            <th>
                                <span class="ml-2">Aktionen</span>
                            </th>
                        </tr>
                        </thead>


               <?php

               require_once(__DIR__ . '/includes/adminManage_includes.php');
               ?>   <!-- Funktion um die Daten aller Admin anzuzeigen -->

           </table>


          <!-- Hauptinhalt endet hier -->
<?php
require_once(__DIR__ . '/partials/footer.php'); //footer hinzufügn
?>