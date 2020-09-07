<?php 
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'MaiAnh2811!';
$dbName = 'vietproshop';

	//Create connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn-> connect_error) {
	die("Connect failed: ". $conn-> connect_error);
}


?>