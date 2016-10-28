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

$user_group = $_POST['user_group']; 

$sql = "UPDATE users SET user_group='deleted_group' WHERE user_group='$user_group'";
if($conn->query($sql) === TRUE) {
        echo "Updated settings of users in old user group successfully";
	echo nl2br ("\n");
} else {
        echo "Error: " . $conn->error;
	echo nl2br ("\n");
}

$sql = "DELETE FROM users WHERE name='$user_group'";

if($conn->query($sql) === TRUE) {
	echo "User group deleted successfully";
	echo nl2br ("\n");
} else {
	echo "Error: " . $conn->error;
	echo nl2br ("\n");
}

$conn->close();
?>

</body>
</html>
