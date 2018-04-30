<?php
session_start();

include 'inc/functions.php';

$user = sanitize_input($_POST['username']) ?? null;
$email = sanitize_input($_POST['email']) ?? null;

$sql = "SELECT * FROM `users` WHERE user_email = '$email';";
$result = $mysqli->query($sql);
if ($result->num_rows) {
	alert('Email already used');
} else {
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];

	if ($password == $password_confirm) {
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$sql = "INSERT INTO `users` (user_name, user_pass, user_email) VALUES ('$user', '$password', '$email');";
		$mysqli->query($sql);
	} else {
		alert('Passwords do not match');
	}
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
