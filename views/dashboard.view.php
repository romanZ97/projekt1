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

    <hr class="mt-2 mb-5">


    <div class="container">

        <div class="suchergebnisse">

            <div class="item">
                <img src="<?php echo $globalpath ?>/assets/images/spaghetti.jpg" alt="Spaghetti">
                <div class="flexContainer">
                    <h1 class="rezeptTitel">Spaghetti mit Sauce</h1>
                    <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>
                </div>
                <p class="itemData">Kalorien: 200kcal</p>
            </div>

            <div class="item">
                <img src="<?php echo $globalpath ?>/assets/images/pommes.jpg" alt="Spaghetti">
                <div class="flexContainer">
                    <h1 class="rezeptTitel">Pommes mit Ketchup</h1>
                    <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>
                </div>
                <p class="itemData">Kalorien: 200kcal</p>
            </div>

            <div class="item">
                <img src="<?php echo $globalpath ?>/assets/images/hamburger.jpg" alt="Spaghetti">
                <div class="lexContainer">
                    <h1 class="rezeptTitel">Hamburger</h1>
                    <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>
                </div>
                <p class="itemData">Kalorien: 200kcal</p>
            </div>

            <div class="item">
                <img src="<?php echo $globalpath ?>/assets/images/chickenbreast.jpg" alt="Spaghetti">
                <div class="flexContainer">
                    <h1 class="rezeptTitel">Hähnchenbrust</h1>
                    <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>
                </div>
                <p class="itemData">Kalorien: 200kcal</p>
            </div>

            <div class="item">
                <img src="<?php echo $globalpath ?>/assets/images/chickenbreast.jpg" alt="Spaghetti">
                <div class="flexContainer">
                    <h1 class="rezeptTitel">Hähnchenbrust</h1>
                    <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>
                </div>
                <p class="itemData">Kalorien: 200kcal</p>
            </div>

            <div class="item">
                <img src="<?php echo $globalpath ?>/assets/images/chickenbreast.jpg" alt="Spaghetti">
                <div class="flexContainer">
                    <h1 class="rezeptTitel">Hähnchenbrust</h1>
                    <button type="button" class="btn btn-dark" href="#">Speise anzeigen</button>
                </div>
                <p class="itemData">Kalorien: 200kcal</p>
            </div>


        </div>
    </div>


    <hr class="mt-2 mb-5">


    <section id="eingabeformular-container">

        <h3>Melden Sie sich zu unserem Newsletter an!</h3>

        <div class="eingabeformular-zeile">
            <div class="newsletter-bereich">
                <label for="betrag">Ihre E-Mail Adresse</label>
                <input type="text" id="newsletter" name="newsl" form="eingabeformular" placeholder="z.B. max@web.de"
                       size="20"
                       step="0.01" title="Für den Newsletter anmelden">
            </div>
        </div>

        <div class="eingabeformular-zeile">
            <button class="standard" type="submit" form="eingabeformular">Anmelden</button>
        </div>
    </section>


    <hr class="mt-2 mb-5">
</div>
</div>
</body>