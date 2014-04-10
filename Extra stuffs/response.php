<?php
//include db configuration file
session_start();
include_once("connect.php");

if(isset($_POST["product_code"]) && strlen($_POST["product_code"])>0) 
{	//check $_POST["content_txt"] is not empty

	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$product_code = filter_var($_POST["product_code"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);	
	$product_img_name = filter_var($_POST["mFile"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$product_name = filter_var($_POST["mName"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$product_desc = filter_var($_POST["product_desc"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$price = filter_var($_POST["price"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);	
	// Insert sanitize string in record
	if(mysql_query("INSERT INTO products(product_code, product_img_name, product_name, product_desc, price, file_size, uploaded_date) VALUES('".$product_code."', '".$product_img_name."', '".$product_name."', '".$product_desc."', '".$price."')"))
	{
		 //Record was successfully inserted, respond result back to index page
		  $my_id = mysql_insert_id(); //Get ID of last inserted row from MySQL
		  echo '<li id="item_'.$my_id.'">';
		  echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$my_id.'">';
		  echo '<img src="images/icon_del.gif" border="0" />';
		  echo '</a></div>';
		  echo $contentToSave.'</li>';
		  

	}else{
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}
elseif(isset($_POST["products"]) && strlen($_POST["products"])>0 && is_numeric($_POST["products"]))
{	//do we have a delete request? $_POST["recordToDelete"]

	//sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT removes all characters except digits, plus and minus sign.
	$idToDelete = filter_var($_POST["products"],FILTER_SANITIZE_NUMBER_INT); 
	
	//try deleting record using the record ID we received from POST
	if(!mysql_query("DELETE FROM products WHERE id=".$idToDelete))
	{    
		//If mysql delete query was unsuccessful, output error 
		header('HTTP/1.1 500 Could not delete record!');
		exit();
	}
}
else
{
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
?>