<?php
session_start();

if ($_SESSION["login"] != true) {
	$servername = "localhost";
	$username = $_POST['name'];
	$password = $_POST['password'];
	$dbname = "door_db";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		$_SESSION["login"] = false;
		die("Connection failed: incorrect username or password");
	}
	else {
		$_SESSION["login"] = true;
		$_SESSION["name"] = $_POST['name'];
		$_SESSION["password"] = $_POST['password'];
}
}
?>

<html>
<body>

What would you like to do? <br><br>

<form action="add_user_recent.php" method="get">
<input type="submit" value="Add the most recently scanned card as a new user">
</form>

<form action="add_user.php" method="get">
<input type="submit" value="Add a new user and ID manually">
</form>

<form action="add_user_group.php" method="get">
<input type="submit" value="Add a new user group">
</form>
<br><br>
<form action="edit_user.php" method="get">
<input type="submit" value="Edit settings for an existing user">
</form>

<form action="edit_user_group.php" method="get">
<input type="submit" value="Edit settings for a user group">
</form>
<br><br>
<form action="delete_user.php" method="get">
<input type="submit" value="Delete an existing user">
</form>

<form action="delete_user_group.php" method="get">
<input type="submit" value="Delete an existing user group">
</form>
<br><br>
<form action="see_single_user.php" method="get">
<input type="submit" value="See settings for a single user">
</form>

<form action="see_single_user_group.php" method="get">
<input type="submit" value="See settings for a single user group">
</form>

<form action="see_all_users.php" method="get">
<input type="submit" value="See settings for all users">
</form>
<br><br>
<form action="pull_single_user.php" method="get">
<input type="submit" value="Pull entry logs for a single user">
</form>

<form action="pull_all_users.php" method="get">
<input type="submit" value="Pull entry logs for all users">
</form>

</body>
</html>
