<body>
<div class="container">
    <h1 class="fw-light text-left text-lg-start mt-4 mb-2" style="padding-left: 20px">Speisen</h1>
    <!--<div class="container" style="background: #1D3461">-->
    <!--    <div class="row justify-center">-->
    <div class="col-12">
        <!--            <header>-->
        <!--                <h1>Speisen</h1>-->
        <!---->
        <!--            </header>-->
        <div class="input-group mb-3">
            <input id="userinput" type="text" class="form-control" placeholder="Suche nach einer Speise.."
                   aria-label="Add an item" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-info" id="enter" type="button">Hinzufügen</button>
            </div>
        </div>

    </div>
    <div class="col-12">
        <ul class="list list-inline">
            <?php $dS->showPositions() ?>
<!--            <form id="ordering-position---><?php //echo $position["id"] ?><!---form" action="--><?php //echo $globalpath ?><!--/includes/oder_actions.inc.php" method="post" >-->
<!--            <li class="list-group-item d-flex justify-content-between align-items-center">-->
<!--                    <span>Salat mit Joghurtsauce</span>-->
<!--                <input name="order_position-view" value="" hidden>-->
<!--                <div class="counter" style="float: right">-->
<!--                    <span class="down" onClick='decreaseCount(event, this)'>-</span>-->
<!--                    <input name="position_qty" type="text" value="1">-->
<!--                    <span class="up" onClick='increaseCount(event, this)'>+</span>-->
<!--                </div>-->
<!--            </li>-->
<!--            </form>-->
<!--            <li class="list-group-item">Salat mit Balsamico</li>-->
<!--            <li class="list-group-item">Linsenuppe</li>-->
<!--            <li class="list-group-item">Tomatensuppe</li>-->
<!--            <li class="list-group-item">Aperitif</li>-->
        </ul>
    </div>
</div>
</div>


</body>
