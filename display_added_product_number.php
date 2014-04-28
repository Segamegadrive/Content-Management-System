
<?php 
error_reporting(0);
session_start(); 
$current_url = $_SESSION["current_url"];
if(isset($_SESSION["products"])) { 
    $total = 0; 
    foreach ($_SESSION["products"] as $item) {
    $subtotal = $item["qty"]; 
    $total += $subtotal; } 
    echo $total; } 
?>