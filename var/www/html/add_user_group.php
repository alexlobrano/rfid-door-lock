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
?>

Enter the following for the new user group:

<form action="submit_add_user_group.php" method="post">
User Group Name: <input type="text" autocomplete="off" name="name" pattern="[^\s]*" required>

<br><br>
Times allowed entry to Vancouver for this group (note: enter as HH:MM:SS using 24 hour time, the values below are default settings but feel free to edit):
<br><br>
Monday start time: <input type="text" autocomplete="off" name="monday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
Monday end time: <input type="text" autocomplete="off" name="monday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
<br><br>
Tuesday start time: <input type="text" autocomplete="off" name="tuesday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
Tuesday end time: <input type="text" autocomplete="off" name="tuesday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
<br><br>
Wednesday start time: <input type="text" autocomplete="off" name="wednesday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
Wednesday end time: <input type="text" autocomplete="off" name="wednesday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
<br><br>
Thursday start time: <input type="text" autocomplete="off" name="thursday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
Thursday end time: <input type="text" autocomplete="off" name="thursday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
<br><br>
Friday start time: <input type="text" autocomplete="off" name="friday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
Friday end time: <input type="text" autocomplete="off" name="friday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
<br><br>
Saturday start time: <input type="text" autocomplete="off" name="saturday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
Saturday end time: <input type="text" autocomplete="off" name="saturday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
<br><br>
Sunday start time: <input type="text" autocomplete="off" name="sunday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
Sunday end time: <input type="text" autocomplete="off" name="sunday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" required>
<br><br>
<input type="submit" value="Submit user group">
</form>

</body>
</html>
