<html>
<head>
	<title>Add Category</title>
	<link rel = "stylesheet" href = "style.css" type = "text/css" />
</head>
<body>
	
<div id = "products-wrapper">

	<header>
		<?php include_once("nav.php") ?>
	</header> <br /><br /><br />
<div class = "products">
<?php
session_start();
include_once("connect.php");

if(isset($_POST['submit'])){

	$cat = $_POST['category'];
	$sql = "INSERT INTO category (cat_id, category_name) VALUES ('', '$cat')";
	if($result = $mysqli->query($sql)){
		echo "category added successfully";
	}
		else{
			echo "Problem occured while adding category";
	}
}

?>

<form action = "add_category.php" method = "POST" enctype="multipart/form-data">
	Enter New Category Name:<input type = "text" name = "category" />
							<input type = "submit" name = "submit" value = "Add Category" />
</form>

</div>
</div>
</body>
</html>