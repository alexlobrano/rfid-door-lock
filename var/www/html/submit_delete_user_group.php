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

$user_group = $_POST['user_group']; 

$sql = "UPDATE users SET user_group='custom' WHERE user_group='$user_group'";
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
