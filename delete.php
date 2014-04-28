<?php
	session_start();
	include_once("connect.php");


	$mysqli->query("DELETE FROM products WHERE id = $_GET[id]") or die (mysql_error());
	//@unlink('uploads/'.$mysqli->'mFile');
	echo "Product has been deleted";
	header('Location: index.php');
?>

