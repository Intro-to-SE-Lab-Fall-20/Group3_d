<h1 align="center">Trash</h1>
<?php
include_once('connection.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql="SELECT * FROM trash where recipient='$_SESSION[username]@email.com'";
$result = $conn->query($sql);
echo "<div style='margin-left:auto;margin-right:auto;width:640px;height:auto;border:2px solid red;'>";

	echo "<table border='1' width='640'>";
	echo "<tr><th>Sender </th><th>Subject </th><th>Message </th><th>Deleted at</th></tr>";	
while($row = $result->fetch_assoc()) 
	{
		  echo "<tr>";
		  echo "<form>";
		  echo "<td>".$row["sender"]."</td>";
          echo "<td>".$row["subject"]."</td>";
          echo "<td>".$row["email"]."</td>";
		  echo "<td>".$row["Deleted_at"]."</td>";
		  echo "</tr>";	
	}

	echo "</table>";

	?>
