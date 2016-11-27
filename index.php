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
	<a href='registration.php'>Register</a>

		<form action="login.php" method="POST">
			<input id="authinput" type="text" name="email" placeholder="Email Address"><br>
			<input id="authinput" type="password" name="pass" placeholder="Password"><br>
			<input id="authbtn" type="submit" value="Login"><br>
		</form>

		<?php
			if(isset($_SESSION['autherr'])) {
				echo $_SESSION['autherr'];
				unset($_SESSION['autherr']);
			}
		?>
	</body>
</html>