<?php
	include('templates/header.php');
	include_once('../controller/display_items.php');
	include_once('templates/product_templates.php');
?>


<div class="container--fluid">
	<h1>Movies</h1>
	<?php echo_products_container($movies, "DVD's"); ?><br>
	<?php echo_products_container($blueray, "BlueRay"); ?>
</div>

<div class="container--fluid">
	<h1>Games</h1>
	<?php echo_products_container($xbox, "Xbox One"); ?><br>
	<?php echo_products_container($ps4, "Playstation 4"); ?>
</div>

	

<?php include('templates/footer.php') ;?>