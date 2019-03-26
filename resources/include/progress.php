<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$superadmin = false;
$delete = '';



if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index.php?content=home");
	exit;
}
$sql = "SELECT role FROM Users WHERE id = ?";
if($stmt = mysqli_prepare($conn, $sql)){
	mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	mysqli_stmt_bind_result($stmt, $role);
}
if (mysqli_stmt_fetch($stmt)) {
	if ($role == "gebruiker") {
		$sql = "SELECT * FROM Users WHERE id = '$_SESSION[id]'";
		$result = mysqli_query($conn, $sql);
		$_SESSION["role"] = "gebruiker";
	}
	if ($role == "admin") {
		$sql = "SELECT * FROM Users";
		$result = mysqli_query($conn, $sql);
		$_SESSION["role"] = "admin";
	}
	if ($role == "superadmin") {
		$sql = "SELECT * FROM Users";
		$result = mysqli_query($conn, $sql);
		$superadmin = true;
		$_SESSION["role"] = "superadmin";
	}
}

?>

<main class="container">
	<div class="row-auto">
		<div class="col-auto">
		</div>
	</div>
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
				<td></td>
				<td></td>
				</tr>";
			}
			?>
		</tbody>
	</table>
</main>