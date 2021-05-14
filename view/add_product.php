
<?php include('templates/header.php');?>
<?php include('../controller/authentication_checker.php'); ?>
<?php include('../controller/creating_products_information.php'); ?>
	<div class="container--fluid">
		<form class="form form--add-product" action="controller/add_product_controller.php" method='POST' enctype="multipart/form-data">
			<h1>Add Product</h1>
			<label>Product Title:</label><br>
			<input class="form--add-product__input" type="text" name="productName" ><br>
			<label>System</label><br>
			<select class="form--add-product__input" name="productSystem">
				<option value="1">DVD</option>
				<option value="2">BlueRay</option>
				<option value="3">Xbox One</option>
				<option value="4">Playstation 4</option>
			</select><br>
			<label>Release Year:</label><br>
			<select class="form--add-product__input" name="productYear">
				<?php for($i = 1800; $i <= 2040; $i++){
					echo '<option value='.$i.'>' . $i .'</option>';
				} ?>
			</select><br>
			<div>
				<label>Genres</label>
				<ul class="ul ul--unstyled ul--actor-select form--add-product__input">
					<?php foreach($genres as $genre){
						echo '<li class="li li--director">';
						echo '<input type="checkbox" class="checkbox checkbox--dark" name="productGenres[]" value="'.$genre['genreID'].'">';
						echo ucfirst($genre['genreName']);
						echo '</li>';
					}?>
				</ul>
			</div><br>
			<div>
				<label>Directors</label>
				<ul class="ul ul--unstyled ul--actor-select form--add-product__input">
					<?php foreach($directors as $director){
						echo '<li class="li li--director">';
						echo '<input type="checkbox" class="checkbox checkbox--dark" name="productDirectors[]" value="'.$director['producerID'].'">';
						echo ucfirst($director['producerFirstName']).' '.ucfirst($director['producerLastName']);
						echo '</li>';
					}?>
				</ul>
			</div>
			<div>
				<label>Actors</label>
				<ul class="ul ul--unstyled ul--actor-select form--add-product__input">
					<?php foreach($actors as $actor){
						echo '<li class="li li--actor">';
						echo '<label>';
						echo '<input type="checkbox" class="checkbox checkbox--dark" name="productActors[]" value="'.$actor['castID'].'">';
						echo ucfirst($actor['castFirstName']).' '.ucfirst($actor['castLastName']);
						echo '<span class="checkbox--dark"></span>';
						echo '</label>';
						echo '</li>';
					}?>

					<!-- directors -->
				</ul>
			</div>
			<label>Description</label><br>
			<textarea class="form--add-product__input" name="productDescription"></textarea><br>
			<div>
				<label>Cover Image</label>
				<div class="container--item" >
					<img src="http://placehold.it/180" id='imageDiv' alt="Movie Cover">
				</div>
				<input type="file" id="productImage" name="productImage" class="input input--productImageBtn" onchange="readUrl(this)">
				<small class="small small--fileHolder">Max size: 2mb;</small>
				<script src="lib/image_functions.js"></script>

			</div>
			<span class="span span--center">
				<button class="button button--submit">Submit</button>
			</span>
		</form>
	</div>
<?php include('templates/footer.php');?>