<div class="container">
<h1 class="ueberschrift fw-light text-center text-lg-start mt-4 mb-0"> Unsere Kategorien</h1>
<hr class="mt-2 mb-5">

<!-- Kategorien Karussell-->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
<!--        Anzeigen von aktiven Kategorien-->
        <?php $foodS->showDashboardCategories(); ?>

<!--        Pfeil zu nachfolgenden Karussell Elementen-->
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
<!--        Pfeil zu folgenden Karussell Elementen-->
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<hr class="mt-2 mb-5">
</div>

<div class="container mt-5">

    <h1 class="ueberschrift fw-light text-center text-lg-start mt-4 mb-0">Beliebte Speisen</h1>
<!-- Raster mit aktiven, hervorgehobenen Speisen-->
    <hr class="mt-2 mb-2">
    <div class="container">
        <div class="row ">
<!--            Anzeige der aktiven, hervorgehobenen Speisen-->
            <?php $foodS->showDashboardFood(); ?>
        </div>
    </div>
</div>