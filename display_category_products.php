<?php
session_start();
include_once("connect.php");
?>




<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Products</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ajax/autoreload.js"></script>
</head>
<body>

<div id="products-wrapper">
    <header>
    <?php include_once("nav.php"); ?>
</header>

<br /><br /><br />

<!--To fectch the category id from category table and display its name on the webpage-->

<?php
$result = $mysqli->query("SELECT * FROM category");
while ($row = $result->fetch_object()) {
     echo '<div class = "category"><ul><li><a href = "display_category_products.php?cat_id='.$row->cat_id.'">'.$row->category_name.'</a></ul></li></div>';
 }

?>

<br /><br />
	 <div class="products">
<?php

        // Check to see if the URL variable is set and that it exists in the database
            if(isset($_GET['cat_id'])){
                $id = preg_replace('#[^0-9]#i','',$_GET['cat_id']); // gets the cat_id foreign key number from the products table to display products accordingly
                $current_url = base64_encode($_SERVER['REQUEST_URI']);
                $results = $mysqli->query("SELECT * FROM products WHERE cat_id = '$id'"); //fetches all the list of products from the products tables according to cat_id
                $productCount = mysqli_num_rows($results);
                if($productCount>0){
                    while($row = mysqli_fetch_array($results)){
                        $product_img_name = $row["product_img_name"];
                        $product_name = $row["product_name"];
                        $product_desc = $row["product_desc"];
                        $price = $row["price"];
                        $product_code = $row["product_code"];
                        $id = $row["id"];
?>
<!--actual displaying of products, all assigned variables above are being used relevantly-->

	 	<div class="product">
            <!--<form method="post" action="cart_update.php">-->
            <div class="imagethumb"><a href = "<?php echo "display_each_product.php?id=$id"; ?>"><img src="uploads/<?php echo $product_img_name; ?>"></a></div>
            <div class="productdetailscontent"><h3><?php echo $product_name; ?></h3>
            <div class="product-desc"><?php echo $product_desc; ?></div>
            <br />
            <div class="productprice">Price:&nbsp;<?php echo $currency.$price; ?>
            <!--dont forget to put stock here, assing variable above first-->
			</div></div>
            <input type="hidden" name="product_code" value="'.$obj->product_code.'" />
            <input type="hidden" name="type" value="add" />
			<input type="hidden" name="return_url" value="'.$current_url.'" />
			<!--</form>-->
            </div>
           
  
<?php
                    } // this closing curly bracket is within the while loop. While loop helps display all products with particular cat_id(fk) on the web page; otherwise, it doesn't display.

                }else{
                    echo "That item does not exist";
                    exit();

                }

                }else{
                echo "No product in the system with that ID";
                exit();

            }        

?>
</div><!--products end-->

</div><!--products-wrapper end-->


  </body>
  </html>