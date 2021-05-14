<?php
session_start();
include('authentication_checker.php');
require_once('../model/conn.php');
require_once('../model/functions_products.php');
require_once('../model/functions_data.php');


// var_dump($_POST['productID']);
// cleanse variables
$errors = [];
$data = [];
$upload = 0;



// check request type
if($_SERVER["REQUEST_METHOD"] == "POST"){
	// check if its empty
	if(empty($_POST['productID'])){
		$errors[] = "Product is required";
	}else{
		// check if it is an int
		$_POST['productID']  = (int) $_POST['productID'];
		if(is_int($_POST['productID'])){
			$data['productID'] = test_input($_POST['productID']);
		}else{
			$errors[] = 'Invalid product';
		}
	}

	//check if system id is empty 
	if(empty($_POST['productSystem'])){
		$errors[] = "System is required";
	}else{
		// check if it is an int
		$_POST['productSystem']  = (int) $_POST['productSystem'];
		if(is_int($_POST['productSystem'])){
			// check its within the range of product systems
			if($_POST['productSystem'] <= 4 && $_POST['productSystem'] > 0){

				$data['productSystem'] = test_input($_POST['productSystem']);
			}else{
				$errors[] = 'Not a valid system';
			}
		}else{
			$errors[] = "Not a valid system";
		}
	}
	//check if product name is empty
	if(empty($_POST['productName'])){
		$errors[] = "Product Title is required";
	}else{
		// check it is a string 
		if(is_string($_POST['productName'])){
			// check its length is less then 120 characters
			if(strlen($_POST['productName']) < 120){
				$data['productName'] = test_input($_POST['productName']);
			}else{
				$errors[] = 'Product Name is too long';
			}
		}else{
			$errors[] = "Product Name must be a valid string";
		}
		

	}
	// 30th of janurary
	// check if product year is empty
	if(empty($_POST['productYear'])){
		$errors[] = "Product Year is required";
	}else{
		// check if it is an int
		$_POST['productYear']  = (int) $_POST['productYear'];
		if(is_int($_POST['productYear'])){
			// check year is a positive integer
			if($_POST['productYear'] > 0 ){
				$data['productYear'] = test_input($_POST['productYear']);
			}else{
				$errors[] = "Must be a valid year";
			}
		}else{
			$errors[] = "Must have a valid product Year";
		}
	}

	// check if product genres are empty
	if(empty($_POST['productGenres'])){
		$errors[] = "Product genres are required";
	}else{
		// check if its an array
		if(is_array($_POST['productGenres'])){
			// $data['productGenres'] = $_POST['productGenres'];
			// go through each genre and check it is an integer
			foreach ($_POST['productGenres'] as $gID) {
				$gID  = (int) $gID;
				if(is_int($gID)){
					$dataOK = 1;
				}else{
					$dataOK = 0;
					$errors[] = "Genre is not valid";
					break;
				}
			}
			$data['productGenres'] = $_POST['productGenres'];
		}else{
			$errors[] = 'Product genres invalid';
		}
		
	}

	// check if product actors are empty
	if(empty($_POST['productActors'])){
		$errors[] = "Product Actors are required";
	}else{

		// $data['productActors'] = $_POST['productActors'];

		if(is_array($_POST['productActors'])){
			// $data['productGenres'] = $_POST['productGenres'];
			// go through each genre and check it is an integer
			foreach ($_POST['productActors'] as $aID) {
				$aID = (int) $aID;
				if(is_int($aID)){
					$dataOK = 1;
				}else{
					$dataOK = 0;
					$errors[] = "Actors is not valid";
					break;
				}
			}
			$data['productActors'] = $_POST['productActors'];
		}else{
			$errors[] = 'Product actors invalid';
		}
	}


	// check if product directors are empty
	if(empty($_POST['productDirectors'])){
		$errors[] = "Product Directors are required";
	}else{
		// $data['productDirectors'] = $_POST['productDirectors'];
		if(is_array($_POST['productDirectors'])){
			// $data['productGenres'] = $_POST['productGenres'];
			// go through each genre and check it is an integer
			foreach ($_POST['productDirectors'] as $dID) {
				$dID = (int) $dID;
				if(is_int($dID)){
					$dataOK = 1;
				}else{
					$dataOK = 0;
					$errors[] = "Directors is not valid";
					break;
				}
			}
			$data['productDirectors'] = $_POST['productDirectors'];
		}else{
			$errors[] = 'Product Directors invalid';
		}
	}
	
	// check if product desription is empty
	if(empty($_POST['productDescription'])){
		$errors[] = "Product Description is required";
	}else{
		if(is_string($_POST['productDescription'])){
			if(strlen($_POST['productDescription']) > 0 && strlen($_POST['productDescription']) < 365 ){
			$data['productDescription'] = test_input($_POST['productDescription']);		
			}else{
				$errors[] = 'Product Description is too long';
			}
		}else{
			$errors[]  = 'Product Description is invalid type';
		}
		
	}

	if($_FILES['productImage']['error'] == 0){
		$target_dir = '../imgs/covers/';
		$target_file = $target_dir . basename($_FILES['productImage']['name']);
		$upload = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// check if it is an actual image or if it is a fake image
		$check = getimagesize($_FILES['productImage']['tmp_name']);
		if($check !== false){
			// file is an image
			$upload = 1;
			// check if file exists already 
			if (file_exists($target_file)){
				$upload = 0;
				$errors[] = 'sorry file already exists';
			}

			// check image file size
			if($_FILES['productImage']['size'] > 500000){
				$upload = 0;
				$errors[] = 'Image is too large.';
			}

			// limit file type

			if($imageFileType != 'jpg' && $imageFileType != 'png'  && $imageFileType != 'jpeg'  && $imageFileType != 'gif'){
				$upload = 0;
				$errors[] = "Sorry only jpg, jpeg, png & gif images are allowed";
			}

			if($upload == 0){
				$error[] = 'There was an error uploading your image';
			}else{
				// if its okay uploading your image
				$data['productImage'] = $target_file;
			}
		}else{
			$upload = 0;
			// file is not an image
			$errors[] = "File must be an image";
		}
	}



	// echo var_dump($errors);

	if (empty($errors)){
		// insert into database function
		// echo var_dump($data);
		// echo var_dump($errors);
		if (update_movie($data)){
			echo "Submitted to website";
			if($upload == 1){
				if(move_uploaded_file($_FILES['productImage']['tmp_name'], $target_file)){
					echo 'the file has been uploaded succesfully';
					// insert it into the database
				}
			}
			header('location: ../index.php');
		}else{
			$_SESSION['errors'] = $errors;
			echo "Error submitting the data";
		}
	}else{
		$_SESSION['errors'] = $errors;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	var_dump($errors);
}
// check validility

// escape values

// process
?>