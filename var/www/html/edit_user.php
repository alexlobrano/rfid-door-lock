<!DOCTYPE html>
<html>
<body>

Which user would you like to edit?

<form action="edit_user_data.php" method="post">
User: <select name="user">
	<?php
	$servername = "localhost";
	$username = "alex";
	$password = "password";
	$dbname = "door_db";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = mysqli_query($conn, "SELECT name FROM users");
	while ($row = $sql->fetch_assoc()){
		echo "<option value=" . $row['name'] . ">" . $row['name'] . "</option>";
	}
	?>
	</select>
<br><br>
<input type="submit" value="Submit user">
</form>

</body>
</html>