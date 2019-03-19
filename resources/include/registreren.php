<?php
// Define variables and initialize with empty values
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
    // Validate email
	if(empty(trim($_POST["email"]))){
		$email_err = "Please enter a email.";
	} else{
        // Prepare a select statement
		$sql = "SELECT id FROM Users WHERE email = ?";
		
		if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_email);
			
            // Set parameters
			$param_email = trim($_POST["email"]);
			
            // Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				/* store result */
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt) == 1){
					$email_err = "This email is already taken.";
				} else{
					$email = trim($_POST["email"]);
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}
		}
		
        // Close statement
		mysqli_stmt_close($stmt);
	}
	
    // Validate password
	if(empty(trim($_POST["password"]))){
		$password_err = "Please enter a password.";     
	} elseif(strlen(trim($_POST["password"])) < 6){
		$password_err = "Password must have atleast 6 characters.";
	} else{
		$password = trim($_POST["password"]);
	}
	
    // Validate confirm password
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = "Please confirm password.";     
	} else{
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($password_err) && ($password != $confirm_password)){
			$confirm_password_err = "Password did not match.";
		}
	}
	
    // Check input errors before inserting in database
	if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
		
        // Prepare an insert statement
		$sql = "INSERT INTO Users (email, password, role, progress) VALUES (?, ?, ?, ?)";
		var_dump($sql);
		if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "ssss", $param_email, $param_password, $param_role, $param_progress);
			
            // Set parameters
			$param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = 'gebruiker';
            $param_progress = '';
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
            	//header("location: login.php");
            } else{
            	echo "Something went wrong. Please try again later.";
            	var_dump($stmt);
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
<div class="register">
	<h2>Sign Up</h2>
	<p>Please fill this form to create an account.</p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
			<label>email</label>
			<input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
			<span class="help-block"><?php echo $email_err; ?></span>
		</div>    
		<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
			<label>Password</label>
			<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
			<span class="help-block"><?php echo $password_err; ?></span>
		</div>
		<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
			<label>Confirm Password</label>
			<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
			<span class="help-block"><?php echo $confirm_password_err; ?></span>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Submit">
			<input type="reset" class="btn btn-default" value="Reset">
		</div>
	</form>
</div>