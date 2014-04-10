<?php
session_start();
include_once("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="products-wrapper">
<?php include_once("nav.php"); ?>

<fieldset><legend><h2>Please enter product details to insert into the database</h2></legend>
<form action="insert.php" id="FileUploader" enctype="multipart/form-data" method="post" >
    
    <label>product_code:
    </label>
    <input type = "text" name="product_code" id = "product_code" /><br>
    
    <label>Product Name:
    </label>
    <input type="text" name="mName" id="mName" /><br>

 
    <label>product_desc:
    </label>
    <input type = "text" name="product_desc" id="product_desc" /><br>

    <label>price:
    </label>
    <input type = "text" name="price" id="price" /><br>

    <label>Stock:
    </label>
    <input type = "text" name = "stock" id = "stock" /><br>
    
    <label>Image(product_img_name):
    </label>
    <input type="file" name="mFile" id="mFile" />
    
    <button type="submit" class="red-button" id="uploadButton">Upload</button>

</form>
</fieldset>
    <h1>Products</h1>
	 <div class="products">
    <?php
    //current URL of the Page. cart_update.php redirects back to this URL
	$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    
	$results = $mysqli->query("SELECT * FROM products ORDER BY id ASC");
    if ($results) { 
	
        //fetch results set as object and output HTML
        while($obj = $results->fetch_object())
        {
			echo '<div class="product">'; 
            echo '<form method="post" action="cart_update.php">';
			echo '<div class="product-thumb"><img src="uploads/'.$obj->product_img_name.'"></div>';
            echo '<div class="product-content"><h3>'.$obj->product_name.'</h3>';
            echo '<div class="product-desc">'.$obj->product_desc.'</div>';
            echo '<div class="product-info">';
			echo 'Price '.$currency.$obj->price;
            //echo 'Stock' .$stock.$obj->stock;
            //echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
			//echo '<button class="add_to_cart">Add To Cart</button>';
			echo '</div></div>';

           
            echo "<a href = \"delete.php?id=" . $obj->id . "\">Delete</a>";
            echo "<span>&nbsp;&nbsp;&nbsp;</span>";
            echo "<a href = \"edit.php?id=" . $obj->id . "\">Edit</a>";
            

            echo '<input type="hidden" name="product_code" value="'.$obj->product_code.'" />';
            echo '<input type="hidden" name="type" value="add" />';
			echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';

            echo '</form>';
            echo '</div>';
        }
    
    }
    ?>
    </div>

</div>

</body>
</html>

