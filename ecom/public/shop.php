<!DOCTYPE html>
<html lang="en">

<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT. DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header>
     <h1>shop</h1>
        </header>

        <hr>

        <!-- Title -->
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

        <?php getProductsByCategoryInShop(); ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->

  <?php include(TEMPLATE_FRONT. DS . "footer.php") ?>