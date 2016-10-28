<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php
if ($_SESSION["login"] != true) {
	header('Location: /index.php');
}

$servername = "localhost";
$username = $_SESSION["name"];
$password = $_SESSION["password"];
$dbname = "door_db";
?>

Which group would you like this user to join?

<form action="add_user_data.php" method="post">
User Group: <select name="user_group">
	<?php
	
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