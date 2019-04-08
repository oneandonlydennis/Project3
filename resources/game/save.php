<?php
//connectie database includen
require_once "../../config.php";
$progress = mysqli_real_escape_string($conn, $_GET["progress"]); 




//progress opslaan van gebruiker
$sql = "UPDATE Users SET progress='$progress' WHERE id = 7"; 
if (mysqli_query($conn, $sql)) {
	echo "success";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>