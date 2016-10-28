<?php
session_start();
$_SESSION["login"] = false;
?>

<!DOCTYPE html>
<html>
<body>

Please enter username and password to make changes:

<br><br>

<form action="main_menu.php" method="post">
Username: <input type="text" autocomplete="off" name="name" pattern="[^\s]*" required>
<br>
Password: <input type="password" autocomplete="off" name="password" pattern="[^\s]*" required>
<br><br>
<input type="submit" value="Log in">
</form>

</body>
</html>
