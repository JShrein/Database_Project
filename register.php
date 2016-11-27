<?php
include_once('header.php');
include_once('dbhandler.php');

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$status = "active";

if($first == "" || $last == "" || $email == "" || $uname == "" || $pass == "") {
	$_SESSION['regerr'] = "Please complete the registration form.";
	header("Location: registration.php");
} else {
	$sqlcmd = "INSERT INTO users (firstname, lastname, email, username, password) 
				VALUES ('$first', '$last', '$email', '$uname', '$pass')";

	$result = mysqli_query($link, $sqlcmd);

	if(mysqli_errno($link) == $MYSQL_DUPLICATE_KEY) {
		$_SESSION['regerr'] = "An account with this email address already exists";
		header("Location: registration.php");
	} else {
		header("Location: index.php");
	}
}
?>