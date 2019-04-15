<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT. DS . "header.php") ?>

<?php
 if(isset($_GET['tx'])){

 $tx = $_GET['tx'];
 $status = $_GET['st'];
 $currency = $_GET['cc'];
 $amount = $_GET['amt'];

 /*$query = query("INSERT INTO completedOrders WHERE product_id=" . escape_string($_GET['add']) . "");

                    confirm($query);

                    while($row = mysqli_fetch_array($query)){

                     if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]){

                        $_SESSION['product_' . $_GET['add']] +=1;
                        redirect("checkout.php");

                     }
                     else {
                     $_SESSION['message'] = "Cannot buy more than " .$_SESSION['product_' . $_GET['add']] . " of this product";
                     redirect("checkout.php");
                     }
                    }*/



 }

else {
    redirect("index.php");
    }
 ?>

    <div class="container">
        <h1 class="text-center">Thank you</h1>
    </div>


    <?php include(TEMPLATE_FRONT. DS . "footer.php") ?>
