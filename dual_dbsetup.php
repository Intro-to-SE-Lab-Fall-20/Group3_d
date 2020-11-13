<?php
$servername = "localhost";
$username = "root";
$password = "";

// Creating a connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Creating a database named newDB
$sql = "CREATE DATABASE dual_demo";
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error creating database: " . $conn->error;
}

// closing connection
$conn->close();

$link = mysqli_connect("localhost", "root", "", "dual_demo");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$sql = "CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if(mysqli_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$hash_pass = password_hash('Abc123!', PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('demo', '$hash_pass')";

if(mysqli_query($link, $sql)){
    echo "User added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>