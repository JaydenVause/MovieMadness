<?php
// <!-- connect to database -->
					function connect_to_database(){
						// try to connect
						try{
							$host = '127.0.0.1';
							$db = 'movie_madness';
							$user = 'root';
							$password = '';
							$dbc = new PDO("mysql:host=$host;dbname=$db", $user, $password);
							$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							return $dbc;
						}catch(PDOException $e){
							// if error throw the error
							echo "Error: " . $e;
						}
					}
?>