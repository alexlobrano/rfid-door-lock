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

$name = $_POST['name']; 

$sql = "DELETE FROM users WHERE name='$name'";

if($conn->query($sql) === TRUE) {
	echo "User deleted successfully";
} else {
	echo "Error: " . $conn->error;
}

$conn->close();
?>

</body>
</html>