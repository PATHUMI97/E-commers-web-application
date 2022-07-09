<?php
session_start();
include './actions/dbconnection.php';
$orderID = "";
if (isset($_GET['order_id'])) {
    $orderID = $_GET['order_id'];
}
if ($orderID == "") {
    header("Location:./cart.php?msg=cart requires to process payment");
    die();
}
$userId = "";
if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
}
if ($userId == "") {
    header("Location:./cart.php?msg=please login or register before continue");
    die();
}

$query = "Update invoice SET status ='1' WHERE id_invoice ='" . $orderID . "'";
if ($conn->query($query) === true) {
    echo '<h2> payment processed successfully</h2>';
    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'] = NULL;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="actions/style.css"/>

    </head>
    <body>
        <?php
        include './actions/header.php';
        ?>
        <input type="button" onclick="window.print()" value="print"/>
        <div align='center'>
            <h2>order placed successfully!</h2>
            <div width='400'>
                <h2>customer details</h2>
                <?php
                $query2 = "SELECT * FROM users WHERE id_users='" . $userId . "'";
                $resultUser = $conn->query($query2);
                $record = $resultUser->fetch_assoc();
                ?>
                <table border="0">

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
                <h2>product details</h2>
                <table border="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>product name</th>
                            <th>description</th>
                            <th>qty</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $productList = "SELECT * FROM invoice i JOIN invoice_items ii ON i.id_invoice_item=ii.id_invoice JOIN products p ON ii.id_products=]p.id_products";
                        $result = $conn->query($productList);
                        $total="";
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                 $total=$total+$row['line_unit_price']*$row['line_qty'];
                        ?>
                        <tr>
                             <td><img src="<?php echo "actions/" . $row["product_profile_image"]; ?>" width="90" height="90"></td>
                            <td><?php echo "Name:- ". $row["product_name"]; ?></td>
                            <td><?php echo "Description:- ". $row['product_description']; ?></td>
                            <td><?php echo "qty:- ". $row['line_qty']; ?></td>
                            <td><?php echo "price:- ". ($row['line_unit_price']*$row['line_qty']); ?></td>
                        </tr>
                       <?php 
                            }
                        }?>
                    </tbody>
                </table>
                <h2>total:<?php echo $total ?></h2>
            </div>
        </div>
        <?php include './actions/footer.php'; ?>
    </body>
</html>
