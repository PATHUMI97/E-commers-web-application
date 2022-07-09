<?php
session_start();
include './actions/dbconnection.php';
$orderID = "";
if (isset($_SESSION['current_invoice_id'])) {
    $orderID = $_SESSION['current_invoice_id'];
}
if ($orderID == "") {
    header("Location:./cart.php?msg=please login or register before continue");die();
}

$userId = "";
if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
}
if ($userId == "") {
      header("Location:./cart.php?msg=please login or register before continue");die();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include './includes/header.php';
        ?>
        <div align="center">
            
            <form method="post" action="https://sandbox.payhere.lk/pay/checkout">  
                <h2>Order Confirmation Page</h2>

                <table style="background-color: #ffcccc">
                    <tr>
                        <td>

                            <input type="hidden" name="merchant_id" value="1216535">   
                            <!-- Replace your Merchant ID -->
                            <input type="hidden" name="return_url" value="http://localhost/return.php">
                            <input type="hidden" name="cancel_url" value="http://localhost/cancel">
                            <input type="hidden" name="notify_url" value="http://localhost/notify.php">  
                            <br><br>Item Details<br>
                            Order ID:<input type="hidden" name="order_id" value="<?php echo $orderID; ?>">

                            <h2>Order Details</h2>
                            <?php
                            $paymentItems = "";
                            $items = "SELECT * FROM invoice_item i JOIN products p ON i.id_products =p.id_products WHERE i.id_invoice_item='" . $orderID . "' ";
                            $result = $conn->query($items);

                            $total = 0;
                            if ($result == true && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <label>Item Name : <?php
                                        $total = $total + ($row['line_unit_price'] * $row['line_qty']);
                                        $paymentItems = $paymentItems . ", " . $row['product_name'] . ":" . $row['line_qty'];
                                        echo $row['product_name']
                                        ?></label><br>


                                    <?php
                                }
                            }
                            ?>
                            <label>Currency  : LKR</label><br>
                            <label>Amount    : <?php echo $total; ?></label><br>
                            <input type="hidden" name="items" value="<?php echo $paymentItems; ?>"><br>
                            <input type="text" name="currency" value="LKR">
                            <input type="text" name="amount" value="<?php echo $total; ?>">  
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                            <h2>Customer Details</h2>
                            <?php
                            $query2 = "SELECT * FROM users WHERE id_users='" . $userId . "'";
                            $resultUser = $conn->query($query2);
                            $record = $resultUser->fetch_assoc();
                            ?>
                            <table style="background-color: #00cccc" border="0">

                                <tr>
                                    <td>order id</td>
                                    <td><?php echo $orderID; ?></td>
                                </tr>
                                <tr>
                                    <td>first name</td>
                                    <td><?php echo $record['name']; ?></td>
                                </tr>
                                <tr>
                                    <td>last name</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td><?php echo $record['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>contact number</td>
                                    <td><?php echo $record['contact_no']; ?></td>
                                </tr>
                                <tr>
                                    <td>address</td>
                                    <td><?php echo $record['address']; ?></td>
                                </tr>
                                <tr>
                                    <td>city</td>
                                    <td>colombo</td>
                                </tr>
                                <tr>
                                    <td>country</td>
                                    <td>Sri lanka</td>
                                </tr>


                            </table>
                        </td>
                    </tr>
                </table>


                <input type="hidden" name="first_name" value="<?php echo $record['name']; ?>">
                <input type="hidden" name="last_name" value="-"><br>
                <input type="hidden" name="email" value="<?php echo $record['email']; ?>">
                <input type="hidden" name="phone" value="<?php echo $record['contact_no']; ?>"><br>
                <input type="hidden" name="address" value="<?php echo $record['address']; ?>">
                <input type="hidden" name="city" value="colombo">
                <input type="hidden" name="country" value="Sri Lanka"><br><br> 
                <input type="submit" value="Buy Now">   
            </form> 
        </div><?php include './includes/footer.php';?>
    </body>
</html>
