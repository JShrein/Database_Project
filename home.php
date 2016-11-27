<?php
include_once('header.php');
include_once('dbhandler.php');
include_once('mysql_func.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Twitter Clone</title>
</head>

<body>
	<?php
	if(!isset($_SESSION['user_id'])) {
		header("Location: index.php");
	}
	?>
	<form action="logout.php">
		<input id="authbtn" type="submit" value="Logout">
	</form>

	<?php
	if(isset($_SESSION['message'])) {
		echo "<p id='phpmsg'>".$_SESSION['message']."</p>";
		unset($_SESSION['message']);
	}
	?>

	<form method='post' action='add.php'>
	<p>Your status:</p>
	<textarea name='content' rows='5' cols='40' wrap=VIRTUAL></textarea>
	<p><input type='submit' value='submit' /></p
	</form>

	<?php
	$posts = show_posts($link, $_SESSION['user_id']);

	if(count($posts)) {
	?>
		<table border='1' cellspacing='0' cellpadding='5' width='500'>
	<?php
		foreach ($posts as $key => $values) {
			echo "<tr valign='top'>\n";
			echo "<td>".$values['username'] ."</td>\n";
			echo "<td>".$values['content'] ."<br />\n";
			echo "<small>".$values['time_stamp'] ."</small></td>\n";
			echo "</tr>\n";
		}
	?>
		</table>
	<?php
	} else {
	?>
	<p><b>You haven't made any posts!</b></p>
	<?php
	}
	?>

</body>
</html>