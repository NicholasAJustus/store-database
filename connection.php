<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";


$con = mysqli_connect($server, $username, $password, $dbname, 3307);

if ($con->connect_error){
  die("Failed to connect: " . $con->connect_error);
}

?>
