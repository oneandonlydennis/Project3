<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index.php?content=home");
} elseif ($_SESSION["role"] !== "superadmin") {
	header("location: index.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){

}
?>	
