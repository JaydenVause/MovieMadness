<?php
	include('templates/header.php');
?>
<div class="container container--centered">
	<form class="form form--login" action="controller/register_controller.php" method="post">
		<h1>Register</h1>
		<label>First Name: <input class="login__input" type="text" name="userFirstName"></label><br>
		<label>Last Name: <input class="login__input" type="text" name="userLastName"></label><br>
		<label>Email Address: <input class="login__input" type="email" name="userEmailAddress"></label><br>
		<label>Phone Number: <input class="login__input" type="text" name="userPhoneNumber"></label><br>
		<label><u>Address</u></label><br>
		<table>
			<tr>
				<th>Street No.</th>
				<th>Street Name</th>
				<th>Type</th>
			</tr>
			<tr>
				<td><input type="number" name="userStreetNumber" ></td>
				<td><input type="text" name="userStreetName" ></td>
				<td>
					<select name="userStreetType">
						<option value="St">St</option>
						<option value="Rd">Rd</option>
						<option value="Cct">Cct</option>
						<option value="Ave">Ave</option>
					</select>
				</td>
				
			</tr>
			<tr>
				<th>City</th>
				<th>Postcode</th>
				<th>State</th>
			</tr>
			<tr>
				<td>
					<select name="userStreetCity">
						<option value="Adelaide">Adelaide</option>
						<option value="Gold Coast">Gold Coast</option>
						<option value="Perth">Perth</option>
						<option value="Sydney">Sydney</option>
					</select>
				</td>
				<td>
					 <input type="number" name="userStreetPostCode" >
				</td>
				<td>
					<select name="userStreetState" >
						<option value="SA">SA</option>
						<option value="QLD">QLD</option>
						<option value="NSW">NSW</option>
						<option value="WA">WA</option>
					</select>
				</td>
			</tr>
		</table>
		
		<label>Username: <input class="login__input" type="text" name="username"></label><br>
		<label>Password: <input class="login__input" type="password" name="password"></label><br>
		<label><input type="checkbox" name="userMarketing">Recieve Marketing & Updates!</label><br>
		<label><input type="checkbox" name="userTermsConditions">Agree To Our Terms & Conditions</label><br>
		<span class="login__span--center">
			<input class="login__input login__input--button button " type="submit" name="login" value="Register"><br>
		</span>
		<span>Have an account? <a href="view/login.php">Login</a></span>
	</form>
</div>
	
<?php include('templates/footer.php') ;?>