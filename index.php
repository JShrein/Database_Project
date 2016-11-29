<?php
	include_once('header.php');
	$thisPage="Index";
	include("navigation.php");
?>

<!DOCTYPE html>
<?php $thisPage="About Us"; ?>
<html>
	<head>
		<title>Twitter Chatter - User Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="content-wrapper">
			<div class="form-wrapper">
				<form action="login.php" method="POST" class="form form_login">
					<div class="form-row">
						<label>Username</label>
						<input class="authinput input-txt" type="text" name="email" placeholder="Email Address" />
					</div>
					<div class="form-row">
						<label>Password</label>
						<input class="authinput input-txt" type="password" name="pass" placeholder="Password" />
					</div>
					<div class="form-row">
						<input id="authbtn" class="btn btn-primary btn-login" type="submit" value="Login" />
					</div>
					<div class="form-row">
						<span>Don't have an account? </span><a href='registration.php' class="link">Sign up</a>
					</div>
					<div class="error">
						<?php
							if(isset($_SESSION['autherr'])) {
								echo $_SESSION['autherr'];
								unset($_SESSION['autherr']);
							}
						?>
					</div>
				</form>
			</div>
		</div>

		<?php
			if(isset($_SESSION['autherr'])) {
				echo $_SESSION['autherr'];
				unset($_SESSION['autherr']);
			}
		?>
	</body>
</html>