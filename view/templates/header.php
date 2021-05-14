<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Movie Madness | Page Name</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">	
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Lato:wght@400;700&family=Montserrat&family=Open+Sans:ital,wght@0,300;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
	<base href="/movie_madness_R/">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<script src="lib/scroll.js"></script>
	<script  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="body">
	<header class="header">
		<a href="#" class="header__a--logo"><h1 class="h1 h1--logo">Movie Madness</h1></a>
		<nav class="nav nav--h">
			<ul class="nav__ul nav__ul--h">
				<li class="ul__li ul__li--h"><a href="#" class="li__a li__a--h">Home</a></li>
				<?php if(isset($_SESSION['user'])){?>
				<li class="ul__li ul__li--h"><a href="view/add_product.php" class="li__a li__a--h">Add Product</a></li>
				<li class="ul__li ul__li--h"><a href="controller/logout.php" class="li__a li__a--h">Logout</a></li>
				<?php }else{ ?>
				<li class="ul__li ul__li--h"><a href="view/login.php" class="li__a li__a--h">
				Login
				</a></li>
				<li class="ul__li ul__li--h"><a href="view/register.php" class="li__a li__a--h">Register</a></li>
				
				<?php } ?>
			</ul>
		</nav>
	</header>
	<div class="main">
		<?php include('../view/templates/error_box.php'); ?>
		<?php include('../view/templates/success_box.php'); ?>