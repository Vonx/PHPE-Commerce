<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT. DS . "header.php") ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

        <!-- categories here -->
        <?php include(TEMPLATE_FRONT. DS . "side-nav.php") ?>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                 <?php include(TEMPLATE_FRONT. DS . "carousel.php") ?>
                    </div>

                </div>

                <div class="row">
                    <?php listProducts(); ?>

                </div> <!-- row ends there -->

            </div>

        </div>

    </div>
    <!-- /.container -->

    <?php include(TEMPLATE_FRONT. DS . "footer.php") ?>

