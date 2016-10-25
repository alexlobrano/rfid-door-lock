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

$id = 'noentry';
$name = $_POST['name']; 
$user_group = $_POST['name'];
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

$sql = "SELECT * FROM users WHERE user_group='$user_group'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
        echo "Error: this user group already exists";
} else {
	$sql = "INSERT INTO users (id, name, user_group, monday_s, monday_e, tuesday_s, tuesday_e, wednesday_s, wednesday_e, thursday_s, thursday_e, friday_s, friday_e, saturday_s, saturday_e, sunday_s, sunday_e) VALUES ('$id', '$name', '$user_group', '$monday_s', '$monday_e', '$tuesday_s', '$tuesday_e', '$wednesday_s', '$wednesday_e', '$thursday_s', '$thursday_e', '$friday_s', '$friday_e', '$saturday_s', '$saturday_e', '$sunday_s', '$sunday_e')";

	if($conn->query($sql) === TRUE) {
		echo "User group added successfully";
	} else {
		echo "Error: " . $conn->error;
	}
}
$conn->close();
?>

</body>
</html>
