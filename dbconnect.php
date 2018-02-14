
<?php
	$server = "localhost";
	$database = "testing";
	$username = "root";
	$parola = "admin";
	$table = "utilizatori";
	 
	// connect to MySQL server
	$connect = mysqli_connect($server,$username,$parola);
	 
	 // verify the connection
	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "(Connected successfully to MySQL server)<br><br>";
	 
	// select the database
	$db = mysqli_select_db($connect,$database);
	if(!$db)
		die("Connection to database failed".mysqli_error($connect));
	
	// write the query
	$sql = "CREATE TABLE utilizatori (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		name VARCHAR(30) NOT NULL,
		username VARCHAR(30) NOT NULL,
		password VARCHAR(50) NOT NULL,
		email VARCHAR(50) NOT NULL,
		checkbox ENUM('T', 'F') NOT NULL
		);";
	
	// apply the query
	mysqli_query($connect,$sql);
?>