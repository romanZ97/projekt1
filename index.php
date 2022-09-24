<!doctype html>
<html lang="de">
<title>GastroWeb</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php
require_once "views/header.view.php";
echo $_SESSION['order_nr'];
//unset($_SESSION['order_nr']);
?>
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo URLRACINE; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Gerichte Suchen" required>
            <input type="submit" name="submit" value="Suchen" class="btn btn-primary">
        </form>
    </div>
</section>
<?php
require "views/dashboard.view.php";
require "views/footer.view.php";
?>
