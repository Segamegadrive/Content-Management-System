<!-- This form is included within the index.php. There is no use of this php file but do not delete it-->

<html>
<head>
<title>Insert New Product</title>
</head>
<body>
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
</body>
</html>