<!DOCTYPE html>
<html>

<head>
    <style>
        h1{ color: green;}
        h1{font-size: 50px;}
    </style>
</head>

<body style="text-align:center;">

    <h1 style="color:green;">
        Group3's Applications
    </h1>

    <form method="post">

        <a href="http://localhost/Group3ProjectLOCAL/login.php">
            <img src="email.png" alt="Email"></a>

            <a href="http://localhost/Group3ProjectLOCAL/notes.php">
              <img alt="Note" width="348" height="230"
               src="note.png"> </a>

    </form>
    <?php
    /*$chk = $_REQUEST['chk'];

    if($chk=="compose")
    {
    include_once('compose.php');
    }

    if(array_key_exists('Email', $_POST)) {
        button1();
    }
    else if(array_key_exists('Note', $_POST)) {
     button2();
    }
    function button1() {
        echo "This is Button1 that is selected";
    }
    function button2() {
        echo "This is Button2 that is selected";
    }*/
    ?>

<p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

</head>

</html>
