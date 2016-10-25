<!DOCTYPE html>
<html>
<body>

Which user would you like to see entry logs for?

<form action="submit_pull_single_user.php" method="post">
User: <select name="name">
	<?php
	$servername = "localhost";
	$username = "alex";
	$password = "password";
	$dbname = "door_db";	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = mysqli_query($conn, "SELECT * FROM users");
	while ($row = $sql->fetch_assoc()){
		if($row['name'] != $row['user_group']) {
			echo "<option value=" . $row['name'] . ">" . $row['name'] . "</option>";
		}
	}
	?>
	</select>
<br><br>
<input type="submit" value="See entry logs for user">
</form>

</body>
</html>
