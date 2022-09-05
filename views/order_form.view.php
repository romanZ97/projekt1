<!--<head>-->
<!--    <title>Bestellformular</title>-->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
<!---->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
<!--          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
<!--    <link rel="stylesheet" href="assets/css/style.css">-->
<!---->
<!---->
<!--</head>-->


<body>
<!-- Bestellformular -->
<div class="container mt-3">
    <h3>Bestellformular</h3>
    <p>Füllen Sie bitte alle Felder aus</p>

    <form action="/action_page.php" class=".needs-validated">
        <div class="mb-3 mt-3">
            <label for="Bform" class="form-label">Name:</label>
            <input type="name" class="form-control" id="Bform" placeholder="Mustermann" name="Bform" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="Bform" class="form-label">Vorname:</label>
            <input type="text" class="form-control" id="Bform" placeholder="Max" name="pswd" required>

        </div>
        <div class="mb-3 mt-3">
            <label for="Bform" class="form-label">E-Mail:</label>
            <input type="email" class="form-control" id="Bform" placeholder="MaxMustermann@muster.de" name="Bform"
                   required>

        </div>
        <div class="mb-3 mt-3">
            <label for="Bform" class="form-label">Adresse:</label>
            <input type="text" class="form-control" id="Bform" placeholder="Straße, Hausnummer, Ort" name="Bform"
                   required>

        </div>
        <div class="mb-3 mt-3">
            <label for="Bform" class="form-label">Telefonnummer:</label>
            <input type="text" class="form-control" id="Bform" placeholder="123456.." name="Bform" required>

        </div>

        <!-- Buttons -->
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="cancel" class="btn btn-primary">Cancel</button>
        <a href="index.html">Home</a>

    </form>
</div>

</body>