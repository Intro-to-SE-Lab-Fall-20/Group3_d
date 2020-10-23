<?php
session_start();

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


if(isset($_POST['delete'])) 
{
foreach($_POST['ch'] as $v)
{
echo $v;

    $sql="SELECT * FROM emails where recipient='$_SESSION[username]@email.com' and id='$v'";
    $result = $conn->query($sql);

    echo $sql;

    while($row = $result->fetch_assoc())
	{
	    $rec=$row['recipient'];
	    $sen=$row['sender'];
	    $sub=$row['subject'];
	    $msg=$row['email'];
	    //store into trash table
	    //mysqli_query("insert into trash values('','$rec','$sen','$sub','$msg',now())");
        $sql1 = "INSERT INTO trash (sender,recipient,subject,email) VALUES ('".$sen."','".$rec."','".$sub."','".$msg."')";
        if ($conn->query($sql1) === TRUE) {
            echo "<script>alert('Message deleted');window.location='HomePage.php?chk=inbox'</script>";
         }
	    //delete form inbox
	
	    $sql2 = "DELETE FROM emails WHERE recipient='$_SESSION[username]@email.com' and id='$v'";
        if ($conn->query($sql2) === TRUE) {
            echo "<script>alert('Message deleted');window.location='HomePage.php?chk=inbox'</script>";
         }
	}
	

}
}

if(isset($_POST['send_delete'])) 
{
foreach($_POST['ch'] as $v)
{
echo $v;

    $sql="SELECT * FROM emails where sender='$_SESSION[username]@email.com' and id='$v'";
    $result = $conn->query($sql);


    while($row = $result->fetch_assoc())
	{
	    $rec=$row['recipient'];
	    $sen=$row['sender'];
	    $sub=$row['subject'];
	    $msg=$row['email'];
	    //store into trash table
	    //mysqli_query("insert into trash values('','$rec','$sen','$sub','$msg',now())");
        $sql1 = "INSERT INTO trash (sender,recipient,subject,email) VALUES ('".$sen."','".$rec."','".$sub."','".$msg."')";
        if ($conn->query($sql1) === TRUE) {
            echo "<script>alert('Message deleted');window.location='HomePage.php?chk=inbox'</script>";
         }
	    //delete form inbox
	
	    $sql2 = "DELETE FROM emails WHERE sender='$_SESSION[username]@email.com' and id='$v'";
        if ($conn->query($sql2) === TRUE) {
            echo "<script>alert('Message deleted');window.location='HomePage.php?chk=inbox'</script>";
         }
	}
	

}
}


if(isset($_POST['forward'])) 
{
foreach($_POST['ch'] as $v)
{
echo $v;

    $sql="SELECT * FROM emails where recipient='$_SESSION[username]@email.com' and id='$v'";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc())
	{
	    $rec=$row['recipient'];
	    $sen=$row['sender'];
	    $sub=$row['subject'];
	    $msg=$row['email'];
	    $to_email=$_POST['to_email'];
	    //store into trash table
	    //mysqli_query("insert into trash values('','$rec','$sen','$sub','$msg',now())");
        $q = "INSERT INTO emails (sender,recipient,subject,email) VALUES ('".$rec."','".$to_email."','".$sub."','".$msg."')";
         if( mysqli_query($con, $q)) {
            echo "<script>alert('Message Forwarded');window.location='HomePage.php?chk=inbox'</script>";
         }

	}
	
}
}
$conn->close();
?>