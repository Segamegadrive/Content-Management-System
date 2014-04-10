<?php
$UploadDirectory    = 'uploads/';
$SuccessRedirect    = 'cms.php';

// database connection

session_start();
include_once("connect.php");


if (!@file_exists($UploadDirectory)) {
    //destination folder does not exist
    die("Make sure Upload directory exist!");
}

if($_POST)
{
    if(!isset($_POST['mName']) || strlen($_POST['mName'])<1)
    {
        //required variables are empty
        die("Product name is empty!");
    }


    if($_FILES['mFile']['error'])
    {
        //File upload error encountered
        die(upload_errors($_FILES['mFile']['error']));
    }
	$product_code 		= mysql_real_escape_string($_POST['product_code']); // product code
    $product_img_name   = strtolower($_FILES['mFile']['name']); //uploaded file name
    $product_name       = mysql_real_escape_string($_POST['mName']); // file title
	$product_desc		= mysql_real_escape_string($_POST['product_desc']); // product description
	$price				= mysql_real_escape_string($_POST['price']); // product price
    $stock              = mysql_real_escape_string($_POST['stock']); // stock level
    $ImageExt           = substr($FileName, strrpos($FileName, '.')); //file extension
    $FileType           = $_FILES['mFile']['type']; //file type
    $FileSize           = $_FILES['mFile']["size"]; //file size
    $RandNumber         = rand(0, 9999999999); //Random number to make each filename unique.
    $uploaded_date      = date("Y-m-d H:i:s");  

    switch(strtolower($FileType))
    {
        //allowed file types
        case 'image/png': //png file
        case 'image/gif': //gif file
        case 'image/jpeg': //jpeg file
        case 'application/pdf': //PDF file
        case 'application/msword': //ms word file
        case 'application/vnd.ms-excel': //ms excel file
        case 'application/x-zip-compressed': //zip file
        case 'text/plain': //text file
        case 'text/html': //html file
            break;
        default:
            die('Unsupported File!'); //output error
    }

    
    //File Title will be used as new File name
    //$Newproduct_img_name = preg_replace(array('/s/', '/.[.]+/', '/[^w_.-]/'), array('_', '.', ''), strtolower($product_name));
    //$Newproduct_img_name = $Newproduct_img_name.'_'.$RandNumber.$ImageExt;
   //Rename and save uploded file to destination folder.
   if(move_uploaded_file($_FILES['mFile']["tmp_name"], $UploadDirectory . $product_img_name))
   {
        //connect & insert file record in database
   
        $sql = "INSERT INTO products(product_code, product_img_name, product_name, product_desc, price, stock, file_size, uploaded_date) VALUES ('$product_code', '$product_img_name', '$product_name', '$product_desc', '$price', '$stock', '$FileSize','$uploaded_date')";
		if (!mysqli_query($mysqli,$sql))
		{
			die('Error: ' . mysqli_error($mysqli));
		}
		echo "1 record added";
      

        header('Location: '.$SuccessRedirect); //redirect user after success

   }else{
        die('error uploading File!');
   }
}

//function outputs upload error messages, http://www.php.net/manual/en/features.file-upload.errors.php#90522
function upload_errors($err_code) {
    switch ($err_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}
?>