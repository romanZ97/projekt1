<div class="container">
<h1 class="ueberschrift fw-light text-center text-lg-start mt-4 mb-0"> Unsere Kategorien</h1>
<hr class="mt-2 mb-5">

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php $foodS->showDashboardCategories(); ?>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
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

    <hr class="mt-2 mb-2">
    <div class="container">
        <div class="row ">
            <?php $foodS->showDashboardFood(); ?>
        </div>
    </div>
</div>