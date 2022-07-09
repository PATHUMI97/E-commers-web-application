<?php
include '../actions/dbconnection.php';
$loadCartQuery = "select * from invoice i join invoice_item j on i.id_invoice = j.id_invoice_item"
        . " where i.invoiced_to = '".$row['id_users']."' and status='2' ";

$res = $conn->query($loadCartQuery);

    $cart = array();
    $currentInvoiceId = "";
if ($res->num_rows > 0) {
    while($rows = $res->fetch_assoc()){
       $cartItem = array($rows['id_products'],$rows['line_qty']); 
       array_push($cart, $cartItem);
       $currentInvoiceId = $row['id_invoice'];
   }
   }
 
$_SESSION['current_invoice_id'] = $currentInvoiceId;
$_SESSION['cart'] = $cart;