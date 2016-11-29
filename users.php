<?php
include_once('header.php');
include_once('dbhandler.php');
include_once('mysql_func.php');
$thisPage="Users";
include("navigation.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Twitter Chatter - List Users</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="content-wrapper content-wrapper_users">
		<div class="content content_users">
			<?php
				if(!isset($_SESSION['user_id'])) {
					$_SESSION['autherr'] = "You must be signed in to view this page";
					header("Location: index.php");
				}
			?>
			<form action="logout.php">
				<input class="btn btn-secondary btn-logout" id="authbtn" type="submit" value="Logout">
			</form>
			
			<h3>User List</h3>
			<?php
				$users = show_users($link);
				$following = following($link, $_SESSION['user_id']);
				if(count($users)) {
			?>
					<div class="module">
						<table class="user-list" cellspacing='0' cellpadding='0'>
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
					</div>
			<?php
				} else {
			?>
					<div class="module">
						<p><b>No users exist!</b></p>
					</div>
			<?php
				}
			?>
		</div>
	</div>
</body>
</html>