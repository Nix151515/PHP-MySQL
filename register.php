<?php
	session_start();
	require_once("dbconnect.php");
	 
	//  Verify that fields are not empty
	if ($_POST['register_name'] != "" && $_POST['register_username'] != "" && $_POST['register_password'] != '') 
	{
		// Take the form data
		$name = $_POST['register_name'];
		$username = $_POST['register_username'];
		$password = md5($_POST['register_password']);
		$email = $_POST['register_email'];
		
		// Check if the user checked the mail box
		if (isset($_POST['mail'])) 
		{
			$check = "T";
		} 
		else 
		{
			$check = "F";
		}
		echo "(Check $check)<br>";
		
		
		// Build the query based on the data received
		$query = "INSERT INTO $table (name,username,password,email,checkbox) VALUES ('$name','$username','$password','$email','$check')";
		
		// Execute the query
		$result = mysqli_query($connect,$query);
		if(!$result)
			die ("Error inserting: ". mysqli_error($connect));
		else
		{
			echo "<h1>New account created successfully.<br>
				Click <a href='index.php'>here</a> to return to the login page</h1>";
			// Send a confirmation mail
			if($check == 'T')
			{
				$ret = mail($email,"Welcome, $name","Thank you for registering to our site");
				if( $ret == true ) 
				{
				   echo "(Mail sent successfully...)";
				}
				else 
				{
				   echo "(Mail could not be sent...)";
				}
			}
		}
	}
	else // Fields empty
	{
		echo "<h1>Please complete all the fields ! <br>
		Click <a href='index.php'>here</a> to return to the login page</h1>";
	}
?>