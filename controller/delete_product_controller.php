<?php
session_start();
include('authentication_checker.php');
$product_id = '';
$ok = 0;

require_once('../model/conn.php');
require_once('../model/functions_products.php');
require_once('../model/functions_data.php');

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(delete_product(test_input($_POST['productID']))){

			header('location: ../view/home.php');
		}else{
			echo 'error';
		}
	}
?>