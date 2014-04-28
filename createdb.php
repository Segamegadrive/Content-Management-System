<?php
$mysqli = mysqli_connect('localhost', 'root', '');
if (!$mysqli) {
    die('Could not connect: ' . mysqli_error());
}


if ($mysqli->select_db('cms')){
echo 'suessful connect to cms database';
}
else {
      $sql = 'CREATE DATABASE cms';
    if ($mysqli->query($sql)) {
        echo "Database cms created successfully\n";
    } else {
        echo 'Error creating database: ' . mysqli_error($mysqli) . "\n";
    }
}

$mysqli->select_db('cms');


// sql code to create category table into cms database

$query = "CREATE TABLE IF NOT EXISTS `category`(
              `cat_id` int(11) NOT NULL AUTO_INCREMENT,
              `category_name` varchar(35) NOT NULL,
               PRIMARY KEY(cat_id));";

if($mysqli->query($query)){
  echo "Category table has been successfully created!";
}else{
  echo "Error creating category table:" . mysqli_error($mysqli);
}

$query = $mysqli->query("INSERT INTO category VALUES('', 'Garden')");
if($query){
  echo "Data is successfully inserted!";
}
else
{
  echo "Some problem occured!";
}

$query = $mysqli->query("INSERT INTO category VALUES('', 'Electronics')");
if($query){
  echo "Data successfully inserted!";
}
else
{
  echo "Some problem occured!";
}


//sql code to create products table into cms database
$query = "CREATE TABLE IF NOT EXISTS `products`(
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `product_code` varchar(60) NOT NULL,
            `product_img_name` varchar(60) NOT NULL,
            `product_name` varchar(60) NOT NULL,
            `product_desc` tinytext NOT NULL,
            `price` decimal(10,2) NOT NULL,
            `stock` text NOT NULL,
            -- `file_size` int(11) NOT NULL,
            `uploaded_date` datetime NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `product_code` (`product_code`),
            cat_id int(11) NOT NULL,
            FOREIGN KEY(cat_id) REFERENCES
            category(cat_id)
          ) AUTO_INCREMENT=1 ;
          ";

if($mysqli->query($query)){
  echo "Products table has been successfully created!";
}else{
  echo "Error creating products table:" . mysqli_error($mysqli);
}

// $FileSize = $_FILES['mFile']["size"];
$uploaded_date = date("Y-m-d H:i:s");

$query = $mysqli->query("INSERT INTO products VALUES('', 'PD1001', 'box1.jpg', 'Dummy Image 1', 'This is a Dummy Image 1.', '200', '10', '$uploaded_date', '2')");
if($query){
  echo "Product PD1001 is successfully inserted!";
}
else
{
  echo "Some problem occured!". mysqli_error($mysqli);
}

$query = $mysqli->query("INSERT INTO products VALUES('', 'PD1002', 'box2.jpg', 'Dummy Image 2', 'This is a Dummy Image 2.', '350', '15', '$uploaded_date', '1')");
if($query){
  echo "Product PD1002 is successfully inserted!";
}
else
{
  echo "Some problem occured!";
}

$query = $mysqli->query("INSERT INTO products VALUES('', 'PD1003', 'box3.jpg', 'Dummy Image 3', 'This is a Dummy Image 3.', '240', '5', '$uploaded_date', '2')");
if($query){
  echo "Product PD1002 is successfully inserted!";
}
else
{
  echo "Some problem occured!". mysqli_error($mysqli);
}


//sql code to create customer table

$query = "CREATE TABLE IF NOT EXISTS `customer`(
            `customer_id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(10) NOT NULL,
            `fname` varchar(40) NOT NULL,
            `mname` varchar(40) NOT NULL,
            `lname` varchar(40) NOT NULL,
            `phone` varchar(35) NOT NULL,
            `email` varchar(45) NOT NULL,
            `addressline1` varchar(50) NOT NULL,
            `addressline2` varchar(50) NOT NULL,
            `town` varchar(45) NOT NULL,
            `city` varchar(45) NOT NULL,
            `postcode`varchar(10) NOT NULL,
            `country` varchar(40) NOT NULL,
            `orderdate` date NOT NULL,
            PRIMARY KEY(`customer_id`));";

if($mysqli->query($query)){
  echo "Customer table has been successfully created!";
}else{
  echo "Error creating customer table:" . mysqli_error($mysqli);
}

$query = $mysqli->query("INSERT INTO customer VALUES('', 'Mr', 'John', '', 'Cooper', '07588589868', 'john@hotmail.com', '155 Viking', '', 'London', 'South London', 'SK223GG', 'United Kingdom', '$uploaded_date')");
if($query){
  echo "Data is successfully inserted!";
} 
else
{
  echo "Some problem occured!". mysqli_error($mysqli);
}

$query = $mysqli->query("INSERT INTO customer VALUES('', 'Mrs', 'Sita', '', 'Smith', '07538689868', 'sita@gmail.com', '12 Halewood', '', 'Bracknell', 'Berkshire', 'RG215OP', 'United Kingdom', '$uploaded_date')");
if($query){
  echo "Data successfully inserted!";
}
else
{
  echo "Some problem occured!". mysqli_error($mysqli);
}


// sql code to create order details table

$query = "CREATE TABLE IF NOT EXISTS `order_details`(
              `orderdetails_id` int(11) NOT NULL AUTO_INCREMENT,
              `quantity` SMALLINT NOT NULL,
              `price` decimal(10,2) NOT NULL,
              `subtotal` decimal(10,2) NOT NULL,
              PRIMARY KEY(orderdetails_id),
              `product_id` int(11) NOT NULL,
              `customer_id` int(11) NOT NULL,
              FOREIGN KEY(customer_id) REFERENCES
              customer(customer_id),
              FOREIGN KEY(product_id) REFERENCES
              products(id));
              ";

if($mysqli->query($query)){
  echo "order_details table has been successfully created!";
}else{
  echo "Error creating products table:" . mysqli_error($mysqli);
}

$query = $mysqli->query("INSERT INTO order_details VALUES('', '2', '200', '400', '1', '1')");
if($query){
  echo "Data is successfully inserted!";
}
else
{
  echo "Some problem occured!". mysqli_error($mysqli);
}

$query = $mysqli->query("INSERT INTO order_details VALUES('', '3', '350', '1050', '2', '2')");
if($query){
  echo "Data successfully inserted!";
}
else
{
  echo "Some problem occured!". mysqli_error($mysqli);
}



?>
