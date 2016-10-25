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

$sql = "SELECT * from users WHERE name='$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"]. "<br>Name: " . $row["name"]. "<br>Group: " . $row["user_group"]. "<br>";
                echo "Times allowed at Vancouver:<br>";
                echo "Monday: " . $row["monday_s"]. " to " . $row["monday_e"]. "<br>";
                echo "Tuesday: " . $row["tuesday_s"]. " to " . $row["tuesday_e"]. "<br>";
                echo "Wednesday: " . $row["wednesday_s"]. " to " . $row["wednesday_e"]. "<br>";
                echo "Thursday: " . $row["thursday_s"]. " to " . $row["thursday_e"]. "<br>";
                echo "Friday: " . $row["friday_s"]. " to " . $row["friday_e"]. "<br>";
                echo "Saturday: " . $row["saturday_s"]. " to " . $row["saturday_e"]. "<br>";
                echo "Sunday: " . $row["sunday_s"]. " to " . $row["sunday_e"]. "<br><br>";
        }
} else {
        echo "0 results";
}
$conn->close();

?>

</body>
</html>
