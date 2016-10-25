<!DOCTYPE html>
<html>
<body>

Which group would you like this user to join?

<form action="add_user_data.php" method="post">
User Group: <select name="user_group">
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
<input type="submit" value="Submit">
</form>

</body>
</html>