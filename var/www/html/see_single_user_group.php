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

Which user group would you like to see settings for?

<form action="submit_see_single_user_group.php" method="post">
User: <select name="user_group">
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
<input type="submit" value="See settings for user group">
</form>

</body>
</html>
