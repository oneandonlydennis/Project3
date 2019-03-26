<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index.php?content=home");
} elseif ($_SESSION["role"] !== "superadmin") {
	header("location: index.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id = mysqli_real_escape_string($conn, $_POST["id"]);
	$role = mysqli_real_escape_string($conn, $_POST["role"]);
	$sql = "UPDATE Users SET role='$role' WHERE id='$id'";
	if (mysqli_query($conn, $sql)) {
		header("location: index.php?content=progress");
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
} else {
	$sql = "SELECT id, role FROM Users WHERE id = '$_GET[id]'";
	$result = mysqli_query($conn, $sql);
	$record = mysqli_fetch_assoc($result);
}

?>	
<form action="index.php?content=edit" method="post">
	<div class="form-group col-md-4">
		<label for="inputState">Role</label>
		<select id="inputState" class="form-control" name="role">
			<option><?php echo $record["role"]; ?></option>
			<option>gebruiker</option>
			<option>admin</option>
			<option>superadmin</option>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Submit">
	</div>
	<div class="form-group invisible">
      <input value="<?php echo $record['id']; ?>" name="id">
    </div>
</form>