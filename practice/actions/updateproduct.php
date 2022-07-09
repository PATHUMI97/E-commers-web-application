
<?php
include './dbconnection.php';

$productName = "";
$productDescription = "";
$buyPrice = "";
$sellPrice = "";
$qty = "";
$category = "";
$status = "";
$productId="";


if (isset($_POST['product_name'])) { $productName = $_POST['product_name'];}
if (isset($_POST['product_desc'])) { $productDescription = $_POST['product_desc'];}
if (isset($_POST['product_buy_price'])) { $buyPrice = $_POST['product_buy_price'];}
if (isset($_POST['product_sell_price'])) { $sellPrice = $_POST['product_sell_price'];}
if (isset($_POST['product_qty'])) { $qty = $_POST['product_qty'];}
if (isset($_POST['category'])) { $category = $_POST['category'];}
if (isset($_POST['status'])) { $status = $_POST['status'];}
if (isset($_POST['productId'])) { $productId = $_POST['productId'];}



if ($productName === '') {header("Location:../products.php?msg=productname not found");die();}
if ($productDescription === '') {header("Location:../products.php?msg=product description not found");die();}
if ($buyPrice === '') {header("Location:../products.php?msg=buy price not found");die();}
if ($sellPrice === '') {header("Location:../products.php?msg=sell price not found");die();}
if ($qty === '') {header("Location:../products.php?msg=qty not found");die();}
if ($category === '') {header("Location:../products.php?msg=category not found");die();}
if ($status === '') {header("Location:../products.php?msg=status not found");die();}

$updateQuery="UPDATE products SET product_name='".$productName."', product_description='".$productDescription."', buy_price='".$buyPrice."', sell_price='".$sellPrice."', avl_qty='".$qty."', product_category='".$category."'"
        . ",is_active='".$status."', product_profile_image='".$target_file."' WHERE id_products='".$productId."' ";


$result=$conn->query($updateQuery);
if ($result===TRUE){
    header("Location:../products.php?msg=product updated successfully");die();
} else {
    header("Location:../products.php?msg=product update failed");die();
echo $conn->connect_error;
}