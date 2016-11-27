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
	<?php
		if(!isset($_SESSION['user_id'])) {
			$_SESSION['autherr'] = "You must be signed in to view this page";
			header("Location: index.php");
		}
	?>
	<h1>User List</h1>
	<?php
		$users = show_users($link);
		$following = following($link, $_SESSION['user_id']);
		if(count($users)) {
	?>
	<table border='1' cellspacing='0' cellpadding='0' width='500'>
		<?php
			foreach($users as $user) {

				echo "<tr valign='top'>\n";
				echo "<td>".$user['username'] ."</td>\n";
				echo "<td>".$user['email'] ."</td>\n";
				echo "<td>";
				if(in_array($user['user_id'], $following)) {
					echo "<small><a href='action.php?id=".$user['user_id']."&uname=".$user['username']."&do=unfollow'>Unfollow</a></small>\n";
				} else {
					echo "<small><a href='action.php?id=".$user['user_id']."&uname=".$user['username']."&do=follow'>Follow</a></small>\n";
				}
				echo "</td>\n";
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