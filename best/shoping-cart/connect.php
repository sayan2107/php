<?php 
	$dbc = @mysql_connect('localhost', 'root', '') or die("could not connect ".mysql_error());
	$db = @mysql_select_db('cart') or die('could not select the database. ');
?>