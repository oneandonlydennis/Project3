<?php
require_once "../../config.php";

$sql = "SELECT id FROM Users WHERE id = 7"; 

if (mysqli_query($conn, $sql)) {
	$record = mysqli_fetch_assoc($result);
	echo $record["id"];
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>