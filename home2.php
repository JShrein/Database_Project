<?php
include_once('header.php');
include_once('dbhandler.php');
include_once('mysql_func.php');
$thisPage="Home";
include("navigation.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Twitter Chatter - Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="content-wrapper content-wrapper_home">
		<div class="content">

			<?php
				if(!isset($_SESSION['user_id'])) {
					header("Location: index.php");
				}
			?>
			<form action="logout.php">
				<input class="btn btn-secondary btn-logout" id="authbtn" type="submit" value="Logout">
			</form>
			<?php
				if(isset($_SESSION['message'])) {
					echo "<p id='phpmsg'>".$_SESSION['message']."</p>";
					unset($_SESSION['message']);
				}
			?>

			<div id="profile">
				<div class="profile-left">
					<div class="module module_picture">
						<img src="http://writedirection.com/website/wp-content/uploads/2016/09/blank-profile-picture-973460_960_720.png">
					</div>
					<div class="module module_biography">
						<span>Biography</span>
						<div>A biography, or simply bio, is a detailed description of a person's life. It involves more than just the basic facts like education, work, relationships, and death; it portrays a person's experience of these life events.</div>
					</div>
					<div class="module module_following">
						<span>Following</span>
						<?php
							$users = show_users($link, $_SESSION['user_id']);

							if(count($users)) {
								$followers = array();
								foreach($users as $user) {
									$followers[] = $user['user_id'];
								}
							} else {
								$followers = array();
							}

							$followers[] = $_SESSION['user_id'];
						?>
						<ul>
							<?php
								foreach($users as $user) {
									echo "<li>".$user['username']."</li>\n";
								}
							?>
						</ul>
						<?php
							if(!count($followers)) {
						?>
								<p><b>You're not following anyone!</b></p>
						<?php
							}
						?>
					</div>
				</div>
				<div class="profile-middle">
					<div class="module">
						<form class="form form_addPost" method='post' action='add.php'>
							<div class="form-row">
								<p>Your status:</p>
							</div>
							<div class="form-row">
								<textarea class="input-txtarea" name='content' rows='5' cols='40' wrap=VIRTUAL></textarea>
								<input type='submit' class="btn btn-primary" value='submit' />
							</div>
						</form>
					</div>

					<?php
						$posts = show_posts($link, $followers, 15);
						if(count($posts)) {
					?>
							<div class="module">
								<table class="post-list" border='1' cellspacing='0' cellpadding='5' width='500'>
									<?php
										foreach ($posts as $key => $values) {
											$likes = get_likes($link, $values['post_id']);
											echo "<tr valign='middle'>\n";
											echo "<td>".$values['username'] ."</td>\n";
											echo "<td>".$values['content'] ."<br />\n";
											echo "<small>".$values['time_stamp'] ."</small></td>\n";
											echo "<td><a href='like.php?pid=".$values['post_id']."&do=like'>Like ".$likes."</a></td><br>\n";
											//echo "<a href='comment.php?uid=".$_SESSION['user_id']."&pid=".$values['post_id']."&do=comment'>Comment</a></td>\n";
											echo "</tr>\n";
											echo "<tr valign='middle'>\n";
									?>
											<table>
											<?php
											$comments = show_comments($link, $values['post_id']);
												foreach($comments as $k => $v) {
													echo "<tr valign='middle'>\n";
													echo "<td>".$v['username'] ."</br>\n";
													echo "".$v['comment'] ."<br /></td>\n";
													echo "</tr>\n";
													echo "<tr valign='middle'>\n";
													echo "<td>\n";
											?>
													<form method='post' action='comment.php'>
															<?php
															echo "<input type='hidden' name='uid' value='".$_SESSION['user_id']."'/>\n";
															echo "<input type='hidden' name='pid' value='".$values['post_id']."'/>\n";
															?>
															<textarea class="input-txtarea" name='comment' rows='2' cols='40' wrap=VIRTUAL placeholder="Enter a comment"></textarea>
															<input type='submit' class="btn btn-primary" value='submit' />
													</form>
											<?php
													echo "</td></tr>\n";
												}
											?>
											</table>
									<?php
											echo "</tr>\n";
										}
									?>
								</table>
							</div>
					<?php
						} else {
					?>
							<div class="module">
								<p><b>You haven't made any posts!</b></p>
							</div>
					<?php
						}
					?>
				</div>
				<div class="profile-rigth">
					<div class="module module_copyright">
						<div>© Twitter Chatter Developed And Designed By John Shrein And Parya Zareie Project For Course Database Fall 2016</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>