<?php
include_once('header.php');
include_once('dbhandler.php');
include_once('mysql_func.php');

$post_id = $_GET['pid'];
$action = $_GET['do'];

add_like($link, $post_id);
$_SESSION['message'] = "Your liked a post!";

header("Location:home.php");
?>