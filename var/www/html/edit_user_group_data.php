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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

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

$sql = "SELECT * FROM users WHERE name='$user_group'";
$result = $conn->query($sql);

echo "Showing current information in database for user group ";
echo $user_group;
echo nl2br ("\n");
echo "Edit information then click the submit button";
echo nl2br ("\n\n");

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
} else {
	echo "0 results";
}

$conn->close();
?>

<form action="submit_edit_user_group.php" method="post">
<input type="hidden" name="user_group" value="<?php echo $user_group;?>"
Times allowed entry to Vancouver (note: enter as HH:MM:SS using 24 hour time):
<br><br>

Monday start time: <input type="text" autocomplete="off" name="monday_s" value="<?php echo $monday_s;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br>

Monday end time: <input type="text" autocomplete="off" name="monday_e" value="<?php echo $monday_e;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>

Tuesday start time: <input type="text" autocomplete="off" name="tuesday_s" value="<?php echo $tuesday_s;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br>

Tuesday end time: <input type="text" autocomplete="off" name="tuesday_e" value="<?php echo $tuesday_e;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>

Wednesday start time: <input type="text" autocomplete="off" name="wednesday_s" value="<?php echo $wednesday_s;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br>

Wednesday end time: <input type="text" autocomplete="off" name="wednesday_e" value="<?php echo $wednesday_e;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>

Thursday start time: <input type="text" autocomplete="off" name="thursday_s" value="<?php echo $thursday_s;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br>

Thursday end time: <input type="text" autocomplete="off" name="thursday_e" value="<?php echo $thursday_e;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>

Friday start time: <input type="text" autocomplete="off" name="friday_s" value="<?php echo $friday_s;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br>

Friday end time: <input type="text" autocomplete="off" name="friday_e" value="<?php echo $friday_e;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>

Saturday start time: <input type="text" autocomplete="off" name="saturday_s" value="<?php echo $saturday_s;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br>

Saturday end time: <input type="text" autocomplete="off" name="saturday_e" value="<?php echo $saturday_e;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>

Sunday start time: <input type="text" autocomplete="off" name="sunday_s" value="<?php echo $sunday_s;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br>

Sunday end time: <input type="text" autocomplete="off" name="sunday_e" value="<?php echo $sunday_e;?>"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>

<input type="submit" value="Submit edited information">
</form>

</body>
</html>