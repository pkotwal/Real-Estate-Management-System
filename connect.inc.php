<?php
$servername = "localhost";
$username = "root";
$password = "";
$database= "real_estate";

$con=mysqli_connect($servername,$username,$password,$database);
error_reporting(0);

if(!$con){
	die('Could not connect to database. Please try again later.');
}
?> 