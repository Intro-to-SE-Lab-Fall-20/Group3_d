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
 if(isset ($_POST['Submit'])){
    $body =$_POST['body'];
    $to_email=$_POST['to_email'];
    $from_email=$_POST['from_email'];
    $subject=$_POST['subject'];
    $q= "INSERT INTO message (subject,body,to_email,from_email) VALUES ('".$subject."','".$body."','".$to_email."','".$from_email."')";
    if( mysqli_query($con, $q)) {
    $to = $to_email;
    $subject = $subject;
    $body = $body;
    $headers = $from_email;
    mail($to, $subject, $body, $headers);
    }

  }
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
        body{ font: 12px sans-serif; text-align: center; }
    </style>
</head>

<body>
    <div class="page-header">
        <h1>Hi, <?php echo $_SESSION["username"]; ?>.</h1>
    </div>
    <div class="container bootdey">
    <div class="email-app">
        <button data-toggle="collapse" data-target="#demo" class="btn btn-danger btn-block mb-4">New Email</button>
            <div id="demo" class="collapse">
        <main>
            <form method="post">
                <div class="form-row mb-3">
                    <label for="to" class="col-2 col-sm-1 col-form-label">To:</label>
                    <div class="col-10 col-sm-11">
                        <input type="email" name="to_email" class="form-control" id="to" placeholder="Type email">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <label for="cc" class="col-2 col-sm-1 col-form-label">From:</label>
                    <div class="col-10 col-sm-11">
                        <input type="email" name="from_email" class="form-control" id="from" placeholder="Type email">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <label for="cc" class="col-2 col-sm-1 col-form-label">Subject</label>
                    <div class="col-10 col-sm-11">
                        <input type="text" name="subject" class="form-control" id="from" placeholder="Type subject">
                    </div>
                </div>


            <div class="row">
                <div class="col-sm-11 ml-auto">
                    <div class="form-group mt-4">
                        <textarea class="form-control" id="message" name="body" rows="12" placeholder="Click here to reply"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="Submit" class="btn btn-success">Send</button>
                    </div>
            </div>
        </form>
        </main>
    </div>
    </div>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>
