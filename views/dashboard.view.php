<body>
<!--Quelle: https://getbootstrap.com/docs/4.3/components/carousel/-->

<!--<div id="logocenter">-->
<!--    <img class="center" src="/assets/images/top_background.png" alt="Logo" id="sitelogo">-->
<!--</div>-->

<div class="container">
    <h1 class="fw-light text-center text-lg-start mt-4 mb-0"> Unsere Kategorien</h1>
    <hr class="mt-2 mb-5">

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="cards-wrapper">
                    <div class="card">
                        <img src="<?php echo $globalpath ?>/assets/images/Bild1.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Vorspeisen</h5>
                            <p class="card-text">lorem ipsum</p>
                            <a href="#" class="btn btn-primary">Alle anzeigen
                            </a>
                        </div>
                    </div>
                    <div class="card d-none d-md-block">
                        <img src="<?php echo $globalpath ?>/assets/images/Bild2.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Hauptspeisen</h5>
                            <p class="card-text">lorem ipsum</p>
                            <a href="#" class="btn btn-primary">Alle anzeigen</a>
                        </div>
                    </div>
                    <div class="card d-none d-md-block">
                        <img src="<?php echo $globalpath ?>/assets/images/Bild3.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Dessert</h5>
                            <p class="card-text">lorem ipsum</p>
                            <a href="#" class="btn btn-primary">Alle anzeigen</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="cards-wrapper">
                    <div class="card">
                        <img src="<?php echo $globalpath ?>/assets/images/Bild4.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Vegane Gerichte</h5>
                            <p class="card-text">lorem ipsum</p>
                            <a href="#" class="btn btn-primary">Alle anzeigen</a>
                        </div>
                    </div>
                    <div class="card d-none d-md-block">
                        <img src="<?php echo $globalpath ?>/assets/images/Bild5.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Laktose- und Glutenfrei</h5>
                            <p class="card-text">lorem ipsum</p>
                            <a href="#" class="btn btn-primary">Alle anzeigen</a>
                        </div>
                    </div>
                    <div class="card d-none d-md-block">
                        <img src="<?php echo $globalpath ?>/assets/images/Bild2.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">lorem ipsum</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
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

    <h1 class="fw-light text-center text-lg-start mt-4 mb-0"> Beliebte Speisen</h1>

    <hr class="mt-2 mb-2">
        <div class="container">
            <div class="row ">
                <?php $dishS->showDashboardDishes(); ?>
            </div>
        </div>
    </form>

</div>
<!--<div class="suchergebnisse">-->
<!---->
<!--    <div class='item' id='card_1'>-->
<!--        <img src="--><?php //echo $globalpath ?><!--/assets/images/spaghetti.jpg" alt="Spaghetti">-->
<!--        <div class='card-body'>-->
<!--            <div class="rezeptTitel">-->
<!--                <h5 class="card-title">Spaghetti mit Sauce</h5>-->
<!--                <button class="btn btn-gold" type="submit" id="favorite_1" name="favorite_1"-->
<!--                        style="float: right; width: max-content; height: max-content; margin: 0; padding: 0">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"-->
<!--                         class="bi bi-star-fill" viewBox="0 0 16 16">-->
<!--                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>-->
<!--                    </svg>-->
<!--                </button>-->
<!--                <button class="btn btn-gold" type="submit" id="favorite_1" name="favorite_1"-->
<!--                        style="float: right; width: max-content; height: max-content; margin: 0; padding: 0">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"-->
<!--                         class="bi bi-basket2-fill" viewBox="0 0 16 16">-->
<!--                        <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z"/>-->
<!--                    </svg>-->
<!--                </button>-->
<!--            </div>-->
<!--            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the-->
<!--                card's content.</p>-->
<!--            <a href="#" class="btn btn-primary">Go somewhere</a>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!---->
<!--    <div class="item">-->
<!--        <img src="--><?php //echo $globalpath ?><!--/assets/images/spaghetti.jpg" alt="Spaghetti">-->
<!--        <div class="flexContainer">-->
<!--            <h1 class="rezeptTitel">Spaghetti mit Sauce</h1>-->
<!--            <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>-->
<!--        </div>-->
<!--        <p class="itemData">Kalorien: 200kcal</p>-->
<!--    </div>-->
<!---->
<!--    <div class="item">-->
<!--        <img src="--><?php //echo $globalpath ?><!--/assets/images/pommes.jpg" alt="Spaghetti">-->
<!--        <div class="flexContainer">-->
<!--            <h1 class="rezeptTitel">Pommes mit Ketchup</h1>-->
<!--            <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>-->
<!--        </div>-->
<!--        <p class="itemData">Kalorien: 200kcal</p>-->
<!--    </div>-->
<!---->
<!--    <div class="item">-->
<!--        <img src="--><?php //echo $globalpath ?><!--/assets/images/hamburger.jpg" alt="Spaghetti">-->
<!--        <div class="lexContainer">-->
<!--            <h1 class="rezeptTitel">Hamburger</h1>-->
<!--            <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>-->
<!--        </div>-->
<!--        <p class="itemData">Kalorien: 200kcal</p>-->
<!--    </div>-->
<!---->
<!--    <div class="item">-->
<!--        <img src="--><?php //echo $globalpath ?><!--/assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--        <div class="flexContainer">-->
<!--            <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--            <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>-->
<!--        </div>-->
<!--        <p class="itemData">Kalorien: 200kcal</p>-->
<!--    </div>-->
<!---->
<!--    <div class="item">-->
<!--        <img src="--><?php //echo $globalpath ?><!--/assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--        <div class="flexContainer">-->
<!--            <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--            <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>-->
<!--        </div>-->
<!--        <p class="itemData">Kalorien: 200kcal</p>-->
<!--    </div>-->
<!---->
<!--    <div class="item">-->
<!--        <img src="--><?php //echo $globalpath ?><!--/assets/images/chickenbreast.jpg" alt="Spaghetti">-->
<!--        <div class="flexContainer">-->
<!--            <h1 class="rezeptTitel">Hähnchenbrust</h1>-->
<!--            <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>-->
<!--        </div>-->
<!--        <p class="itemData">Kalorien: 200kcal</p>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->
<!--<hr class="mt-10 mb-5">-->
<!--</div>-->

<!---->
<!--    <hr class="mt-2 mb-5">-->
<!---->
<!---->
<!--    <section id="eingabeformular-container">-->
<!---->
<!--        <h3>Melden Sie sich zu unserem Newsletter an!</h3>-->
<!---->
<!--        <div class="eingabeformular-zeile">-->
<!--            <div class="newsletter-bereich">-->
<!--                <label for="betrag">Ihre E-Mail Adresse</label>-->
<!--                <input type="text" id="newsletter" name="newsl" form="eingabeformular" placeholder="z.B. max@web.de"-->
<!--                       size="20"-->
<!--                       step="0.01" title="Für den Newsletter anmelden">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="eingabeformular-zeile">-->
<!--            <button class="standard" type="submit" form="eingabeformular">Anmelden</button>-->
<!--        </div>-->
<!--    </section>-->
<!---->
<!---->


</body>