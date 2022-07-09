<?php
session_start();
include './actions/dbconnection.php';
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
            <h2>shopping cart</h2>
            <table style="background-color: #ffcccc" border="0">
                <?php
                $totalAmu = 0.0;
                $isProduct = false;

                if (isset($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                    foreach ($cart as $cartItem) {

                        $productQuery = "SELECT * FROM products WHERE id_products = '" . $cartItem[0] . "'";
                        $result = $conn->query($productQuery);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $rowAmu = ($row['sell_price'] * $cartItem[1]);
                            $totalAmu = $totalAmu + $rowAmu;
                            $isProduct = true;
                            ?>

                            <tr>
                                <td><?php echo $cartItem[0]; ?></td>
                                <td><img src="<?php echo "actions/" . $row["product_profile_image"]; ?>" width="90" height="90"></td>
                                <td><?php echo $row["product_name"]; ?></td>
                                <td><?php echo $row['product_description']; ?></td>
                                <td><?php echo $row["sell_price"]; ?></td>
                                <td><?php echo $cartItem[1]; ?></td>
                                <td><?php echo $row["sell_price"]; ?> *<?php echo $cartItem[1]; ?></td>

                                <td><a href="actions/removeFromCart.php?pid=<?php echo $cartItem[0]; ?>">
                                        <input type="button" value="remove" /></a></td>
                            </tr>

                            <?php
                        }
                    }
                }
                if (!$isProduct) {
                    echo 'cart empty';
                }
                ?>
            </table>
            <br>
            <label>total:<?php echo $totalAmu; ?> </label>
            <a href="chechout.php"> <input type="submit" value="checkout" name="checkout"/></a>

        </div>
<?php include './includes/footer.php';?>
    </body>
</html>
