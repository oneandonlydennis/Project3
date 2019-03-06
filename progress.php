<?php
require_once "config.php";
$sql = "SELECT * FROM Users";

$result = mysqli_query($conn, $sql);

mysqli_close($conn);

$progress = "progress";
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
			<?php
			while ($record = mysqli_fetch_assoc($result)){
				echo "<tr><th scope='row'>" . $record["id"] . "</th>
				<td>" . $record["username"] . "</td>
				<td>" . $record["progress"] . "</td>
				<td>" . $record["role"] . "</td>";
			}
			?>
		</tbody>
	</table>
</main>