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

$name = $_POST['name'];

$sql = "SELECT * from attempt_log WHERE name='$name'";
$result = $conn->query($sql);

echo "The results mean the following:";
echo nl2br ("\n");
echo "0: Door unlocked for resident";
echo nl2br ("\n");
echo "1: Door unlocked for brother or guest";
echo nl2br ("\n");
echo "2: Door remained locked for brother or guest (not allowed in at this time)";
echo nl2br ("\n");
echo "3: Door remained locked for brother or guest (error with settings)";
echo nl2br ("\n");
echo "4: Door remained locked, ID not recognized";
echo nl2br ("\n");
echo "5: Door tried to unlock but radio message timed out, so no confirmation whether door was unlocked or not";
echo nl2br ("\n");
echo "6: Door tried to unlock but radio received bad ack, so no confirmation whether door was unlocked or not";
echo nl2br ("\n\n");

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "Attempt by " . $row["name"]. " (" . $row["id"] . ") at " . $row["tdate"]. " " . $row["ttime"]. ", result: " . $row["door_unlocked"]. "<br><br>";
	}
} else {
	echo "0 results";
}
$conn->close();
?>

</body>
</html>
