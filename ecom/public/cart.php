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
                     $_SESSION['message'] = $row['product_title'] . " is out of stock";
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
        $query = query("SELECT * FROM products");
        confirm($query);
        while($row = mysqli_fetch_array($query)){
           $product = <<<DELIMETER
                   <tr>
                           <td>{$row['product_title']}</td>
                           <td>{$row['product_price']}</td>
                           <td>{$row['product_quantity']}</td>
                           <td>2</td>
                           <td><a href="cart.php?remove=1">remove</a></td>
                           <td><a href="cart.php?delete=1">delete</a></td>

                       </tr>

                DELIMETER;
                echo $product;
        }

}

 ?>