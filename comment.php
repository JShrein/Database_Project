<?php
include_once('header.php');
include_once('dbhandler.php');
include_once('mysql_func.php');

$user_id = $_POST['uid'];
$post_id = $_POST['pid'];
$content = $_POST['comment'];

add_comment($link, $user_id, $post_id, $content);
$_SESSION['message'] = "Your comment was added!";

header("Location:home2.php");
?>