<?php
function add_post($user_id, $content) {
	$sqlcmd = "INSERT INTO posts(user_id, content, time_stamp)
					VALUES($user_id, '".mysql_real_escape_string($content). "', now())";
	$result = mysql_query($sqlcmd);
}

function show_posts($user_id){
	$posts = array();

	$sqlcmd = "SELECT content, time_stamp 
				FROM posts
				WHERE user_id = '$user_id' 
				ORDER BY time_stamp DESC";

	$result = mysql_query($sqlcmd);

	while($data = mysql_fetch_object($result)){
		$posts[] = ['time_stamp' => $data->time_stamp,
					'user_id' => $user_id,
					'content' => $data->content];
	}

	return $posts;
}
?>