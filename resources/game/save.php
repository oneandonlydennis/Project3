<?php
session_start();
header("Access-Control-Allow-Origin: *");
//connectie database includen
require_once "../../config.php";
$progress = mysqli_real_escape_string($conn, $_GET["progress"]); 

//progress opslaan van gebruiker
$sql = "UPDATE Users SET progress='$progress' WHERE id = '$_SESSION[id]'"; 
if (mysqli_query($conn, $sql)) {
	echo "success";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>