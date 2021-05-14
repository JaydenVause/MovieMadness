<?php

session_start();



require_once('../model/conn.php');
require_once('../model/functions_data.php');
require_once('../model/functions_users.php');

$errors = [];
// Login a user
if($_SERVER['REQUEST_METHOD'] == "POST"){
	// if username <= 10 characters
	if(!empty($_POST['username'])){
		$username = test_input($_POST['username']);
	}else{
		$errors[] = 'Username is required.';
	}

	if(!empty($_POST['password'])){
		// retrieve password and rinse it
		$password = test_input($_POST['password']);
		// retrieve the salt for the user
		$result = retrieve_salt($username);



		// set the salt variable to result salt
		$salt = $result['SALT'];
		// set the password to a sha256 encryption of the password and salt concatted
		$password = hash('sha256', $password.$salt);

	}else{
		$errors[] = "Password is required.";
	}


	if(empty($errors)){
		// call the login function 
		$login = login($username, $password);

		if($login == 1 ){
			$success = [];
			$success[] = "Welcome $username !.";
			$_SESSION['success'] = $success;
			// start the session variable as user
			$_SESSION['user'] = $username;
			// set success message
			// redirect to home page
			header('location: ../view/home.php');
		}else{
			$errors[] = "Invalid username or password";
			$_SESSION['errors'] = $errors;
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}else{
		$_SESSION['errors'] = $errors;
			header('Location: ' . $_SERVER['HTTP_REFERER']);
	}


	
		


	// error

	// if password <= 10 characters
	// error

	// else 
	// salt password
	// sha256 password
	// retrieve user (username, password, salt)
	// if userfound $session_user = $user
	// redirect to home page
	// else redirect back to other page show error;

}
?>