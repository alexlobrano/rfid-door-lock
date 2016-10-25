<html>
<body>

<form action="index.php" method="get"> 
<input type="submit" value="Return to homepage"> 
</form>

<?php
$servername = "localhost";
$username = "alex";
$password = "password";
$dbname = "door_db";

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