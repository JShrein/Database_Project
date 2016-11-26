<?php
function add_post($user_id, $content) {
	$sqlcmd = "insert into posts(user_id, content, timestamp)
					values($user_id, '".mysql_real_escape_string($content). "', now())";
	$result = mysql_query($sqlcmd);
}
?>