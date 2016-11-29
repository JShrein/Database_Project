<?php
include_once('header.php');
include_once('dbhandler.php');
include_once('mysql_func.php');

$user_id = $_SESSION['user_id'];
$content = $_POST['content'];

add_post($link, $user_id, $content);
$_SESSION['message'] = "Your post was added!";

//header("Location:home.php");
?>