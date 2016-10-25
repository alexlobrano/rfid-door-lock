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

$id = $_POST['id'];
$name = $_POST['name']; 
$user_group = $_POST['user_group'];
$monday_s = "";
$monday_e = "";
$tuesday_s = "";
$tuesday_e = "";
$wednesday_s = "";
$wednesday_e = "";
$thursday_s = "";
$thursday_e = "";
$friday_s = "";
$friday_e = "";
$saturday_s = "";
$saturday_e = "";
$sunday_s = "";
$sunday_e = "";

if($user_group != "custom")
{
	$sql = "SELECT * FROM users WHERE name='$user_group'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$monday_s = $row["monday_s"];
			$monday_e = $row["monday_e"];
			$tuesday_s = $row["tuesday_s"];
			$tuesday_e = $row["tuesday_e"];
			$wednesday_s = $row["wednesday_s"];
			$wednesday_e = $row["wednesday_e"];
			$thursday_s = $row["thursday_s"];
			$thursday_e = $row["thursday_e"];
			$friday_s = $row["friday_s"];
			$friday_e = $row["friday_e"];
			$saturday_s = $row["saturday_s"];
			$saturday_e = $row["saturday_e"];
			$sunday_s = $row["sunday_s"];
			$sunday_e = $row["sunday_e"];
		}
	}
}
else {
	$monday_s = $_POST['monday_s'];
	$monday_e = $_POST['monday_e'];
	$tuesday_s = $_POST['tuesday_s'];
	$tuesday_e = $_POST['tuesday_e'];
	$wednesday_s = $_POST['wednesday_s'];
	$wednesday_e = $_POST['wednesday_e'];
	$thursday_s = $_POST['thursday_s'];
	$thursday_e = $_POST['thursday_e'];
	$friday_s = $_POST['friday_s'];
	$friday_e = $_POST['friday_e'];
	$saturday_s = $_POST['saturday_s'];
	$saturday_e = $_POST['saturday_e'];
	$sunday_s = $_POST['sunday_s'];
	$sunday_e = $_POST['sunday_e'];
}

$sql = "UPDATE users SET name='$name', user_group='$user_group', monday_s='$monday_s', monday_e='$monday_e', tuesday_s='$tuesday_s', tuesday_e='$tuesday_e', wednesday_s='$wednesday_s', wednesday_e='$wednesday_e', thursday_s='$thursday_s', thursday_e='$thursday_e', friday_s='$friday_s', friday_e='$friday_e', saturday_s='$saturday_s', saturday_e='$saturday_e', sunday_s='$sunday_s', sunday_e='$sunday_e' WHERE id='$id'";

if($conn->query($sql) === TRUE) {
	echo "User edited successfully";
} else {
	echo "Error: " . $conn->error;
}

$conn->close();
?>

</body>
</html>