<?php

$voornaam = "";
$achternaam = "";
$email = "";
$bericht = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $voornaam = mysqli_real_escape_string($conn, $_POST["voornaam"]);
  $achternaam = mysqli_real_escape_string($conn, $_POST["achternaam"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $bericht = mysqli_real_escape_string($conn, $_POST["bericht"]);

  if (empty($voornaam) || empty($achternaam) || empty($email) || empty($bericht)) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>U heeft een van de velden niet ingevuld.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
  } else {
    $sql = "INSERT INTO Contact (voornaam, achternaam, email, bericht) VALUES ('$voornaam', '$achternaam', '$email', '$bericht')";

    if (mysqli_query($conn, $sql)) {
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Uw bericht is verstuurd!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    } else {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Er is een probleem opgetreden, probeer het later nog eens.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }

    mysqli_close($conn);
  }

  
}

?>

<h2>Neem contact met ons op</h2>
<p>Vul hieronder je naam, email, en bericht in. Wij zullen ons best doen zo snel mogelijk te reageren.</p>

<form action="index.php?content=contact" method="post">
  <div class="form-group">
    <label for="voornaam">Voornaam:</label>
    <input type="text"
    class="form-control" name="voornaam" id="voornaam" aria-describedby="helpId" value="<?php echo $voornaam ?>" required>
  </div>
  <div class="form-group">
    <label for="achternaam">achternaam:</label>
    <input type="text"
    class="form-control" name="achternaam" id="achternaam" aria-describedby="helpId" placeholder="" value="<?php echo $achternaam ?>" required>
  </div>
  <div class="form-group">
    <label for="email">email:</label>
    <input type="email"
    class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" value="<?php echo $email ?>" required>
  </div>
  <div class="form-group">
    <label for="message">Bericht (max 1000 karakters):</label>
    <textarea class="form-control" name="bericht" id="message" rows="3" maxlength="1000" required><?php echo $bericht ?></textarea>
  </div>
  <button type="submit" name="submit" id="submit" class="btn btn-primary" btn-lg btn-block">Verstuur!</button>
</form>