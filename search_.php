<html>
	<head>
		<title>Search data into textbox</title>
		<style>
			body{
				background-color:whitesmoke;
			}
			input{
				width: 40%;
				height: 5%;
				border: 1px;
				border-radius: 05px
			}
		</style>
	</head>
	<body>
		<center>
	
		<form action="",method="POST">
			<input type="text" name="id" placeholder="Enter keyword to search emails"><br/>
			<input type="submit" name="Search" value="Search Data">
		</form>



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

if(isset($_POST["Search"]))
{
    $search=$_POST['id'];
    //$sql="select * from emails where email  like '%$search%' limit 1";

    $query = "SELECT * FROM emails WHERE sender LIKE '%Search%' OR recipient LIKE '%Search%' OR subject LIKE '%Search%' OR email LIKE '%Search%'";
    $query_run = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($query_run))
    {
        ?>
            <form action="" method="POST">
                <input type="text" name="sender" value="<?php echo $row['sender'] ?>">
                <input type="text" name="recipient" value="<?php echo $row['recipient'] ?>">
                <input type="text" name="subject" value="<?php echo $row['subject'] ?>">
                <input type="text" name="email" value="<?php echo $row['email'] ?>">
            </form>
        <?php
    }
}

?>

        </center>
	</body>
</html>