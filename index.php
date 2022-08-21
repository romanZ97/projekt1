<?php session_start(); ?>

    <main>
        <div class="wrapper-main">
            <section class="section-default">
                <?php
                require "includes/signin.inc.php";
                checkLogin();
                ?>
            </section>
        </div>
    </main>

<?php
require "views/header.view.php";
require "views/dashboard.view.php";
require "views/footer.view.php";