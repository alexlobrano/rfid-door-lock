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

$sql = "UPDATE users SET monday_s='$monday_s', monday_e='$monday_e', tuesday_s='$tuesday_s', tuesday_e='$tuesday_e', wednesday_s='$wednesday_s', wednesday_e='$wednesday_e', thursday_s='$thursday_s', thursday_e='$thursday_e', friday_s='$friday_s', friday_e='$friday_e', saturday_s='$saturday_s', saturday_e='$saturday_e', sunday_s='$sunday_s', sunday_e='$sunday_e' WHERE user_group='$user_group'";

if($conn->query($sql) === TRUE) {
	echo "Success";
} else {
	echo "Error: " . $conn->error;
}

$conn->close();
?>