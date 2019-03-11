<?php require_once("../resources/config.php"); ?>

<?php

 if(isset($_GET['add'])){

      $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']) . "");

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
                    }

/* $_SESSION['product_' . $_GET['add']] +=1;

 redirect("index.php");*/
 }

 if(isset($_GET['remove'])){

               if($_SESSION['product_' . $_GET['remove']] >= 1){

                $_SESSION['product_' . $_GET['remove']]--;
                   redirect("checkout.php");
               }

               else {
                 $_SESSION['message'] = "Your cart is empty";
                                          redirect("checkout.php");
               }
  }

  if(isset($_GET['delete'])){
  $_SESSION['product_' . $_GET['delete']] = '0';
  $_SESSION['message'] = "Your cart is empty";
   redirect("checkout.php");
  }


function cart() {

foreach ($_SESSION as $name => $value){
$_SESSION['orderTotal'] = 0;
$itemTotal = 0;


if($value > 0){
if(substr($name, 0, 8) == "product_"){

$length = strlen($name - 8);
$id = substr($name, 8, $length);

     $query = query("SELECT * FROM products WHERE product_id=" . escape_string($id) . "");
        confirm($query);
        while($row = mysqli_fetch_array($query)){
       $blah = $row['product_price'] * $value;
           $product = <<<DELIMETER
                   <tr>
                           <td>{$row['product_title']}</td>
                           <td>&#36;{$row['product_price']}</td>
                           <td>{$_SESSION['product_'. $id . '']}</td>
                           <td>&#36;{$blah}</td>
                           <td><a class='btn btn-warning' href="cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
                           <a class='btn btn-success' href="cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
                           <a class='btn btn-danger' href="cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a>
                           </td>


                       </tr>

                DELIMETER;
                $_SESSION['orderTotal'] = $_SESSION['orderTotal'] + $blah;
                echo $product;
        }
}
}

}
}
 ?>