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

<form action="main_menu.php" method="get">
<input type="submit" value="Return to homepage">
</form>

<br>

<?php

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if($row['name'] != $row['user_group']) {
			echo "ID: " . $row["id"]. "<br>Name: " . $row["name"]. "<br>Group: " . $row["user_group"]. "<br>";
			echo "Times allowed at Vancouver:<br>";
			echo "Monday: " . $row["monday_s"]. " to " . $row["monday_e"]. "<br>";
			echo "Tuesday: " . $row["tuesday_s"]. " to " . $row["tuesday_e"]. "<br>";
			echo "Wednesday: " . $row["wednesday_s"]. " to " . $row["wednesday_e"]. "<br>";
			echo "Thursday: " . $row["thursday_s"]. " to " . $row["thursday_e"]. "<br>";
			echo "Friday: " . $row["friday_s"]. " to " . $row["friday_e"]. "<br>";
			echo "Saturday: " . $row["saturday_s"]. " to " . $row["saturday_e"]. "<br>";
			echo "Sunday: " . $row["sunday_s"]. " to " . $row["sunday_e"]. "<br><br>";
		}
	}
} else {
	echo "0 results";
}
$conn->close();
?>

</body>
</html>
