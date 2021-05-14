<?php
	function insert_user($username, $SHA256, $SALT, $firstName, $lastName, $email, $phoneNumber, $addressNumber, $addressName, $addressType, $addressPostCode, $addressCity, $addressState){

	$dbc = connect_to_database();
	$sql = "INSERT INTO users (username, SHA256, SALT, firstName, lastName, email, phoneNumber, addressNumber, addressName, addressType, addressPostCode, addressCity, addressState) VALUES (:username, :SHA256, :SALT, :firstName, :lastName, :email, :phoneNumber, :addressNumber, :addressName, :addressType, :addressPostCode, :addressCity, :addressState)";
		$statement = $dbc->prepare($sql);
		$statement->bindValue(":username", $username);
		$statement->bindValue(":SHA256", $SHA256);
		$statement->bindValue(":SALT", $SALT);
		$statement->bindValue(":firstName", $firstName);
		$statement->bindValue(":lastName", $lastName);
		$statement->bindValue(":email", $email);
		$statement->bindValue(":phoneNumber", $phoneNumber);
		$statement->bindValue(":addressNumber", $addressNumber);
		$statement->bindValue(":addressName", $addressName);
		$statement->bindValue(":addressType", $addressType);
		$statement->bindValue(":addressPostCode", $addressPostCode);
		$statement->bindValue(":addressCity", $addressCity);
		$statement->bindValue(":addressState", $addressState);
		var_dump($statement);
		$result = $statement->execute();
		$statement->closeCursor();
		var_dump($result);
		return $result;
	}

	
		function retrieve_salt($username){
			$dbc = connect_to_database();
			$sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
			$sql = $dbc->prepare($sql);
			$sql->bindValue(':username', $username);
			$result = $sql->execute();
			$result = $sql->fetch();
			$sql->closeCursor();
			return $result;
		}

		function login($username, $password){
			$dbc = connect_to_database();
			$sql = 'SELECT * FROM users WHERE username = :username AND SHA256 = :password';
			$sql = $dbc->prepare($sql);
			$sql->bindValue(':username', $username);
			$sql->bindValue(':password', $password);
			$sql->execute();
			$result = $sql->fetchAll();
			$sql->closeCursor();
			$count = $sql->rowCount();
			return $count;
		}
?>