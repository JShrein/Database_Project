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
		<div class="form-wrapper">
			<form action="login.php" method="POST" class="form form_login">
				<div class="form-element">
					<label>Username</label>
					<input class="authinput input-txt" type="text" name="email" placeholder="Email Address" />
				</div>
				<div class="form-element">
					<label>Password</label>
					<input class="authinput input-txt" type="password" name="pass" placeholder="Password" />
				</div>
				<div class="form-element">
					<input id="authbtn" class="btn btn-primary" type="submit" value="Login" />
				</div>
				<div class="form-element">
					<label>Don't have an account? </label><a href='registration.php' class="link">Sign up</a>
				</div>
			</form>
		</div>

		<?php
			if(isset($_SESSION['autherr'])) {
				echo $_SESSION['autherr'];
				unset($_SESSION['autherr']);
			}
		?>
	</body>
</html>