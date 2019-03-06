<?php
require_once "config.php";
$sql = "SELECT * FROM studenten";

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
				<td>" . $record[$progress] . "</td>
				<td>"
				//<a href='./edit.php?id={$record['id']}'><img src='./resources/image/edit.png' width='30' alt='Edit record'</a>
				//</td>
				//<td>
				//<a href='./delet.php?id={$record['id']}'><img src='./resources/image/delete.png' width='30' alt='Delet record'</a>
				//</td>
				//</tr>;
			}
			?>
		</tbody>
	</table>
</main>