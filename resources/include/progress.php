<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
while (mysqli_stmt_fetch($stmt)) {
	if ($role == "gebruiker") {
		echo "User is gebruiker";
	}
	if ($role == "admin") {
		echo "User is admin";
	}
	if ($role == "superadmin") {
		echo "User is superadmin";
	}
}

// $sql = "SELECT * FROM Users";

// $result = mysqli_query($conn, $sql);

// mysqli_close($conn);

// $progress = "progress";
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
			</tr>
		</thead>
		<tbody>
			<!--<?php
			while ($record = mysqli_fetch_assoc($result)){
				echo "<tr><th scope='row'>" . $record["id"] . "</th>
				<td>" . $record["username"] . "</td>
				<td>" . $record["progress"] . "</td>
				<td>" . $record["role"] . "</td>
				<td>
				<a href='./edit.php?id={$record['id']}'><img src='./resources/image/edit.png' width='30' alt='Edit record'</a>
				</td>
				<td>
				<a href='./delet.php?id={$record['id']}'><img src='./resources/image/delete.png' width='30' alt='Delet record'</a>
				</td>
				</tr>";
			}
			?>-->
		</tbody>
	</table>
</main>