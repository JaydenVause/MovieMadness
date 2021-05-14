<?php
	include('authentication_checker.php');
	if(empty($_GET['product_id'])){
		header('location: home.php');
		exit();
	}else{
		require_once('../model/conn.php');
		include_once('../model/functions_products.php');
		include_once('../model/functions_data.php');
		$product_id = test_input($_GET['product_id']);
		$movie = select_product($product_id);
		$selected_genres = find_genres($product_id);
		;
		$selected_actors = find_casts($product_id);
		$selected_directors = find_directors($product_id);
		// var_dump($selected_genres);
		// echo '<br>';echo '<br>';echo '<br>';
		// var_dump($selected_actors);
		// echo '<br>';echo '<br>';echo '<br>';
		// var_dump($selected_directors);
		// echo '<br>';echo '<br>';echo '<br>';
		// get all product information for our page
		// check product genres
		// check product actors
		// chekc product directors
	}
	
?>