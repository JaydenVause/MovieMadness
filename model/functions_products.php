<?php 
					// select product
					function select_product($productID){
						$dbc = connect_to_database();
						$sql = "SELECT * FROM products WHERE productID = $productID";
						$sql = $dbc->prepare($sql);
						$sql->execute();
						$result = $sql->fetch();
						$sql->closeCursor();
						return $result;
					}



					// <!-- select movies from database -->
					function select_products($systemID){
						$dbc = connect_to_database();
						$sql = 'SELECT * FROM products WHERE systemID = ' . $systemID;
						$sql = $dbc->prepare($sql);
						$sql->execute();
						$result = $sql->fetchAll();
						$sql->closeCursor();
						return $result;
					}
					
					// check all genres for product
					function find_genres($productID){
						$dbc = connect_to_database();
						$sql = "SELECT * FROM genreassigns WHERE productID = :productID";
						$sql = $dbc->prepare($sql);
						$sql->bindValue(':productID', $productID);
						$sql->execute();
						$result = $sql->fetchAll();
						$sql->closeCursor();
						return $result;
					}

					// check all directors for product
					function find_directors($productID){
						$dbc = connect_to_database();
						$sql = "SELECT * FROM producerassigns WHERE productID = :productID";
						$sql = $dbc->prepare($sql);
						$sql->bindValue(':productID', $productID);
						$sql->execute();
						$result = $sql->fetchAll();
						$sql->closeCursor();
						return $result;
					}
					function find_casts($productID){
						$dbc = connect_to_database();
						$sql = "SELECT * FROM castassigns WHERE productID = :productID";
						$sql = $dbc->prepare($sql);
						$sql->bindValue(':productID', $productID);
						$sql->execute();
						$result = $sql->fetchAll();
						$sql->closeCursor();
						return $result;
					}

					

					function select_all_actors($dbc){
						$sql = "SELECT * FROM casts";
						$sql = $dbc->prepare($sql);
						$sql->execute();
						$result = $sql->fetchAll();
						$sql->closeCursor();
						return $result;
					}

					function select_all_producers($dbc){
						$sql = "SELECT * FROM producers";
						$sql = $dbc->prepare($sql);
						$sql->execute();
						$result = $sql->fetchAll();
						$sql->closeCursor();
						return $result;
					}

					function select_all_genres($dbc){
						$sql = "SELECT * FROM genres";
						$sql = $dbc->prepare($sql);
						$sql->execute();
						$result = $sql->fetchAll();
						$sql->closeCursor();
						return $result;
					}
					// insert a movie to the database
					function insert_movie($data){
						// create our connection
						$dbc = connect_to_database();
						// create movie 
						isset($data['productImage']) ? '': $data['productImage'] = null;
						$sql = "INSERT INTO products (productYear, productName, 
						productDescription, systemID, img) VALUES (:productYear, :productName, :productDescription, :productSystem, :productImage)";
						// prepare statement
						$statement = $dbc->prepare($sql);
						// bind values
						$statement->bindValue(":productName", $data['productName']);
						$statement->bindValue(":productYear",  $data['productYear']);
						$statement->bindValue(":productDescription", $data['productDescription']);
						$statement->bindValue(":productSystem",  $data['productSystem']);
						$statement->bindValue(":productImage",  $data['productImage']);
						$result = $statement->execute();
						// pass that conn, the data and id of product to the functions assigning genres actors and directors
						$id = $dbc->lastInsertID();
						assign_genres($dbc, $data['productGenres'],$id);
						assign_actors($dbc, $data['productActors'],$id);
						assign_producers($dbc, $data['productDirectors'],$id);
						$statement->closeCursor();
						return $result;
					}

					// insert a movie to the database
					function update_movie($data){
						// create our connection
						$dbc = connect_to_database();

						remove_genres($dbc,$data['productID']);
						remove_actors($dbc,$data['productID']);
						remove_producers($dbc,$data['productID']);
						isset($data['productImage']) ? $string = ', img = :productImage' : $string = '';
						// create movie
						$sql = "UPDATE products SET productYear = :productYear ,
							productName = :productName , productDescription = :productDescription,
							systemID = :productSystem". $string ." WHERE productID = :productID";
						// prepare statement
						$statement = $dbc->prepare($sql);
						// bind values
						$statement->bindValue(":productID", $data['productID']);
						$statement->bindValue(":productName", $data['productName']);
						$statement->bindValue(":productYear",  $data['productYear']);
						$statement->bindValue(":productDescription", $data['productDescription']);
						$statement->bindValue(":productSystem",  $data['productSystem']);
						if(isset($data['productImage'])){
							$statement->bindValue(":productImage",  $data['productImage']);
						}
						$result = $statement->execute();
						$id = $data['productID'];
						assign_genres($dbc, $data['productGenres'],$id);
						assign_actors($dbc, $data['productActors'],$id);
						assign_producers($dbc, $data['productDirectors'],$id);
						$statement->closeCursor();
						return $result;
					}


					// DELETE MOVIE FUNCTION
					function delete_product($productID){
						// create our connection
						$dbc = connect_to_database();

						remove_genres($dbc,$productID);
						remove_actors($dbc,$productID);
						remove_producers($dbc,$productID);
						// create movie
						$sql = "DELETE FROM products WHERE productID = :productID";
						// prepare statement
						$statement = $dbc->prepare($sql);
						// bind values
						$statement->bindValue(":productID", $productID);
						
						$result = $statement->execute();
						$statement->closeCursor();
						return $result;
					}

					

					function assign_genres($dbc, $genres, $productID){
						foreach($genres as $genreID){
							$statement = 'INSERT INTO genreassigns (genreID, productID) VALUES (:genreID, :productID)';
							$statement = $dbc->prepare($statement);
							$statement->bindValue(":genreID", $genreID);
							$statement->bindValue(":productID", $productID);
							$result = $statement->execute();
							$statement->closeCursor();
						}
						return $result;
					}

					function assign_actors($dbc, $actors, $productID){
						foreach($actors as $castID){
							$statement = 'INSERT INTO castassigns (castID, productID) VALUES (:castID, :productID)';
							$statement = $dbc->prepare($statement);
							$statement->bindValue(":castID", $castID);
							$statement->bindValue(":productID", $productID);
							$result = $statement->execute(); 
							
						}
						$statement->closeCursor();
						return $result;
					}

					function assign_producers($dbc, $producers, $productID){
						foreach($producers as $producerID){
							$statement = 'INSERT INTO producerassigns (producerID, productID) VALUES (:producerID, :productID)';
							$statement = $dbc->prepare($statement);
							$statement->bindValue(":producerID", $producerID);
							$statement->bindValue(":productID", $productID);
							$result = $statement->execute();
							$statement->closeCursor();
						}
						return $result;
					}

					function remove_genres($dbc, $productID){
							$statement = 'DELETE FROM genreassigns WHERE productID = :productID';
							$statement = $dbc->prepare($statement);
							$statement->bindValue(":productID", $productID);
							$result = $statement->execute();
							$statement->closeCursor();						
					}

					function remove_actors($dbc, $productID){
							$statement = 'DELETE FROM castassigns WHERE productID = :productID';
							$statement = $dbc->prepare($statement);
							$statement->bindValue(":productID", $productID);
							$result = $statement->execute(); 
							$statement->closeCursor();
						
					}

					function remove_producers($dbc, $productID){
							$statement = 'DELETE FROM producerassigns WHERE productID =  :productID';
							$statement = $dbc->prepare($statement);
							$statement->bindValue(":productID", $productID);
							$result = $statement->execute();
							$statement->closeCursor();
					}

					function insert_movie_cover($data){
						// check if its a valid format,
						// check if its a valid size
						// check we dont currently have a file named thatfile
						// check its file name is lower then a current file name
						// if movie image exists already
						// delete file from database and from server with image file name
						// have filename loaded in database in file
						// upload image to database and server
					}

?>