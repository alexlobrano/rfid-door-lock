<!DOCTYPE html>
<html>
<body>

Enter the following for the new user:

<form action="add_user_data.php" method="post">
ID: <input type="text" name="id"><br>
Name: <input type="text" name="name"><br>
User Group: 
	<select name="user_group">
		<option value="resident">Resident</option>
		<option value="brother">Brother</option>
		<option value="phikeia">Phikeia</option>
		<option value="other">Other</option>
	</select>
<br><br>
Times allowed entry to Vancouver (note: enter as HH:MM:SS using 24 hour time, the values below are default settings but feel free to edit):
<br><br>
Monday start time: <input type="text" name="monday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
Monday end time: <input type="text" name="monday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>
Tuesday start time: <input type="text" name="tuesday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
Tuesday end time: <input type="text" name="tuesday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>
Wednesday start time: <input type="text" name="wednesday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
Wednesday end time: <input type="text" name="wednesday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>
Thursday start time: <input type="text" name="thursday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
Thursday end time: <input type="text" name="thursday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>
Friday start time: <input type="text" name="friday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
Friday end time: <input type="text" name="friday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>
Saturday start time: <input type="text" name="saturday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
Saturday end time: <input type="text" name="saturday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>
Sunday start time: <input type="text" name="sunday_s" value="12:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
Sunday end time: <input type="text" name="sunday_e" value="20:00:00"
pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]">
<br><br>
<input type="submit" value="Submit user">
</form>

</body>
</html>