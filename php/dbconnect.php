<?php
	// Create a database connection
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "greenhouse2016";
	$dbname = "gh2016";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass,	$dbname);
	//Test if connection occured.
	
	if(mysqli_connect_errno()){
		//quit with message
		die("Database connection failed: " .
			mysqli_connect_error() . 
			" (" . mysqli_connect_errno() . ")"
		);
	}
	
?>
