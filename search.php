
<html>
	<head>
		<title>Search data </title>
		<style>
			body{
				background-color:whitesmoke;
			}
			input{
				width: 200px;
				height: 8%;
				border: 1px;
				border-radius: 05px
			}
		</style>
	</head>
	<body>
		<form action="" method = "POST">
			<input type="text" name = "search" placeholder = "Enter keywords to search....">
			<input type="submit" name = "Go">
		</form>
		</div>
		</form>
	</body>
</html>
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

if(isset($_POST['search']))
{
	$search_query = $_POST['search'];
	$search_query = preg_replace("#[^0-9a-z]#i","",$search_query);
	$query = "SELECT * FROM emails WHERE (recipient = '$_SESSION[username]@email.com' OR sender = '$_SESSION[username]@email.com') AND (email LIKE '%$search_query%' OR subject LIKE '%$search_query%')";
	$result = $conn->query($query);
	echo "<div style='margin-left:auto;margin-right:auto;width:850px;height:auto;border:2px solid red;'>";

	echo "<table style='margin-left:auto;margin-right:auto'; border='1'; width='840'>";
	echo "<tr><th>Sender </th><th>Recipient </th><th>Subject </th><th>Message </th></tr>";
    
	while($row = $result->fetch_assoc())
	{

		echo "<tr>";
		echo "<td>".$row["sender"]."</td>";
		echo "<td>".$row["recipient"]."</td>";
        echo "<td>".$row["subject"]."</td>";
        echo "<td>".$row["email"]."</td>";
	    echo "</tr>";	
	}
	echo "</table>";
	
}



?>

