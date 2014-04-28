<?php
session_start();
include_once("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yours shopping cart</title>
<link href="style.css" rel="stylesheet" type="text/css"></head>
<body>
<div id="products-wrapper">
	<header>
		<?php include_once("nav.php"); ?>

	</header>

	<br /><br /><br /><br />
	 <h1>Yours chosen list of products</h1>
 <div class="view-cart">
 	<?php
    //$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $current_url = base64_encode($_SERVER['REQUEST_URI']);
	if(isset($_SESSION["products"]))
    {-
	    $total = 0;
		//echo '<form method="post" action="paypal-express-checkout/process.php">';
		echo '<ul>';
		$cart_items = 0;
		foreach ($_SESSION["products"] as $cart_itm)
        {
           $product_code = $cart_itm["code"];
		   $results = $mysqli->query("SELECT id, product_img_name, product_name, product_desc, price FROM products WHERE product_code='$product_code' LIMIT 1");
		   $obj = $results->fetch_object();
		   
		    echo '<li class="cart-itm">';
		    echo '<a href = "display_each_product.php?id='.$obj->id.'"><img src="uploads/'.$obj->product_img_name.'">';
			echo '<div class="p-price">'.$currency.$obj->price.'</div>';
			echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&nbsp;&nbsp;&nbsp;Remove</a></span>';
			
            echo '<div class="product-info">';
			echo '<h3>'.$obj->product_name.' (Code :'.$product_code.')</h3> ';
            echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
            echo '<div>'.$obj->product_desc.'</div>';
			echo '</div>';
            echo '</li>';
			$subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
			$total = ($total + $subtotal);

			echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$obj->product_name.'" />';
			echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$product_code.'" />';
			echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$obj->product_desc.'" />';
			echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$cart_itm["qty"].'" />';
			$cart_items ++;
			
        }
    	echo '</ul>';
		echo '<span class="check-out-txt">';
		echo '<strong>Total : '.$currency.$total.'</strong>  ';
		echo '</span>';
		echo '</form>';
		
    }else{
		echo 'Your Cart is empty';
	}
	
    ?>
    </div><!--viewcart end-->

<!--Shipping Details-->

<fieldset><legend>Please Enter Customer Shipping Address</legend>
	<form action = "checkout.php" method = "POST">
		Title:<select name = "title">
			<option></option>
			<option value = "mr">Mr</option>
			<option value = "mrs">Mrs</option>
			<option value = "miss">Miss</option>
			<option value = "sir">Sir</option>
			<option value = "madam">Madam</option>
		</select><br />

		First Name: <input type = "text" name = "firstname" value = "sagar" /><br />
		Middle Name: <input type = "text" name = "middlename" /><br />
		Last Name: <input type = "text" name = "lastname" value = "gurung"/><br />
		Phone: <input type = "text"  name = "phone" value = "4234342342342"/><br />
		Email: <input type = "text" name = "email" value = "asjdajsdjs@hotmail.com"/ ><br />
		Address Line 1: <input type = "text" name = "addressline1" value = "aslkjdlajsd" /><br />
		Address Line 2: <input type = "text" name = "addressline2" /><br />
		City: <input type = "text" name = "city" value = "dasdas"/><br />
		Town: <input type = "text" name = "town" value = "none" /><br />
		Post Code: <input type = "text" name = "postcode" value = "sada" /><br />
		Country:<select name = "country">
							<option value = "nepal">Nepal</option>
							<option value = "vietname">Vietnam</option>
							<option value = "america">America</option>
							<option value = "unitedkingdom">United Kingdom</option>
							<option value = "france">France</option>
							<option value = "germany">Germany</option>
							<option value = "india">India</option>
							<option value = "china">China</option>
						</select><br />	

		<input type = "submit" value = "Submit" />
	</form>
</fieldset>

		






<br />

</div><!--product-wrapper end-->
</body>
</html>