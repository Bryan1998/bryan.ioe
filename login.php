<?php
session_start();

include 'inc/functions.php';

$user = sanitize_input($_POST['username']) ?? null;

$sql = "SELECT user_name FROM `users` WHERE user_name = '$user';";
$result = $mysqli->query($sql);

if (!$result->num_rows) {
	alert('Login invalid');
} else {
	$sql = "SELECT user_pass FROM `users` WHERE user_name = '$user';";
	$result = $mysqli->query($sql);
	while ($obj = $result->fetch_object()) {
		$row = $obj->user_pass;
	}
	if (password_verify($_POST['password'], $row)) {
		$_SESSION['username'] = $user;
	} else {
		alert('Password invalid');
	}
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
