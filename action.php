<?php
include_once("header.php");
include_once("dbhandler.php");
include_once("mysql_func.php");

$user_id = $_GET['id'];
$action = $_GET['do'];
$uname = $_GET['uname'];

switch($action) {
	case "follow":
		follow_user($link, $_SESSION['user_id'], $user_id);
		$msg = "You are now following ".$uname."!";
		break;
	case "unfollow":
		unfollow_user($link, $_SESSION['user_id'], $user_id);
		$msg = "You stopped following ".$uname."!";
		break;
}
$_SESSION['message'] = $msg;

header("Location: home.php");
?>