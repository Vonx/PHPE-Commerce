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
                            <a class="btn btn-primary" target="_blank" href="item.php?={$row['product_id']}">Add to cart</a>
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

?>