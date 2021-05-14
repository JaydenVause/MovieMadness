<?php

	if(!isset($_SESSION['user'])){

		$errors = [];
		$errors[] = "This page is not avalible";
		$_SESSION['errors'] = $errors;
		header('location: ../view/login.php');
		exit();
	}

?>