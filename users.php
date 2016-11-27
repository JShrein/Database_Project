<?php
include_once('header.php');
include_once('dbhandler.php');
include_once('mysql_func.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
</head>

<body>
	<h1>User List</h1>
	<?php
		$users = show_users($link);
		if(count($users)) {
	?>
	<table border='1' cellspacing='0' cellpadding='0' width='500'>
		<?php
			foreach($users as $user) {

				echo "<tr valign='top'>\n";
				echo "<td>".$user['username'] ."</td>\n";
				echo "<td>".$user['email'] ."</td>\n";
				echo "<td><small><a href='#'>Follow</a></small></td>\n";
				echo "</tr>\n";
			}
		?>
	</table>
	<?php
		} else {
	?>
	<p><b>No users exist!</b></p>
	<?php
		}
	?>
</body>
</html>