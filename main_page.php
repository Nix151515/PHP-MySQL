
<html>
	<body>
		<h1 style="font-size:300%;color:Grey;text-align:center;font-family:verdana">Dogs</h1>
		<h2>Here is a video with a Corgi</h2>
		<video width="300" controls>
			<source src="audio_video/dog_video.mp4" type="video/mp4">
			Your browser does not support HTML5 video.
		</video>
		<br>
		<h2>A barking sound</h2>
		<audio controls>
			<source src="audio_video/bark.mp3" type="audio/mpeg">
			Your browser does not support the audio tag.
		</audio>
		<br><br>
		<fieldset>
			<legend>What is your favourite dog breed?</legend>
			<form action="main_page.php" id="form1" name="form1" method="POST">
				<label>
				<input type="radio" name="dogs" value="Golden Retriever" />
				Golden Retriever<br>
				</label>
				<label>
				<input type="radio" name="dogs" value="German Shepherd" />
				German Shepherd<br>
				</label>
				<label>
				<input type="radio" name="dogs" value="Welsh Corgi" />
				Welsh Corgi<br>
				</label>
				<label>
				<input type="radio" name="dogs" value="Beagle" />
				Beagle<br>
				</label>
				<label>
				<input type="radio" name="dogs" value="Other" />
				Other<br>
				</label>
				<input type="submit" name="submit" value="Vote" />
				<input type="hidden" name="id" value="form1" />
				<input type="hidden" name="MM_insert" value="form1" />
			</form>
		</fieldset>
	</body>
</html>


<?php

	session_start();
	require_once("dbconnect.php");
	
	// Create users choice table if not existing
	$sql = "CREATE TABLE question (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		selection VARCHAR(30) NOT NULL,
		choices INT(30) NOT NULL
		);";
	
	// Execute the query
	$result = mysqli_query($connect,$sql);
	
	if ($result)
	{
		// Build the query with the options available
		echo "(Table created)<br>";
		$query = "INSERT INTO question (selection,choices) VALUES ('Golden Retriever',0);";
		$query.= "INSERT INTO question (selection,choices) VALUES ('German Shepherd',0);";
		$query.= "INSERT INTO question (selection,choices) VALUES ('Welsh Corgi',0);";
		$query.= "INSERT INTO question (selection,choices) VALUES ('Beagle',0);";
		$query.= "INSERT INTO question (selection,choices) VALUES ('Other',0);";
		
		// Query successful
		if (mysqli_multi_query($connect,$query))
		{
			echo "(Inserted dogs)<br>";
		}
		else
		{
			die ( "(Options not inserted : ". mysqli_error($connect)." )<br>" );
		}
	}
	else
	{
		echo ( "(Table not created : ". mysqli_error($connect)." )<br><br>" );
	}

	if (isset($_POST['dogs']))   // if any of the options was checked
	{
		echo "You selected " .$_POST['dogs']. "<br><br>";    // echo the choice
		$chosen_dog = $_POST['dogs'];
	
		// Build the query (get the votes from the chosed option)
		$sql = "SELECT id,selection,choices FROM question WHERE selection = ". "'$chosen_dog'"   ." ;";
		
		$result = mysqli_query($connect,$sql);
		if($result)
		{
			// Increment the value fetched ( adding your vote )
			$out = mysqli_fetch_assoc($result);
			$new_val = 1+$out["choices"];
			
			// Update the table with the new value
			$sql ="UPDATE question SET choices=". "'$new_val'" . "WHERE selection = ". "'$chosen_dog'"   ." ;";
			$result = mysqli_query($connect,$sql);
		}
		else
		{
			die ( "(Error getting the votes : ". mysqli_error($connect)." )" );
		}

		// Query the total number of votes ( all options )
		$sql = "SELECT SUM(choices) FROM question ;";
		$result = mysqli_query($connect,$sql);
		$totalVotes = mysqli_fetch_row($result);

		// Get all the table rows to show the all-time results
		$sql = "SELECT id,selection,choices FROM question ;";
		$result = mysqli_query($connect,$sql);
		if($result)
		{
			if (mysqli_num_rows($result) > 0) 
			{
				echo "All-time visitors chose :<br>";
				
				// Print all the options and their votes with the percent
				while($row = mysqli_fetch_assoc($result)) 
				{
					// Calculate the percent
					if($row["choices"] == 0)
						$percent = 0;
					else
						$percent = 100/ ($totalVotes[0] / $row["choices"] );
					
					// Display the output for each entry
					echo $row["selection"]. "  ,  " . $row["choices"]. " votes ( ".round($percent,1)." %)<br>";
				}
			} 
			else 
			{
				echo "No results yet";
			}
		}
		else
		{
			die ( "Error getting the entries : ". mysqli_error($connect) );
		}
		echo "<br>";
	}
	else
	{
	//	echo "Nothing was selected.";
	}
	echo "<br>";
	
?>