<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "movie";
	$con = mysqli_connect($servername,$username,$password,$dbname);

	if (!$con) {
		die("Error: " . mysqli_connect_error());
	}
?>