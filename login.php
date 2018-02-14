<?php
	session_start();
	require_once("dbconnect.php");
	
	//  Verify that fields are not empty
	if ($_POST['login_username'] != "" && $_POST['login_password'] != '') 
	{
		// Take the form data
		$username = $_POST['login_username'];
		$password = md5($_POST['login_password']);
 
		// Build the select query
		$query = "SELECT * FROM $table WHERE `Username` = '".$username."' AND `Password` = '".$password."'";
		
		//Execute the query
		$result = mysqli_query($connect,$query);
 
		// Check if the query executed successfully
		if (!$result || mysqli_num_rows($result) < 1)
		{
			echo "<h1>Incorrect data<br>
				Click <a href='index.php'>here</a> to return to login page</h1>";
		} 
		else
		{
			// Save the credentials in session variables for further use
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
	 
			// Success message     
			echo "<h1>Successful authentication<br>
						Click <a href = 'main_page.php'>here </a> to go to the main page</h1>";
			
			// Set a cookie with the last time visit or display it if exists
			if(isset($_COOKIE[$username]))
			{
				$lastVisit = $_COOKIE[$username]; 
				setcookie($username, date("d/m/y h:i:s"), time()+60*60*24*7, "/","", 0); // a week
				echo "<h1>Hello $username, welcome back !<br>
							Your last login : $lastVisit</h1>";
			}
			else
			{
				setcookie($username, date("d/m/y h:i:s"), time()+60*60*24*7, "/","", 0); // a week
				echo "<h1>Welcome, $username ! <br></h1>";
			}
		}
	}
	else
	{
		echo "<h1>Please complete all the fields ! <br>
		Click <a href='index.php'>here</a> to return to the login page</h1>";
	}
?>

<html>
	<body>
		<img src="audio_video/dog_picture.png" alt="Doggo" width="400" height="400">;
	</body>
</html>
