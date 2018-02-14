<?php
session_start();
require_once("dbconnect.php");
?>
<html>
	<head>
		<title>Register / Login</title>
	</head>
	<body>
		<!--  Register form  -->
		<form name="register_form" action="register.php" method="post">
			<fieldset>
				<legend>Create a new account:</legend>
				Full name<br>
				<input type="text" name="register_name"/><br>
				Username<br>
				<input type="text" name="register_username" /><br>
				Password<br>
				<input type="password" name="register_password"/><br>
				Email (optional)<br>
				<input type="email" name="register_email" /><br>
				Do you want to receive our mails?
				<input type="checkbox" name="mail" value="Yes"><br><br>
				<input type="submit" name="register_btn" value="Register" />
				<input type="reset" value="Erase fields"> <br>
			</fieldset>
		</form>
		<br>
		
		<!--  Login form  -->
		<form name="login_form" action="login.php" method="post">
			<fieldset>
				<legend>Login :</legend>
				Username<br>
				<input type="text" name="login_username" id="login_username" /><br>
				Password<br>
				<input type="password" name="login_password" /><br>
				<input type="submit" name="login_btn" value="Login" />
				<input type="reset" value="Erase fields"> <br>
			</fieldset>
		</form>
	</body>

</html>