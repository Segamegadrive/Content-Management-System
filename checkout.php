<?php
session_start();
include_once("connect.php");

if(isset($_POST['country'])){

	$title = mysql_real_escape_string($_POST['title']);
	$firstname = mysql_real_escape_string($_POST['firstname']);
	$middlename = mysql_real_escape_string($_POST['middlename']);
	$lastname = mysql_real_escape_string($_POST['lastname']);
	$phone = mysql_real_escape_string($_POST['phone']);
	$email = mysql_real_escape_string($_POST['email']);
	$addressline1 = mysql_real_escape_string($_POST['addressline1']);
	$addressline2 =	mysql_real_escape_string($_POST['addressline2']);
	$town = mysql_real_escape_string($_POST['town']);
	$city = mysql_real_escape_string($_POST['city']);
	$postcode = mysql_real_escape_string($_POST['postcode']);
	$country = mysql_real_escape_string($_POST['country']);
	$order_date = date("Y-m-d H:i:s");

	//Inserting customer details into customer table

	$sql = "INSERT INTO customer(customer_id, title, fname, mname, lname, phone, email, addressline1, addressline2, town, city, postcode, country, orderdate) VALUES('', '$title', '$firstname', '$middlename', '$lastname', '$phone', '$email', '$addressline1', '$addressline2', '$town', '$city', '$postcode', '$country', '$order_date')";

	$result = $mysqli->query($sql);
	if(!$result){
		echo "Data could not be inserted into the customer table".mysqli_error($mysqli);
	}
	else
	{
		echo "Customer Details inserted successfully into customer table";
	}

	$customerid = $mysqli->insert_id;

	//Inserting Order deatils into order_details table
	foreach($_SESSION["products"] as $product){

		$product_code = $product["code"];
		$query = "SELECT * FROM products WHERE product_code = '$product_code' LIMIT 1";
		$output = $mysqli->query($query);
		$prod = $output->fetch_object();
		$quantity = $product["qty"];
		$price = $product["price"];
		$subtotal = $product["price"] * $product["qty"];

		$sql = "INSERT INTO order_details(orderdetails_id, quantity, price, subtotal, product_id, customer_id) VALUES('', '$quantity', '$price', '$subtotal', '$prod->id', '$customerid')";
		$result = $mysqli->query($sql);
		if(!$result){
			echo "Opps, Something went wrong".mysqli_error($mysqli);
		}
		else{
			echo "successfully Done!";
		}

		$results = $mysqli->query("SELECT stock FROM products WHERE product_code='$product_code' LIMIT 1");
		$obj = $results->fetch_object();
		$stock = $obj->stock - $quantity; //Update product's stock.
		$results = $mysqli->query("UPDATE products SET stock = '$stock' WHERE product_code = '$product_code'");

	}//for each end
	session_destroy();
	header("location: report.php");

}

?>