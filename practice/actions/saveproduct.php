<?php
include './dbconnection.php';

$productName = "";
$productDescription = "";
$buyPrice = "";
$sellPrice = "";
$qty = "";
$category = "";
$status = "";


if (isset($_POST['product_name'])) { $productName = $_POST['product_name'];}
if (isset($_POST['product_desc'])) { $productDescription = $_POST['product_desc'];}
if (isset($_POST['product_buy_price'])) { $buyPrice = $_POST['product_buy_price'];}
if (isset($_POST['product_sell_price'])) { $sellPrice = $_POST['product_sell_price'];}
if (isset($_POST['product_qty'])) { $qty = $_POST['product_qty'];}
if (isset($_POST['category'])) { $category = $_POST['category'];}
if (isset($_POST['status'])) { $status = $_POST['status'];}


if ($productName === '') {header("Location:../index.php?msg=productname not found");die();}
if ($productDescription === '') {header("Location:../index.php?msg=product description not found");die();}
if ($buyPrice === '') {header("Location:../index.php?msg=buy price not found");die();}
if ($sellPrice === '') {header("Location:../index.php?msg=sell price not found");die();}
if ($qty === '') {header("Location:../index.php?msg=qty not found");die();}
if ($category === '') {header("Location:../index.php?msg=category not found");die();}
if ($status === '') {header("Location:../index.php?msg=status not found");die();}

//image upload here
$target_dir = "productImages/";
$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk=0;
}

if ($uploadOk == 0) {
  header("Location:../index.php?msg=sorry. file format does not support");die(); 

} else {
  move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
    
  }


$Query="INSERT INTO products(product_name,product_description,buy_price,sell_price,avl_qty,product_category,is_active,product_profile_image) Values"
        . "('".$productName."','".$productDescription."','".$buyPrice."','".$sellPrice."','".$qty."','".$category."','".$status."','".$target_file."')";


$result=$conn->query($Query);
if ($result===TRUE){
    header("Location:../index.php?msg=product saved successfully");die();
} else {
   header("Location: ../index.php?msg=Product Save Error:".mysqli_error($conn));die();
}
?>