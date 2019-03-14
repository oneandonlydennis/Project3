<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: index.php?content=progress");
	exit;
}
$email = $password = "";
$email_err = $password_err = "";

	// Check if email is empty


if($_SERVER["REQUEST_METHOD"]== "POST") {

	if(empty(trim($_POST["email"]))){
		$email_err = "Please enter email.";
	} else{
		$email = trim($_POST["email"]);
	}
	
		// Check if password is empty
	if(empty(trim($_POST["password"]))){
		$password_err = "Please enter your password.";
	} else{
		$password = trim($_POST["password"]);
	}

	if(empty($email_err) && empty($password_err)){
				// Prepare a select statement
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$sql = "SELECT id, email, password FROM Users WHERE email = ?";
		if($stmt = mysqli_prepare($conn, $sql)){
						// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_email);
			
						// Set parameters
			$param_email = $email;
			
						// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
								// Store result
				mysqli_stmt_store_result($stmt);
								 // Check if email exists, if yes then verify password
				if(mysqli_stmt_num_rows($stmt) == 1){                    
										// Bind result variables
					mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
					if(mysqli_stmt_fetch($stmt)){
						if(password_verify($password, $hashed_password)){
														// Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["email"] = $email;
							
														// Redirect user to login page
							header("location: index.php?content=login");
						} else{
														// Display an error message if password is not valid
							$password_err = "The password you entered was not valid.";
						}
					}
				} else{
										// Display an error message if email doesn't exist
					$email_err = "No account found with that email.";
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}
		}
		
				// Close statement
		mysqli_stmt_close($stmt);
	}
	
		// Close connection
	mysqli_close($conn);
}
?>
<form action="index.php?content=login" method="post">
	<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
		<label for="email">email</label>
		<input type="text" class="form-control" id="email" placeholder="" name="email" value="<?php echo $email; ?>">
		<span class="help-block"><?php echo $email_err; ?></span>
	</div>
	<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
		<label for="password">password</label>
		<input type="password" class="form-control" id="password" placeholder="" name="password">
		<span class="help-block"><?php echo $password_err; ?></span>
	</div>
	<button type="submit" class="btn btn-primary">Login</button>
</form>

<!-- ?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> -->