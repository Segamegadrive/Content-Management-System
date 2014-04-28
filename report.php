<h1> Order Report </h1>
<table style="width:900px">
<tr>
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
          // $customerResult = $mysqli->query("SELECT * FROM customer WHERE fname='$order->fname'");
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
              $orderDetail .= $product->product_name.": ".$product->product_code.": ".$order->quantity.", ";
            }
}
        // $orderDate = $customer->ordered_date;
        echo '<tr>';
        echo '<td>'.$customer->customer_id.'</td>';
        echo '<td>'.$customerfname.'</a></td>';
        echo '<td>'.$customerlname.'</td>';
        echo '<td>'.$orderDetail.'</td>';
        echo '<td>'.$subTotal.'</td>';
        echo '</tr>';
       }
}
// echo "Total Income: ".$TotalCash;
?>
</table>


<h1> Stock Report </h1>
<table style="width:700px">
<tr>
  <th>Product ID</th>
  <th>Product Name</th> 
  <th>Product Quantity</th>
</tr>
// <?php
// $query = "SELECT * FROM Product";
// $products = $mysqli->query($query);
// if ($products) {  
//       //fetch results set as object and output HTML
//        while($product = $products->fetch_object() )
//        {
//         echo '<tr>';
//         echo '<td>'.$product->ID.'</td>';
//         echo '<td>'.$product->Name.'</td>';
//         echo '<td>'.$product->NumberofProduct.'</td>';
//         echo '</tr>';
//        }
//}
?>
</table>
