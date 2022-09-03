<!--<head>-->
<!--    <title>Bootstrap Table Reservation Form Template Design</title>-->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="assets/css/style.css">-->
<!--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>-->
<!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>-->
<!--</head>-->
<body>
<section id="book-a-table" class="book-a-table">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <h2 class="text-primary">Reserviere einen Tisch!</h2>
                <p class="mb-5">Wähle einfach Deine gewünschte Zeit sowie die Anzahl der Personen aus, die kommen werden und Du erfährst sofort, ob ein Tisch frei ist.</p>
            </div>
        </div>

        <form action="" method="post" role="form">
            <div class="form-row">
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Dein Name">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Deine E-Mail-Adresse">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Deine Telefonnummer">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="date" name="date" class="form-control" id="date" placeholder="gewünschtes Datum">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="time" class="form-control" name="time" id="time" placeholder="gewünschte Zeit">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="number" class="form-control" name="people" id="people" placeholder="Anzahl der Personen">
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" placeholder="Möchtest Du eine Nachricht hinterlassen?"></textarea>
            </div>
            <button type="submit" class="btn btn-primary float-right mt-3">Termin reservieren!</button>
        </form>
    </div>
</section>
</body>