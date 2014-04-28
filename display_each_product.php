<?php
session_start();
include_once("connect.php");
?>


<?php

        // Check to see if the URL variable is set and that it exists in the database
            if(isset($_GET['id'])){
                $id = preg_replace('#[^0-9]#i','',$_GET['id']);
                $current_url = base64_encode($_SERVER['REQUEST_URI']);
                $results = $mysqli->query("SELECT * FROM products WHERE id = '$id' LIMIT 1");
                $productCount = mysqli_num_rows($results);
                if($productCount>0){
                    while($row = mysqli_fetch_array($results)){
                        $product_img_name = $row["product_img_name"];
                        $product_name = $row["product_name"];
                        $product_desc = $row["product_desc"];
                        $price = $row["price"];
                        $product_code = $row["product_code"];
                    }

                }else{
                    echo "That item does not exist";
                    exit();

                }

                }else{
                echo "No product in the system with that ID";
                exit();

            }        

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $product_name ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ajax/autoreload.js"></script>
</head>
<body>

<div id="products-wrapper">
    <header>
    <?php include_once("nav.php"); ?>
</header>

<br /><br />
	 <div class="products">
        <form action = "cart_update.php" method = "POST">
        <table width = "100%" border = "0" cellspacing="0" cellpadding="14">
            <tr>
                <td width="20%" valign="top"><img src = "uploads/<?php echo $product_img_name ?>" alt = "<?php echo $product_name; ?>" /><br />
                    <a href = "uploads/<?php echo $product_img_name; ?>">View Full Size Image</a></td>
                <td width="80%" valign="top"><h3><?php echo $product_name; ?></h3>
                    <p><?php echo $product_desc; ?><br />
                        <br />
                        <?php echo $price; ?>
                        <br />
                        
                        Quantity:<input type = "text" name = "product_qty" value = "1" size = "3" />
                        <button class="add_to_cart">Add To Cart</button><br />
                        <input type="hidden" name="product_code" value="<?php echo $product_code; ?>" />
                        <input type="hidden" name="type" value="add" />
                        <input type="hidden" name="return_url" value= "<?php echo $current_url; ?>" />
                        </form>
                    </td>
                </tr>
            </table>
    </div><!--products end-->

<div class="shopping-cart">
<h2>My Basket</h2>
<?php
if(isset($_SESSION["products"]))
{
    $total = 0;
    echo '<ol>';
    foreach ($_SESSION["products"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
        echo '<h3>'.$cart_itm["name"].'</h3>';
        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
        echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
        echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
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
</div><!--product_wrapper end-->
</body>
</html>

