<?php
	session_start();
	include_once("connect.php");

	$id = $_GET['id'];
	$picture = $_GET['picture'];


	$mysqli->query("DELETE FROM products WHERE id = '$id'") or die (mysql_error());
	unlink('uploads/'.$picture);
	echo "Product has been deleted";
	header('Location: index.php');
?>

