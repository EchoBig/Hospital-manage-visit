<?php
	$serverName = "localhost";
	$userName = "";
	$userPassword = "";
	$dbName = "visit";
	$conn= mysqli_connect($serverName,$userName,$userPassword,$dbName);
	mysqli_query($conn, "SET NAMES 'utf8' ");
?>
