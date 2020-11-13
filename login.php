<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: homepage.php");
    exit;
}

require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";
$wrong_count = 0;
if (isset($_SESSION['wrong_count'])) {
    $wrong_count = $_SESSION['wrong_count'];
}

if (isset($_SESSION['last_hit'])) {
    $last_hit = $_SESSION['last_hit'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $p_user);

            $p_user = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hash_pass);

                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hash_pass)) {
                            session_start();
                            $wrong_count = $_SESSION['wrong_count'] = 0;
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: homepage.php");
                        } else {
                            $wrong_count = $_SESSION['wrong_count'] = $wrong_count + 1;
                            $last_hit = $_SESSION['last_hit'] = time();
                            $password_err = "The password you entered is incorrect.";
                        }
                    }
                } else {
                    $username_err = "That email account is not currently registered.";
                }
            } else {
                echo "An error has ocurred, please try again.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .textbox {
            width: 400px;
            padding: 25px;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="textbox">
        <h2>Login</h2>
        <p>Please fill in your credentials to login to your email account.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
                <span id="timer" class='help-block'></span>
            </div>
            <div class="form-group">
                <input id="login" type="submit" class="btn btn-primary" value="Login">
            </div>
            <p><a href="register.php">Create Account.</a></p>
        </form>

        <script>
            <?php if (isset($last_hit) && isset($wrong_count)) : ?>

                var last_hit = <?php echo $last_hit; ?>;
                var wrong_count = <?php echo $wrong_count ?>;
                if (wrong_count > 3) { 
                    var interval = 40;

                    var next_hit = last_hit + interval * 1000;
                    function checker() {
                        var now = Date.now() / 1000;
                        var diff = Math.floor(interval - (now - last_hit));
                        var i = document.getElementById("timer");
                        var btn = document.getElementById("login");

                        if (diff < 0) {
                            clearInterval(p);
                            i.innerText = "";
                            btn.removeAttribute("disabled");
                            return;
                        }
                        var text = "Try again after " + diff + "seconds.";
                        i.innerText = text;
                        btn.setAttribute("disabled", "disabled");

                    }
                    checker();
                    p = setInterval(checker, 1000);
                }



            <?php endif; ?>
        </script>
    </div>
</body>

</html>