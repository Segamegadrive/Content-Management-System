<?php
$currency = '£';
$db_username = 'root';
$db_password = '';
$db_name = 'cms';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name) or die (mysqli_errno());

if(mysqli_connect_errno())
	{
		echo 'Database connection problem'.mysqli_connect_errno();
	}
?>