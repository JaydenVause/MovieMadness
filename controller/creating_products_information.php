<?php
	include('authentication_checker.php');
	include_once('../model/conn.php');
	include_once('../model/functions_products.php');

	$dbc = connect_to_database();
	$actors = select_all_actors($dbc);
	$directors = select_all_producers($dbc);
	// print_r($directors);
	$genres = select_all_genres($dbc);
?>