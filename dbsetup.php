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
$sql = "CREATE DATABASE demo";
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error creating database: " . $conn->error;
}

// closing connection
$conn->close();

$link = mysqli_connect("localhost", "root", "", "demo");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$sql = "CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
if(mysqli_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "CREATE TABLE emails (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    sender VARCHAR(50) NOT NULL,
    recipient VARCHAR(50) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    email VARCHAR(4000) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
if(mysqli_query($link, $sql)){
    echo "Table emails created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "CREATE TABLE trash (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    sender VARCHAR(50) NOT NULL,
    recipient VARCHAR(50) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    email VARCHAR(4000) NOT NULL,
    Deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
  

if(mysqli_query($link, $sql)){
    echo "Table trash created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>
