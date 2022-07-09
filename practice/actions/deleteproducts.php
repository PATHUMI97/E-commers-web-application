<?php
include './dbconnection.php';

$deleteProductId="";

if(isset($_GET['id'])){$deleteProductId=$_GET['id'];
}

$delQuery ="DELETE FROM products WHERE id_products = '".$deleteProductId."' ";
$result=$conn->query($delQuery);

if ($result===true) {
     header("Location:../products.php?msg=product deleted successfully");die(); 
echo $delQuery;
} else {
     header("Location:../products.php?msg=product deleted error");die(); 
}

?>