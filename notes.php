<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include("connection.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <style type="text/css">
      body{ font: 12px sans-serif; text-align: center; background-image:url('background.jpg');}
      textarea.center{
        margin-left: auto;
        margin-right: auto;
      }
  </style>
</head>

<body>
  <h1>Hi, <?php echo $_SESSION["username"]; ?>.</h1>
<form method="post">
  <textarea id="subject" name="subject" rows="1" cols="30" position= "center" placeholder="Subject"></textarea>
  <br>
  <textarea id="Note" name="body" rows="4" cols="50" position= "center" placeholder="Enter note here..."></textarea>
  <br>
    <input type="submit" name="submit" value="Submit"/>
  </form>
    <?php
    if (isset($_POST['submit']))
    {
    	  $body = $_POST['body'];
        $subject = $_POST['subject'];
        $timestamp = date("Y-m-d H:i:s");
        $from_email = $_SESSION["username"];
        $q= "INSERT INTO notes (id,subject,email, Created_at) VALUES ('".$from_email."','".$subject."','".$body."','".$timestamp."')";

    if(mysqli_query($con, $q)){
      echo "Note Saved!";
    }
      }

    ?>


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


    $sql = "SELECT * FROM notes WHERE id = '$_SESSION[username]'";
    $result = $conn->query($sql);

    echo "<div style='margin-left:auto;margin-right:auto;width:850px;height:auto;border:2px solid red;'>";

    echo "<table style='margin-left:auto;margin-right:auto'; border='1'; width='840'>";
    echo "<tr><th>Subject </th><th>Note </th><th>Timestamp";

      while($row = $result->fetch_assoc())
      {
            echo "<tr>";
    	    echo "<form method='post'>";
            echo "<td>".$row["subject"]."</td>";
            echo "<td>".$row["email"]."</td>";
    	    echo "<td>".$row["Created_at"]."</td>";
    	    echo "</tr>";
    	}
    	echo "</table>";



    ?>




	<p>
        <a href="mainhomepage.php" class="btn btn-danger">Return to App Select</a>
    </p>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>

</html>
