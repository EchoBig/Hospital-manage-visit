<?php
	$serverName = "localhost";
	$userName = "eoffice";
	$userPassword = "e109311";
	$dbName = "visit";
	$conn= mysqli_connect($serverName,$userName,$userPassword,$dbName);
	mysqli_query($conn, "SET NAMES 'utf8' ");
?>
