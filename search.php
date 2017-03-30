<?php
// This is the frontent for searching
// See search.php for backend
include_once('header.php');
include_once('dbhandler.php');
include_once('mysql_func.php');
$thisPage="search";
include("navigation.php");

if(isset($_POST['submit'])) {
	$query = $_POST['searchterm'];
	$users = search_users($link, $query);
} else {
	$users = array();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Twitter Chatter - Search for Users</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="content-wrapper content-wrapper_search">
		<div class="content content_users">
			<h3>User Search</h3>
			<p>Use username or email to search</p>
			<form action="" method="POST">
				<input class="search-input input-txt" type="text" name="searchterm">
				<input class="btn btn-primary" type="submit" name="submit" value="Search">
			</form>
			<?php
				if(count($users)) {
			?>
				<div class="module">
					<table class="search-list" cellspacing='0' cellpadding='0'>
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
				</div>
			<?php
				} else {
					if(isset($_SESSION['searcherr'])) {
						echo "<div class='module'><p><b>".$_SESSION['searcherr']."</b></p></div>";
					}
				}
			?>
		</div>
	</div>
</body>
</html>