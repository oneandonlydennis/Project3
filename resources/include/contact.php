<h2>Contacteer ons</h2>
<p>Vul hieronder je naam, email, en bericht in. Wij zullen ons best doen zo snel mogelijk te reageren.</p>

<form action="index.php?content=contactSend.php" method="post">
    <div class="form-group">
      <label for="voornaam">Voornaam:</label>
      <input type="text"
        class="form-control" name="voornaam" id="voornaam" aria-describedby="helpId" placeholder="">
    </div>
    <div class="form-group">
      <label for="achternaam">achternaam:</label>
      <input type="text"
        class="form-control" name="achternaam" id="achternaam" aria-describedby="helpId" placeholder="">
    </div>
    <div class="form-group">
      <label for="email">email:</label>
      <input type="email"
        class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
    </div>
    <div class="form-group">
      <label for="message">Bericht (max 1000 karakters):</label>
      <textarea class="form-control" name="message" id="message" rows="3" maxlength="1000"></textarea>
    </div>
    <button type="button" name="submit" id="submit" class="btn btn-primary" btn-lg btn-block">Verstuur!</button>
</form>