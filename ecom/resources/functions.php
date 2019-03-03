<?php

// helper functions

function redirect($location){
    header("Location: $location");
}

function query($sql){

    global $connection;

    return mysqli_query($connection, $sql);
}

function confirm($result) {
    global $connection;

    if (!$result){
        die("its dead jimmy " . mysqli_error($connection));
        }
}

function escape_string($string) {
global $connection;

return mysqli_real_escape_string($connection, $string);
}


//get products

function listProducts() {

$query = query("SELECT * FROM products");

confirm($query);

while($row = mysqli_fetch_array($query)){

$products = <<<DELIMETER
 <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id={$row['product_id']}"><img src={$row['product_image']} alt=""></a>
                            <div class="caption">
                                <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>{$row['product_description']}</p>
                            <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add to cart</a>
                            </div>
                        </div>
                    </div>
DELIMETER;

echo $products;

// echo $row['product_price'];
}
}

function getCategoryTitle() {
if(isset($_GET['id'])){
  $theQuery = query("SELECT * FROM categories WHERE cat_id=". escape_string($_GET['id']) . " limit 1");
      confirm($theQuery);
        while($row = mysqli_fetch_array($theQuery)){
  $categories = <<<DELIMETER
      <h1>{$row['cat_title']}</h1>
  DELIMETER;
  echo $categories;
              }
        }
}

function getCategories(){

                    $theQuery = query("SELECT * FROM categories");

                    confirm($theQuery);

                    while($row = mysqli_fetch_array($theQuery)){

$categories = <<<DELIMETER
     <a href='category.php?id={$row['cat_id']}' class='list-group-item'> {$row['cat_title']} </a>
DELIMETER;

echo $categories;

                    }
}



function getProductsByCategory(){

$query = query("SELECT * FROM products WHERE product_category_id =". escape_string($_GET['id']) . "");

confirm($query);

while($row = mysqli_fetch_array($query)){

$products = <<<DELIMETER
<div class="col-md-3 col-sm-6 hero-feature">
                                        <div class="thumbnail">
                                            <a href="item.php?id={$row['product_id']}"><img src={$row['product_image']} alt=""></a>
                                            <div class="caption">
                                            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                                                <h3><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h3>
                                                <p>{$row['product_short_desc']}</p>
                                                <p>
                                                    <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
DELIMETER;

echo $products;

                    }
}

function getProductsByCategoryInShop(){

$query = query("SELECT * FROM products");

confirm($query);

while($row = mysqli_fetch_array($query)){

$products = <<<DELIMETER
<div class="col-md-3 col-sm-6 hero-feature">
                                        <div class="thumbnail">
                                            <a href="item.php?id={$row['product_id']}"><img src={$row['product_image']} alt=""></a>
                                            <div class="caption">
                                            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                                                <h3><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h3>
                                                <p>{$row['product_short_desc']}</p>
                                                <p>
                                                    <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
DELIMETER;

echo $products;

                    }
}

function displayMessage(){
if (isset($_SESSION['message']))
                      {
                          echo $_SESSION['message'];
                          unset($_SESSION['message']);
                      }
}

function loginUser(){

        if(isset($_POST['submit'])){
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username='{$username}' AND password='{$password}'");
        confirm($query);

        if(mysqli_num_rows($query) == 0){
        $_SESSION['message'] = 'Invalid Login Credentials';

        }
        else {
        redirect("admin");
        }

    }
}

function sendMessage(){
       if(isset($_POST['submit'])){
            $to  = "someemailaddress@gmail.com";
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $headers = "From: {$name} {$email}";

            $result = mail($to, $subject, $message, $headers);

            if($result){
                $_SESSION['message'] = 'Message sent successfully';
                redirect("contact.php");
                }
            else {
             $_SESSION['message'] = 'Message was not able to be sent';
                             redirect("contact.php");
                }
}
}

?>