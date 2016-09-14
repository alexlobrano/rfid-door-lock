<!DOCTYPE html>
<html>
<body>

Which user group would you like to edit?

<form action="edit_user_group_data.php" method="post">
User: <select name="user_group">
	<?php
	$servername = "localhost";
	$username = "alex";
	$password = "password";
	$dbname = "door_db";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = mysqli_query($conn, "SELECT DISTINCT user_group FROM users");
	while ($row = $sql->fetch_assoc()){
		echo "<option value=" . $row['user_group'] . ">" . $row['user_group'] . "</option>";
	}
	?>
	</select>
<br><br>
<input type="submit" value="Submit user group">
</form>

</body>
</html>