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

Which user would you like to edit?

<form action="edit_user_data.php" method="post">
User: <select name="name">
	<?php
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
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
<input type="submit" value="Edit user">
</form>

</body>
</html>