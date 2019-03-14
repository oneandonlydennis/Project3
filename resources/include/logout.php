<?php
// Unset all of the session variables
session_unset();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: ./index.php?content=home");
exit;
?>