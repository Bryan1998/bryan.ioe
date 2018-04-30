<?php
include 'db/db.php';

function get_age($year, $month, $day) {
    $date = "$year-$month-$day";
    $dob = new DateTime($date);
    $now = new DateTime();

    return $now->diff($dob)->y;
    $difference = time() - strtotime($date);
    return floor($difference / 31556926);
}

function sanitize_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '");</script>';
}
?>
