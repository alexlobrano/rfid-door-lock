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

$id = "";
$name = "";
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

$conn->close();
?>

Enter the following for the new user (note: names must be in firstname_lastname format):<br><br>

<form action="submit_add_user.php" method="post">
ID: <input type="text" autocomplete="off" name="id" required><br>
Name: <input type="text" autocomplete="off" name="name" pattern="[^\s]*" required><br>
<input type="hidden" name="user_group" value="<?php echo $user_group;?>">
<br><br>
Times allowed entry to Vancouver (note: time must always be in format HH:MM:SS using 24 hour time):
<br><br>

Monday start time: <?php if($user_group != "custom") {
echo $monday_s;}
else {
echo "<input type='text' autocomplete='off' name='monday_s' value='12:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br>

Monday end time: <?php if($user_group != "custom") {
echo $monday_e;}
else {
echo "<input type='text' autocomplete='off' name='monday_e' value='20:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br><br>

Tuesday start time: <?php if($user_group != "custom") {
echo $tuesday_s;}
else {
echo "<input type='text' autocomplete='off' name='tuesday_s' value='12:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br>

Tuesday end time: <?php if($user_group != "custom") {
echo $tuesday_e;}
else {
echo "<input type='text' autocomplete='off' name='tuesday_e' value='20:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br><br>

Wednesday start time: <?php if($user_group != "custom") {
echo $wednesday_s;}
else {
echo "<input type='text' autocomplete='off' name='wednesday_s' value='12:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br>

Wednesday end time: <?php if($user_group != "custom") {
echo $wednesday_e;}
else {
echo "<input type='text' autocomplete='off' name='wednesday_e' value='20:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br><br>

Thursday start time: <?php if($user_group != "custom") {
echo $thursday_s;}
else {
echo "<input type='text' autocomplete='off' name='thursday_s' value='12:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br>

Thursday end time: <?php if($user_group != "custom") {
echo $thursday_e;}
else {
echo "<input type='text' autocomplete='off' name='thursday_e' value='20:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br><br>

Friday start time: <?php if($user_group != "custom") {
echo $friday_s;}
else {
echo "<input type='text' autocomplete='off' name='friday_s' value='12:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br>

Friday end time: <?php if($user_group != "custom") {
echo $friday_e;}
else {
echo "<input type='text' autocomplete='off' name='friday_e' value='20:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br><br>

Saturday start time: <?php if($user_group != "custom") {
echo $saturday_s;}
else {
echo "<input type='text' autocomplete='off' name='saturday_s' value='12:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br>

Saturday end time: <?php if($user_group != "custom") {
echo $saturday_e;}
else {
echo "<input type='text' autocomplete='off' name='saturday_e' value='20:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br><br>

Sunday start time: <?php if($user_group != "custom") {
echo $sunday_s;}
else {
echo "<input type='text' autocomplete='off' name='sunday_s' value='12:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br>

Sunday end time: <?php if($user_group != "custom") {
echo $sunday_e;}
else {
echo "<input type='text' autocomplete='off' name='sunday_e' value='20:00:00' pattern='([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]' required>";}?>
<br><br>

<input type="submit" value="Submit user">
</form>

</body>
</html>