<?php
function add_post($link, $user_id, $content) {
	$sqlcmd = "INSERT INTO posts(user_id, content, time_stamp)
				VALUES($user_id, '".mysql_real_escape_string($content). "', now())";
	$result = mysqli_query($link, $sqlcmd);
}

function show_posts($link, $user_id) {
	$posts = array();

	$sqlcmd = "SELECT u.username, p.content, p.time_stamp
				FROM posts as p, users as u
				WHERE u.user_id = '$user_id' 
				ORDER BY time_stamp DESC";

	$result = mysqli_query($link, $sqlcmd);

	while($data = mysqli_fetch_object($result)) {
		$posts[] = ['time_stamp' => $data->time_stamp,
					'user_id' => $user_id,
					'username' => $data->username,
					'content' => $data->content];
	}

	return $posts;
}

function show_users($link) {
	$users = array();
	$sqlcmd = "SELECT user_id, username, email 
				FROM users 
				WHERE status='active'
				ORDER BY username";
	$result = mysqli_query($link, $sqlcmd);

	while($data = mysqli_fetch_object($result)) {
		$users[] = ['$user_id' => $data->user_id,
					'username' => $data->username,
				    'email' => $data->email];
	}

	return $users;
}

// Search term may be all or part of a username or email
function search_users($link, $term) {
	$found = array();
	$users = show_users($link);
	$lowerterm = strtolower($term);

	foreach($users as $key => $user) {
		$keys = array_keys($user);
		$username = $user[$keys[0]];
		$email = $user[$keys[1]];
		
		if(strpos(strtolower($username), strtolower($term)) !== false || 
		   strpos(strtolower($email), strtolower($term)) !== false) {
			
			$found[] = $user;
		}
	}

	return $found;
}
?>