<?php

session_start();
require_once('../model/conn.php');
require_once('../model/functions_data.php');
require_once('../model/functions_users.php');	

// Register a user
// cleans variables

$username = $password = $userEmailAddress = $userPhoneNumber = $userStreetNumber = $userStreetName = $userStreetType = $userStreetCity = $userStreetPostCode = $userStreetState = $userTermsConditions = $userMarketing = $salt = $sha256 = '';

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	// if username is set
	if(!empty($_POST['username'])){
		$username = $_POST['username'];
	}else{
		$errors[] = 'You must provide a valid username';
	}
	// check if password is set
	if(!empty($_POST['password'])){
		// rinse variables generate sha256 and salt
		if(strlen($_POST['password']) > 6){
			$password = test_input($_POST['password']);
			$salt = md5(uniqid(rand(), true));
			$sha256 = hash('sha256', $password.$salt);
		}
	}else{
		$errors[] = 'You must provide a valid password';
	}
	if(!empty($_POST['userFirstName'])){
		$userFirstName = test_input($_POST['userFirstName']);
	}else{
		$errors[] = "You must provide a valid first name .";
	}
	if(!empty($_POST['userLastName'])){
		$userLastName = test_input($_POST['userLastName']);
	}else{
		$errors[] = "You must provide a valid last name";
	}
	// check if email set
	if(!empty($_POST['userEmailAddress'])){
		$userEmailAddress = test_input($_POST['userEmailAddress']);
	}else{
		$errors[] = "You must provide a valid email address.";
	}
	// check if phone number set
	if(!empty($_POST['userPhoneNumber'])){
		$userPhoneNumber = test_input($_POST['userPhoneNumber']);	
	}else{
		$errors[] = "You must provide a valid phone number.";
	}
	// check if streeet no set
	if(!empty($_POST['userStreetNumber'])){
		$userStreetNumber = test_input($_POST['userStreetNumber']);
	}else{
		$errors[] = 'You must provide a valid street number.';
	}
	// check street name set
	if(!empty($_POST['userStreetName'])){
		$userStreetName = test_input($_POST['userStreetName']);
	}else{
		$errors[] = "You must provide a valid street name.";
	}
	// START
	if(!empty($_POST['userStreetType'])){
		$userStreetType = test_input($_POST['userStreetType']);
	}else{
		$errors[] = "You must provide a valid street type.";
	}
	if(!empty($_POST['userStreetCity'])){
		$userStreetCity = test_input($_POST['userStreetCity']);
	}else{
		$errors[] = "You must provide a valid street city.";
	}
	if(!empty($_POST['userStreetPostCode'])){
		$userStreetPostCode = test_input($_POST['userStreetPostCode']);
	}else{
		$errors[] = "You must provide a valid Post Code.";
	}
	if(!empty($_POST['userStreetState'])){
		$userStreetState = test_input($_POST['userStreetState']);
	}else{
		$errors[] = "You must provide a valid street name.";
	}
	// END
	// check marketing
	if(isset($_POST['userMarketing'])){
		$userMarketing = test_input($_POST['userMarketing']);
	}
	// check terms conditions
	if(isset($_POST['userTermsConditions'])){
		$userTermsConditions = test_input($_POST['userTermsConditions']);
	}else{
		$errors[] = "You must agree to our Terms and Conditions.";
	}
	


	// parse data
	if(empty($errors)){
		// register user
		
		insert_user($username, $sha256, $salt, $userFirstName, $userLastName, $userEmailAddress, $userPhoneNumber, $userStreetNumber, $userStreetName, $userStreetType, $userStreetPostCode, $userStreetCity, $userStreetName);
		header('Location: ../view/home.php');
	}else{
		// errors
		$_SESSION['errors'] = $errors;	
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}else{
	header("location: ../view/home.php");
	exit();
}

// cleanse input

// verify data

// authentication

// check no errors 

foreach ($errors as $key => $value) {
	echo $key . ' $ ' . $value . '<br>';
}
foreach ($_POST as $key => $value) {
	echo $key . " $  " . $value.'<br>';
}

// run insert into database
// function insert_into_database($username, $password, $userFirstName, $userLastName, $userEmailAddress, $userMarketing, $userTermsConditions){
// 	$sql = "INSERT INTO users (username, password, userFirstName, userLastName, userEmailAddress, userMarketing, userTermsConditions) VALUES ($username, $password, $userFirstName, $userLastName, $userEmailAddress, $userMarketing, $userTermsConditions)";

// }



?>