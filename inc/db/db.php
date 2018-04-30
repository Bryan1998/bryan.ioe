<?php
$hostname = "localhost";
$username = "stream";
$password = "****";
$database = "stream";

//Connect to MySQL
$mysqli = new mysqli($hostname, $username, $password, $database);
//Check if connection failed
if (!$mysqli) {
	die($mysqli->error);
}
?>
