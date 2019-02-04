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

echo $row['product_price'];
}
}

?>