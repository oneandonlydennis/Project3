<?php
define('servername', 'localhost');
define('username', 'geheugentraining');
define('password', 'Welkom01');
define('dbname', 'geheugentraining');

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(servername, username, password, dbname);

	// Check connection
if($conn === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>