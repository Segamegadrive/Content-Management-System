<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="products-wrapper">
    <header>
        <?php include_once("nav.php"); ?>
        <!--<?php //include_once("display_added_product_number.php"); ?>-->
    </header>

    <br /><br /><br /><br /><br />

<h1 style = "text-align:center;"> Customer Order Report </h1><br />
<table style = "width:900px; border: 2px solid green;">
<tr style = "text-decoration: underline; color: blue;">
  <th>Order ID</th>
  <th>Customer First Name</th> 
  <th>Customer Last Name</th>
  <th>Order Detail</th>
  <th>Total</th>
</tr>
<?php
include_once('connect.php');
$query = "SELECT * FROM customer";
$customers = $mysqli->query($query);
if ($customers) {  
      //fetch results set as object and output HTML
       while($customer = $customers->fetch_object() )
       {
          
          $customerfname = $customer->fname;
          $customerlname = $customer->lname;
          $customerid = $customer->customer_id;
          $query = "SELECT * FROM order_details WHERE customer_id = '$customerid'";
          $orders = $mysqli->query($query);
          $subTotal = 0;
          $orderDetail = '';
          if($orders){
            while ($order = $orders->fetch_object()) {
              $subTotal+=$order->price;
              $query="SELECT product_name, product_code FROM products WHERE id = '$order->product_id'";
              $result = $mysqli->query($query);
              $product = $result->fetch_object();
              $orderDetail .= $product->product_name.": ".$product->product_code.": ".$order->quantity." ";
            }
}
        echo '<tr style = "text-align: center;">';
        echo '<td>'.$customer->customer_id.'</td>';
        echo '<td>'.$customerfname.'</a></td>';
        echo '<td>'.$customerlname.'</td>';
        echo '<td>'.$orderDetail.'</td>';
        echo '<td>'.$subTotal.'</td>';
        echo '</tr>';
       }
}
?>
</table>

<br /><br />
<h1  style = "text-align:center;"> Stock Report </h1>
<table style = "width:900px; border: 2px solid green;">
<tr style = "text-decoration: underline; color: blue;">
  <th>Product ID</th>
  <th>Product Code</th>
  <th>Product Name</th>
  <th>Price</th> 
  <th>Stock</th>
</tr>

<?php
	$query = "SELECT * FROM products";
	$products = $mysqli->query($query);
	if ($products) {  
		//fetch results set as object and output HTML
		while($product = $products->fetch_object())
		 {
   			echo '<tr style = "text-align: center;">';
	    	echo '<td>'.$product->id.'</td>';
	        echo '<td>'.$product->product_code.'</td>';
	        echo '<td>'.$product->product_name.'</td>';
	        echo '<td>'.$product->price.'</td>';
	        echo '<td>'.$product->stock.'</td>';
	        echo '</tr>';
        }
}
?>
</table>
</div>
</body>
</html>
