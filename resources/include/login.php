<?php
//Is de gebruiker ingelogd?
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: index.php?content=progress");
	exit;
}
//Variable alvast definieren
$email = $password = "";
$email_err = $password_err = "";

//Als de gebruiker hiervoor heeft geregistreerd, laat een melding zien dat het account is aangemaakt
if (isset($_SESSION["created"])) {
} else {
	$_SESSION["created"] = false;
}
if ($_SESSION["created"] == true) {
	echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Uw nieuwe account is aangemaakt!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	$_SESSION["created"] = false;
}
//Als de button is ingedrukt
if($_SERVER["REQUEST_METHOD"]== "POST") {
	//Als email leeg is
	if(empty(trim($_POST["email"]))){
		$email_err = "Please enter email.";
	} else{
		$email = trim($_POST["email"]);
	}
	
	//Als wachtwoord leeg is
	if(empty(trim($_POST["password"]))){
		$password_err = "Please enter your password.";
	} else{
		$password = trim($_POST["password"]);
	}
	//Als er geen errors zijn
	if(empty($email_err) && empty($password_err)){
				//Bereid een select statement voor
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$sql = "SELECT id, email, password FROM Users WHERE email = ?";
		if($stmt = mysqli_prepare($conn, $sql)){
						//Verbind variable aan de select statement
			mysqli_stmt_bind_param($stmt, "s", $param_email);
			
						//Zet de parameter email
			$param_email = $email;
			
						//Voer de statement uit
			if(mysqli_stmt_execute($stmt)){
								//Sla het op
				mysqli_stmt_store_result($stmt);
								 //Bestaat de email al in onze database?
				if(mysqli_stmt_num_rows($stmt) == 1){                    
										//Verbind de nieuwe variables aan de statement
					mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
					if(mysqli_stmt_fetch($stmt)){
						//Is de wachtwoord juist?
						if(password_verify($password, $hashed_password)){
							//Verbind de variables aan de sessie variables
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["email"] = $email;
							
							//gaar naar login pagina (maar omdat er boveaan kijkt of de persoon als is ingelogd wordt deze doorgestuurd naar de progress pagina)
							header("location: index.php?content=login");
						} else{
							$password_err = "The password you entered was not valid.";
						}
					}
				} else{
					$email_err = "No account found with that email.";
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}
		}
		
		mysqli_stmt_close($stmt);
	}
	
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