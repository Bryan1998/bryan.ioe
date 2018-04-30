<?php
session_start();

include 'inc/db/db.php';

if(!isset($_POST['message'])) {
	$message = null;
} else {
	$message = $_SESSION['username'] . ": " . $_POST['message'];
}
if (!isset($change)) {
	$change = '0';
}
if($message != "") {
	$sql = "INSERT INTO `chat` VALUES('','$message')";
	$mysqli->query($sql);
	$change = '1';
}

echo $change;

$sql = "SELECT `text` FROM `chat` ORDER BY `id` DESC";
$result = $mysqli->query($sql);

echo "\u{200C}";

while($row = $result->fetch_array()) {
	echo $row['text']."\n";
}
?>
