<?php

function add_post($client, $email, $content) {
	$tstamp = date('Y-m-d G:i:s');
	$query = "
	MATCH (u:User)
	WHERE u.email = '$email'
	CREATE (
		p:Post
		{
			content: '$content',
			timestamp: '$tstamp'
		}
	)<-[:POSTED]-(u)";

	try {
		$results = $client->run($query);
	} catch(Neo4jException $e) {

	}

}

function add_user($client, $first, $last, $uname, $pass, $email, $status) {
	$query = "CREATE (
		u:User
		{
			first: '$first',
			last: '$last',
			uname: '$uname',
			pass: '$pass',
			email: '$email',
			status: '$status'
		}
	)";

	try {
		$results = $client->run($query);
	} catch(Neo4jException $e) {
		$errcode $e->getCode();
		if($errcode == 0) {
			$_SESSION['regerr'] = "An account with this email address already exists.";
			header("Location: registration.php");
		} else {
			$_SESSION['regerr'] = "A database error prevented this account from being created.";
			header("Location: registration.php");
		}
	}

	header("Location: index.php");
}


// $user_id is an array of users to pull posts from
function show_posts($client, $emails, $limit=0) {
	$posts = array();

	$users = implode(',', $emails);
	$sqlext = "";

	if ($limit > 0) {
		$sqlext = "LIMIT $limit";
	} else {
		$sqlext = "";
	}

	$query = "MATCH (User)-[:POSTED]->(Post)
			  WHERE User.email IN [$users]
			  RETURN User.uname as username, User.email as email, Post.content as content, Post.timestamp as timestamp
			  ORDER BY timestamp DESC $sqlext";

	try {
		$results = $client->run($query);

		foreach($results->getRecords() as $record) {
			$posts[] = ['timestamp' => $record->value('timestamp'),
						'email' => $record->value('email'),
						'username' => $record->value('username'),
						'content' => $$record->value('content')];
		}
	} catch(Neo4jException $e) {
		$err = $e->getMessage();
		$_SESSION['posterr'] = "Post retrieval failed with message ".$err;
	}

	return $posts;
}

function show_users($client, $user_id=0) {
	$sqlext = "";

	if($user_id > 0) {
		$followers = array();
		$sqlcmd = "SELECT user_id
					FROM following
					WHERE follower_id='$user_id'";
		
		$result = mysqli_query($link, $sqlcmd);

		while($data = mysqli_fetch_object($result)) {
			array_push($followers, $data->user_id);
		}

		if(count($followers)) {
			$ids = implode(',', $followers);
			$sqlext = " AND user_id IN ($ids)";
		} else {
			return array();
		}
	}

	$users = array();
	$sqlcmd = "SELECT user_id, username, email 
				FROM users 
				WHERE status='active' $sqlext
				ORDER BY username";

	$result = mysqli_query($link, $sqlcmd);

	while($data = mysqli_fetch_object($result)) {
		$users[] = ['user_id' => $data->user_id,
					'username' => $data->username,
				    'email' => $data->email];
	}

	return $users;
}

// Search term may be all or part of a username or email
function search_users($client, $term) {
	$found = array();
	if(!$term == "")
	{
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
		if(count($found) == 0)
		{
			$_SESSION['searcherr'] = "We were unable to find any users that match that name!";
		}
	} else {
		$_SESSION['searcherr'] = "Please enter a search string!";
	}

	return $found;
}

function following($client, $user_id) {
	$users = array();

	$sqlcmd = "SELECT DISTINCT user_id
				FROM following
				WHERE follower_id = '$user_id'";

	$result = mysqli_query($link, $sqlcmd);

	while($data = mysqli_fetch_object($result)) {
		array_push($users, $data->user_id);
	}

	return $users;
}

function check_follow_count($client, $follower, $followed) {
	$sqlcmd = "SELECT count(*)
				FROM following
				WHERE user_id='$followed' AND follower_id='$follower'";
	$result = mysqli_query($link, $sqlcmd);

	$row = mysqli_fetch_row($result);

	return $row[0];
}

function follow_user($client, $follower, $followed) {
	$count = check_follow_count($follower, $followed);

	if($count == 0) {
		$sqlcmd = "INSERT INTO following (user_id, follower_id)
					VALUES ($followed, $follower)";

		$result = mysqli_query($link, $sqlcmd);
	}
}

function unfollow_user($client, $follower, $followed) {
	$count = check_follow_count($follower, $followed);

	if($count == 0) {
		$sqlcmd = "DELETE FROM following
					WHERE user_id='$followed' AND follower_id='$follower'
					LIMIT 1";

		$result = mysqli_query($link, $sqlcmd);
	}
}
?>