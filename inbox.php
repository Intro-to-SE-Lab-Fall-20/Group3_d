<h1 align="center">Inbox</h1>
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


$sql = "SELECT * FROM emails WHERE recipient = '$_SESSION[username]@email.com'";
$result = $conn->query($sql);

echo "<div style='margin-left:auto;margin-right:auto;width:850px;height:auto;border:2px solid red;'>";

echo "<table style='margin-left:auto;margin-right:auto'; border='1'; width='840'>";
echo "<tr><th>Select </th><th>Sender </th><th>Subject </th><th>Message </th><th>Date</th></tr>";
    
  while($row = $result->fetch_assoc()) 
  {
        echo "<tr>";
	    echo "<form action='delete_msg.php' method='post'>";
	    echo "<td><input type='checkbox' name='ch[]' value=$row[id]/></td>";
        echo "<td>".$row["sender"]."</td>";
        echo "<td>".$row["subject"]."</td>";
        echo "<td>".$row["email"]."</td>";
	    echo "<td>".$row["created_at"]."</td>";
	    echo "</tr>";	
	}
	echo "</table>";
	


?>
<input type='submit' value='Delete' name='delete'/>
	<form method="post">
	    <div class="form-row mb-3">
                <label for="to" class="col-2 col-sm-1 col-form-label">To:</label>
                <div class="col-10 col-sm-11">
                    <input type="email" name="to_email" class="form-control" id="to" placeholder="Type email">
                </div>
            </div>
            <div class="form-group">
                    <button type="submit" name="forward" class="btn btn-success">Forward</button>
                </div>
        </form>

</div>


