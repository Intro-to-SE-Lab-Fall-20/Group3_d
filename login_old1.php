<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: homepage.php");
    exit;
}

require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";
$atmp =3;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	

	
    if(empty(trim($_POST["username"])))
	{
        $username_err = "Please enter your username.";
    } 
	
	else
	{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"])))
	{
        $password_err = "Please enter your password.";
    }
	
	else
	{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err))
	{
		$atmp = $_POST['hidden'];
		if ($atmp > 0){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql))
		{
            mysqli_stmt_bind_param($stmt, "s", $p_user);

            $p_user = $username;

            if(mysqli_stmt_execute($stmt))
			{
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1)
				{
                    mysqli_stmt_bind_result($stmt, $id, $username, $hash_pass);
					
                    if(mysqli_stmt_fetch($stmt))
					{
                        if(password_verify($password, $hash_pass))
						{
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: homepage.php");
                        }
						
						else
						{
							$atmp--;
                            $password_err = "The password you entered is incorrect. You have " .$atmp.  " attempts.";
                        }
                    }
                }
				
				else
				{	
					$atmp--;
                    $username_err = "That email account is not currently registered. You have " .$atmp.  " attempts.";
                }
            }
			
			else
			{	$atmp--;
                echo "An error has ocurred, please try again. You have " .$atmp.  " attempts. ";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if ($atmp == 0) {
    	$password_err = "Login Limit Exceeded. Refresh the page to start over!! ";
    }
	
    mysqli_close($link);

}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .textbox{ width: 400px; padding: 25px; align-items: center;}
    </style>
</head>
<body>
    <div class="textbox">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        	<?php
        	echo "<input type='hidden' name='hidden'  value='".$atmp."'>";
        	?>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" 
                <?php if ($atmp == 0) { ?> disabled = "disabled"
            <?php } ?>
                 class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" 
                  <?php if ($atmp == 0) { ?> disabled = "disabled"
            	<?php } ?>
                class="btn btn-primary" value="Login">
            </div>
            <p><a href="register.php">Create Account.</a></p>
        </form>
    </div>
</body>
</html>
