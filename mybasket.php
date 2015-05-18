<?php
session_start();
include_once("connect.php");
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>My Basket</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
    <body>



<div id = "products-wrapper">
    <header>
        <?php include_once("nav.php"); ?>
    </header>
<br /><br /><br />
<div class="shopping-cart">

<h2>My Basket</h2>

<?php
 $current_url = base64_encode($_SERVER['REQUEST_URI']);
if(isset($_SESSION["products"]))
{
    $total = 0;
    echo '<ol>';
    foreach ($_SESSION["products"] as $cart_itm)
    {
        $product_code = $cart_itm["code"];   
        $result = $mysqli->query("SELECT id, product_img_name FROM products WHERE product_code = '$product_code' LIMIT 1"); // to display image. it is important to get id as well to retrieve image.
        $obj = $result->fetch_object(); 

        echo '<li class="cart-itm">';
        echo '<a href = "display_each_product.php?id='.$obj->id.'"><img src="uploads/'.$obj->product_img_name.'">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">Remove</a></span>';
        echo '<h3>'.$cart_itm["name"].'</h3>';
        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
        echo '<div class="p-qty">Qty:&nbsp;'.$cart_itm["qty"].'</div>';
        echo '<div class="p-price">Price:&nbsp;'.$currency.$cart_itm["price"].'</div>';
        echo '</li>';
        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
        $total = ($total + $subtotal);
    }
    echo '</ol>';
    echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> <a href="view_cart.php">Check-out!</a></span>';
	echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
}else{
    echo 'Your shopping basket is empty';
}
?>
</div><!--shopping-cart end-->
<!--</div>-->
</body>
</html>