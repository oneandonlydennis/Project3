<style>
	a img{
		max-width: 50px;
		max-height: 50px;
	}
</style>
<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
	<div class="logo"><a class="navbar-brand" href="./index.php?content=home"><img src="./resources/images/logo.png" alt="logo"></a></div>
	<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
	aria-expanded="false" aria-label="Toggle navigation"></button>
	<div class="collapse navbar-collapse" id="collapsibleNavId">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item">
				<a class="nav-link" href="./index.php?content=home">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="./index.php?content=faq">FAQ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="./index.php?content=info">Info</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="./index.php?content=contact">Contact</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="./index.php?content=progress">Game</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aanmelden</a>
				<div class="dropdown-menu" aria-labelledby="dropdownId">
					<a class="dropdown-item" href="./index.php?content=registreren">Registreren</a>
					<a class="dropdown-item" href="./index.php?content=login">Inloggen</a>
				</div>
			</li>
			<li>
				<div class="loggedin"><?php echo $loggedin ?></div>
			</li>
			<?php if (isset($_SESSION["loggedin"])) {
				echo "<a href='./index.php?content=logout' class='btn btn-danger'>Sign Out of Your Account</a>";
			}?>
		</ul>
	</div>
</nav>