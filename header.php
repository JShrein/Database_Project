<?php
$SERVER = 'localhost';
$USER = 'COMP7115';
$PASS = 'Databases';
$DATABASE = 'comp7115_project';

if(!($mylink = mysql_connect($SERVER, $USER, $PASS))) {
	echo "<h3>Unable to connect to database.</h3><br />
	You should probably fix that\n";
	exit;
}

mysql_select_db($DATABASE);
?>