<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <title>Send Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 12px sans-serif; text-align: center; background-image:url('background.jpg');}
        table.center{
          margin-left: auto;
          margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="page-header">
        <h1>Hi, <?php echo $_SESSION["username"]; ?>.</h1>
        <h2>Welcome to Group3 mail</h2>
    </div>

	 </div>
    <tr>
    <td width="158" height="572" valign="top">
	<div style="margin-top:50px; color:red">
    <a href="homepage.php?chk=compose" class="btn btn-primary">COMPOSE</a><br/><br/>
	<a href="homepage.php?chk=inbox" class="btn btn-primary">INBOX</a><br/><br/>
	<a href="homepage.php?chk=sent" class="btn btn-primary">SENT</a><br/><br/>
	<a href="homepage.php?chk=trash" class="btn btn-primary">TRASH</a><br/><br/>
    <a href="homepage.php?chk=search" class="btn btn-primary">Search Email</a><br/><br/>
	
	
	</div>
	</td>
    <td width="660" valign="top">
			
			
		<?php
		
		@$chk=$_REQUEST['chk'];
			
			if($chk=="compose")
			{
			include_once('email.php');
			}
			if($chk=="sent")
			{
			include_once('sent.php');
			}
			if($chk=="trash")
			{
			include_once('trash.php');
			}
			if($chk=="inbox")
			{
			include_once('inbox.php');
			}
            if($chk=="search")
			{
			include_once('search.php');
			}
			
		?>
		
		<!--inbox -->

		
	</td>
    <td width="135">&nbsp;</td>
  </tr>
    <?php



?>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>
