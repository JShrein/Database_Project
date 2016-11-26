<?php
session_start();
include_once('header.php');
include_once('mysql_func.php');

$_SESSION['user_id'] = 1;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Twitter Clone</title>
</head>

<body>
<?php
if(isset($_SESSION['message'])) {
	echo "<b>".$_SESSION['message']."</b>";
	unset($_SESSION['message']);
}
?>

<form method='post' action='add.php'>
<p>Your status:</p>
<textarea name='content' rows='5' cols='40' wrap=VIRTUAL></textarea>
<p><input type='submit' value='submit' /></p
</form>

</body>
</html>