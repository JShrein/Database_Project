<?php
session_start();
include_once('header.php');
include_once('mysql_func.php');

$user_id = $_SESSION['user_id'];
$content = substr($_POST['content'], 0, 150);

add_post($link, $user_id, $content);
$_SESSION['message'] = "Your post was added!";

header("Location:index.php");
?>