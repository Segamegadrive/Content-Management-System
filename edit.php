<?php

session_start();
include_once("connect.php");

if(!isset($_POST['submit'])){
	$q = "SELECT * FROM products WHERE ID = $_GET[id]";
	$result = $mysqli->query($q);
	$product = mysqli_fetch_array($result);
}

?>

<fieldset><legend><h2>Edit your product details here</h2></legend>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" id="FileUploader" enctype="multipart/form-data" method="post" >
	<input type="hidden" name="submit" value="yes" />
    
    <label>product_code:
    </label>
    <input type = "text" name="product_code" id = "product_code" value = "<?php echo $product['product_code']; ?>" /><br>
    
    <label>Product Name:
    </label>
    <input type="text" name="mName" id="mName" value = "<?php echo $product['product_name']; ?>" /><br>

 
    <label>product_desc:
    </label>
    <input type = "text" name="product_desc" id="product_desc" value = "<?php echo $product['product_desc']; ?>"/><br>

    <label>price:
    </label>
    <input type = "text" name="price" id="price" value = "<?php echo $product['price']; ?>"/><br>

    <label>Stock:
    </label>
    <input type = "text" name = "stock" id = "stock" value = "<?php echo $product['stock']; ?>" /><br>

    <!--<img src="<?php //echo $product['product_img_name']; ?>" > -->
			<!--Image:<input type="file" name="filename" size="10" />-->
    <label>Image(product_img_name):
    </label>
    <input type="file" name="mFile" id="mFile" value = "<?php echo $product['product_img_name']; ?>" /><br>

    <input type = "hidden" name = "id" value = "<?php echo $_GET['id']; ?>" /> 

    <!--<input type="submit" value="Modify" />-->
    
    <button type="submit" class="red-button" id="uploadButton" name = "submit">Edit</button>

</form>
</fieldset>	

<?php
error_reporting(0);
$UploadDirectory    = 'uploads/';
$SuccessRedirect    = 'index.php';
    
        $name = $_FILES['mFile']['name'];
        $temp = $_FILES['mFile']['tmp_name'];
        $size = $_FILES['mFile']['size'];

if(isset($_POST['submit'])){
        
        // $query = "INSERT INTO Product VALUES $name;";
        //$image = "uploads/".$name;
        if(move_uploaded_file($temp, $UploadDirectory . $name)){

            $u = "UPDATE products SET product_code = '$_POST[product_code]', product_img_name = '$name', product_name = '$_POST[mName]', product_desc = '$_POST[product_desc]', price = '$_POST[price]', stock = '$_POST[stock]' WHERE ID = $_POST[id]";
            $mysqli->query($u);
            echo "Product has been edited";
            header ("Location: index.php");

        }
		
	}

?>

