
<?php include('templates/header.php');?>
<?php include('../controller/authentication_checker.php'); ?>
<?php include('../controller/creating_products_information.php'); ?>
<?php include('../controller/updating_products_information.php'); ?>
	<div class="container--fluid">
		<form class="form form--add-product" action="controller/update_product_controller.php" method='POST' enctype="multipart/form-data">
			<h1>Update Product</h1>
			<label>Product Title:</label><br>
			<input type="hidden" name="productID" value="<?php echo $movie['productID']?>">
			<input class="form--add-product__input" type="text" name="productName" value="<?php echo $movie['productName'] ; ?>"><br>
			<label>System</label><br>
			<select class="form--add-product__input" name="productSystem">
				<option value="1"  <?= $movie['systemID'] == 1 ? 'selected' : '' ?>>DVD</option>
				<option value="2"  <?= $movie['systemID'] == 2 ? 'selected' : '' ?>>BlueRay</option>
				<option value="3"  <?= $movie['systemID'] == 3 ? 'selected' : '' ?>>Xbox One</option>
				<option value="4"  <?= $movie['systemID'] == 4 ? 'selected' : '' ?>>Playstation 4</option>
			</select><br>
			<label>Release Year:</label><br>
			<select class="form--add-product__input" name="productYear">
				<?php for($i = 1800; $i <= 2040; $i++){
					echo '<option '. ($movie['productYear'] == $i ? 'selected' : '').'>' . $i .'</option>';
				} ?>
			</select><br>
			<div>
				<!-- go through each genre and check if the genre printed is in the group of selected genres from the database genre assigned -->
				<label>Genres</label>
				<ul class="ul ul--unstyled ul--actor-select form--add-product__input">
					<?php
						// START
						// go through each actor in the database
								foreach ($genres as $genre ) {
						$string = '';
						// go through each actor assigned to this movie
						foreach ($selected_genres as $genreSelected) {
							if( $genreSelected['genreID'] == $genre['genreID']){
								$string = ' checked ';
							}
						}
						// if its assigned to this movie print it out checked
								echo '<li class="li li--director">' .
								'<input type="checkbox" class="checkbox
								checkbox--dark" name="productGenres[]"
								value="'. $genre['genreID'].'"'. $string .
								'>' . ucfirst($genre['genreName']) . '</li>';
					}
						// END
					?>
				</ul>
			</div><br>
			<div>
				<!-- go through each directors if it is assigned then checkbox it -->
				<label>Directors</label>
				<ul class="ul ul--unstyled ul--actor-select form--add-product__input">
					<!-- START -->
					<?php 
					// go through each of the directors in the list,
					// if it is in the list of directors print it out checked
					// if it isnt in the list print it out unchecked
						foreach ($directors as $directorDB ) {
							$string = '';

							foreach ($selected_directors as $director) {
								if( $director['producerID'] == $directorDB['producerID']){
									$string = ' checked ';
								}
							}

									echo '<li class="li li--director">' .
									'<input type="checkbox" class="checkbox
									checkbox--dark" name="productDirectors[]"
									value="'. $directorDB['producerID'].'"'. $string .
									'>' . ucfirst($directorDB['producerFirstName']) .
									' '. ucfirst($directorDB['producerLastName']) . '</li>';
						}
					?>

				</ul>
			</div>
			<div>
				<label>Actors</label>
				<ul class="ul ul--unstyled ul--actor-select form--add-product__input">

					<?php 
						// go through each actor in the database
								foreach ($actors as $actorDB ) {
									$string = '';
									// go through each actor assigned to this movie
									foreach ($selected_actors as $actorSelected) {
										if( $actorSelected['castID'] == $actorDB['castID']){
											$string = ' checked ';
										}
									}
									// if its assigned to this movie print it out checked
											echo '<li class="li li--director">' .
											'<input type="checkbox" class="checkbox
											checkbox--dark" name="productActors[]"
											value="'. $actorDB['castID'].'"'. $string .
											'>' . ucfirst($actorDB['castFirstName']) .
											' '. ucfirst($actorDB['castLastName']) . '</li>';
								}
						// END
					?>

					<!-- directors -->
				</ul>
			</div>
			<label>Description</label><br>
			<textarea class="form--add-product__input" name="productDescription"><?=$movie['productDescription'];?> </textarea><br>
			<div>
				<label>Cover Image</label>
				<div class="container--item" >
					<img src="<?php echo substr($movie['img'], 3); ?>" id='imageDiv' alt="Movie Cover">
				</div>
				<input type="file" id="productImage" name="productImage" class="input input--productImageBtn" onchange="readUrl(this)">
				<small class="small small--fileHolder">Max size: 2mb;</small>
				<script src="lib/image_functions.js"></script>

			</div>
			<span class="span span--center">
				<button class="button button--submit">Update</button>
			</span>
		</form>
	</div>
<?php include('templates/footer.php');?>