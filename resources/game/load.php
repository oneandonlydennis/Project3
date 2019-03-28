<?php
//connectie database includen
require_once "../../config.php";

$sql = "SELECT progress FROM Users WHERE id = 7"; 

if ($result = mysqli_query($conn, $sql)) {
	$record = mysqli_fetch_assoc($result);
	//laat de progress van de gebruiker zien
	echo $record["progress"];
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>