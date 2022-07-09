<?php
session_start();
include './dbconnection.php';
$name = "";
$address = "";
$city = "";
$contactnumber = "";
$email = "";
$username = "";
$password = "";
$cart = "";

$userId = "";
if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
}

$is_login = false;
if (isset($_SESSION['is_login'])) {
    $is_login = $_SESSION['is_login'];
}

$last_id_invoice = "";
if (isset($_SESSION['current_invoice_id'])) {
    $last_id_invoice = $_SESSION['current_invoice_id'];
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['address'])) {
    $address = $_POST['address'];
}
if (isset($_POST['city'])) {
    $city = $_POST['city'];
}
if (isset($_POST['contactNumber'])) {
    $contactnumber = $_POST['contactNumber'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}



if ($cart == "") {
    header("Location:../cart.php?msg=cart not found ");
    die();
}

if (!$is_login) {
    ///register new user part not require for registerd and logged in users !
    $insertQuery = "INSERT INTO users(name,address,contact_no,email,username,password,userType,is_active)"
            . " VALUES('" . $name . "','" . $address . "','" . $contactnumber . "','" . $email . "','" . $username . "','" . $password . "','2','1')";

    $result = $conn->query($insertQuery);
    $userId = 0;
    if ($result === true) {
        $userId = $conn->insert_id;
        $_SESSION["userid"] = $userId;
    } else {
        echo 'error' . mysqli_error($conn);
    }
}
if ($last_id_invoice != "") {
    //remove previous temp carts
    $dropCartQuery = "delete from invoice_item  where id_invoice_item = '" . $last_id_invoice . "' ";

    $res = $conn->query($dropCartQuery);
}

$totalAmu = 0.0;

if ($last_id_invoice == "") {
    $saveInvoice = "insert into "
            . "invoice(invoice_date,total_amount,invoiced_to,invoiced_checked_by,status) values"
            . "(now(),'" . $totalAmu . "','" . $userId . "',null,'2')";

//   echo $saveInvoice;
    $resultx = $conn->query($saveInvoice);
    echo "invoice saved Successfully !";
    $last_id_invoice = $conn->insert_id;
    $_SESSION["current_invoice_id"] = $last_id_invoice;
    echo "Invoice ID : " . $last_id_invoice;
}
//save all the items !!!
foreach ($cart as $cartItem) {
    $querySaveItem = "insert into invoice_item(id_products,id_invoice_item,line_qty,line_unit_price)"
            . " values('" . $cartItem[0] . "', '" . $last_id_invoice . "', '" . $cartItem[1] .
            "',(select sell_price from products where id_products ='" . $cartItem[0] . "' ) )";
    $pitem = $conn->query($querySaveItem);
    if ($pitem === true) {
        echo $cartItem[0] . " saved success";
    } else {
        echo "error" . mysqli_error($conn);
    }
}

$updateInvoiceTotal = "update invoice i set i.total_amount = (select sum(ii.line_unit_price*ii.line_qty) from 
invoice_item ii where ii.id_invoice_item = i.id_invoice) where i.id_invoice =  '" . $last_id_invoice . "' ";

if ($conn->query($updateInvoiceTotal) === true) {
    echo " invoice total updated successfully !";
} else {
    echo "error" . mysqli_error($conn);
}




//payment Confirmation page
header("Location:../paymentconfirmationpage.php");
?>

->