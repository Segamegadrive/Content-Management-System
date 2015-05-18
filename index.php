<?php
session_start();
include_once("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-commerce Site To Sell Prodcuts Online</title>
<link href="style.css" rel="stylesheet" type="text/css">

<script type ="text/javascript">
        var image1 = new Image()
            image1.src = "images/img_slider1.png"
        var image2 = new Image()
            image2.src ="images/img_slider2.png"
        var image3 = new Image()
            image3.src = "images/img_slider3.png"
    </script>

</head>

<body>
<div id="products-wrapper">
    <header>
        <?php include_once("nav.php"); ?>
        <?php include_once("display_added_product_number.php"); ?>
    </header>

    <br /><br /><br />

<!---to display products according to category-->

<?php
$current_url = base64_encode($_SERVER['REQUEST_URI']);
$result = $mysqli->query("SELECT * FROM category");
while ($row = $result->fetch_object()) {
     echo '<div class = "category"><ul><li><a href = "display_category_products.php?cat_id='.$row->cat_id.'">'.$row->category_name.'</a></ul></li></div>';
 }

?>



<br /><br /><br />

    <div class = "image_slider">
        <img src = "images/img_slider1.png" id = "next" alt = "" />
        <script type = "text/javascript">
        var step = 1
            function nextit(){
                document.images.next.src = eval("image"+step+".src")
                if (step<3)
                step++
                else
                step = 1
                setTimeout("nextit()", 2400)
                }
            nextit()
    </script>


    </div><!--image_slider end--><br><br />

    
	 <div class="products">
        <!--<h2>Products Of The Day</h2>--> 
    <?php
    
    $current_url = base64_encode($_SERVER['REQUEST_URI']);
    
	$results = $mysqli->query("SELECT * FROM products ORDER BY id ASC");
    if ($results) { 
	
        //fetch results set as object and output HTML
        while($obj = $results->fetch_object())
        {

			echo '<div class="product">'; 
            echo '<form method="post" action="cart_update.php">';
            //echo '<div class="product-thumb"><img src='.$obj->product_img_name.'></div>';

			echo '<div class="imagethumb"><a href = "display_each_product.php?id='.$obj->id.'"><img src="uploads/'.$obj->product_img_name.'"></a></div>';
            echo '<div class="productdetailscontent"><h3>'.$obj->product_name.'</h3>';
            echo '<div class="product-desc">'.$obj->product_desc.'</div>';
            echo '<br />';
            echo '<div class="productprice">';
			echo 'Price '.$currency.$obj->price;
            echo '<div class = "stock">';
            echo 'Stock:&nbsp' .$stock.$obj->stock;
			echo '</div></div></div>';      
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

