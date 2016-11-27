<?php
	include_once('header.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>User Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="authform">
			<form action="register.php" method="POST">
				<input id="authinput" type="text" name="first" placeholder="First Name"><br>
				<input id="authinput" type="text" name="last" placeholder="Last Name"><br>
				<input id="authinput" type="text" name="email" placeholder="Email Address"><br>
				<input id="authinput" type="text" name="uname" placeholder="Username"><br>
				<input id="authinput" type="password" name="pass" placeholder="Password"><br>
				<input id="authbtn" type="submit" value="Register"><br>
			</form>
		</div>
		<?php
			if(isset($_SESSION['regerr'])) {
				echo $_SESSION['regerr'];
				unset($_SESSION['regerr']);
			}
		?>
	</body>
</html>