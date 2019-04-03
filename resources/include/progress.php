<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Variables definieren
$gebruiker = false;
$superadmin = false;
$delete = '';


//is persoon ingelogd?
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index.php?content=login");
	exit;
}
//Statement klaar zetten om progress te laten zien
$sql = "SELECT role FROM Users WHERE id = ?";
if($stmt = mysqli_prepare($conn, $sql)){
	mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	mysqli_stmt_bind_result($stmt, $role);
}
if (mysqli_stmt_fetch($stmt)) {
	//Is de persoon gebruiker? Laat alleen zijn eigen progress zien
	if ($role == "gebruiker") {
		$sql = "SELECT * FROM Users WHERE id = '$_SESSION[id]'";
		$result = mysqli_query($conn, $sql);
		$_SESSION["role"] = "gebruiker";
		$gebruiker = true;
	}
	//Is de persoon admin? Laat progress van iedereen zien
	if ($role == "admin") {
		$sql = "SELECT * FROM Users";
		$result = mysqli_query($conn, $sql);
		$_SESSION["role"] = "admin";
	}
	//Is de persoon superadmin? Laat een edit button zien om rollen te bewerken
	if ($role == "superadmin") {
		$sql = "SELECT * FROM Users";
		$result = mysqli_query($conn, $sql);
		$superadmin = true;
		$_SESSION["role"] = "superadmin";
	}
}

?>

<main class="container">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Username</th>
					<th scope="col">Progress</th>
					<th scope="col">role</th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($record = mysqli_fetch_assoc($result)){
					if ($superadmin) {
						$edit = "<a href='index.php?content=edit&id=". $record['id']. "'>✏️</a>";
					} else {
						$edit = "";
					}

				//$edit = "<a href='index.php?content=edit&id=". $record['id']. "'><img src='./resources/image/edit.png' width='30' alt='Edit record'></a>";
					echo "<tr><th scope='row'>" . $record["id"] . "</th>
					<td>" . $record["email"] . "</td>
					<td>" . $record["progress"] . "</td>
					<td>" . $record["role"] . "</td>
					<td>$edit</td>
					</tr>";
				}

				?>
			</tbody>
		</table>
	</div>
</main>
