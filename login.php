<?php
session_start();

require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";

	// Check if username is empty


if($_SERVER["REQUEST_METHOD"]== "POST") {

  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter username.";
  } else{
    $username = trim($_POST["username"]);
  }
  
    // Check if password is empty
  if(empty(trim($_POST["password"]))){
    $password_err = "Please enter your password.";
  } else{
    $password = trim($_POST["password"]);
  }

  if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $sql = "SELECT id, username, password FROM Users WHERE username = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      
            // Set parameters
      $param_username = $username;
      
            // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
                // Store result
        mysqli_stmt_store_result($stmt);
                 // Check if username exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
          if(mysqli_stmt_fetch($stmt)){
            if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
              session_start();
                            // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;                            
              
                            // Redirect user to welcome page
              header("location: read.php");
            } else{
                            // Display an error message if password is not valid
              $password_err = "The password you entered was not valid.";
            }
          }
        } else{
                    // Display an error message if username doesn't exist
          $username_err = "No account found with that username.";
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

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/png" href="resources/image/favicon.png"/>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="resources/style.css">

  <title>Login - Gametest opleiding</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row-auto">
      <div class="col-auto">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="icon">
            <a class="navbar-brand" href="index.html" width="100px" height="120px"><img src="./resources/image/logo.png"></a>  
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.html">Home</a>
              </li> 
              <li class="nav-item active">
                <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="game.html">game</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opleiding
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="inschrijven.php">Inschrijven</a>
                  <a class="dropdown-item" href="about.html">Over de opleiding</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="FAQ.html">FAQ</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-auto">
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" placeholder="" name="username" value="<?php echo $username; ?>">
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
          <label for="password">password</label>
          <input type="password" class="form-control" id="password" placeholder="" name="password">
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript" src=""></script>
</body>
</html> 