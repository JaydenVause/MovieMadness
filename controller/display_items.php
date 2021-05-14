<?php
// grab database connection
include_once('../model/conn.php');
// grab functions for products
include_once('../model/functions_products.php');
// select all movies
$movies = select_products(1);
$blueray = select_products(2);
$xbox = select_products(3);
$ps4 = select_products(4);
?>