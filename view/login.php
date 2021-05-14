<?php
	include('templates/header.php');
?>
<div class="container container--centered">
	<form class="form form--login" action="controller/login_controller.php" method="post">
		<h1>Login</h1>
		<label>Username: <input class="login__input" type="text" name="username"></label><br>
		<label>Password: <input class="login__input" type="password" name="password"></label><br>
		<span class="login__span--center">
			<input class="login__input login__input--button button " type="submit" name="login" value="Login"><br>
		</span>
		<span>Need an account? <a href="view/register.php">Register</a></span>
	</form>
</div>
	
<?php include('templates/footer.php') ;?>