<?php
include_once('header.php');
include_once('dbhandler.php');

$email = $_POST['email'];
$pass = $_POST['pass'];

$sqlcmd = "SELECT *
			FROM users 
			WHERE email='$email' AND password='$pass'";

$result = mysqli_query($link, $sqlcmd);

// If no result from DB
if(!$row = mysqli_fetch_assoc($result)) {
	$_SESSION['autherr'] = "Your email address or password is incorrect!";
	header("Location: index.php");
} else {
	$_SESSION['user_id'] = $row['user_id'];
	$_SESSION['username'] = $row['username'];
	header("Location: home.php");
}
?>