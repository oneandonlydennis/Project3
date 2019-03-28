<?php
//Verwijder alle variables
session_unset();
 
//Vernietig de sessie
session_destroy();
 
// Redirect naar login pagina
header("location: ./index.php?content=home");
exit;
?>