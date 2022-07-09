<?php
include './actions/dbconnection.php';
$pid = "";

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
}

if ($pid == "") {
   header("Location:./index.php");
    die();
}

$query = "SELECT * FROM products WHERE id_products='" . $pid . "'";
$result = $conn->query($query);

$name;$description;$price;$imageURL;$pid;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name= $row["product_name"];
    $description= $row['product_description'];
    $price= $row["sell_price"];
    $imageURL= $row["product_profile_image"];
}else{
   header("Location:./advancedSearch.php?msg=product not found");
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
                <div align="center" height="90%" width="100%">
                    <table style="background-color: #ffcccc" border="0">


                        <tr>
                            <td><img src="actions/<?php echo $imageURL;?>" width="400" height="400"></td>
                            <td>
                                <h2><?php echo $name;?></h2>
                                <h3><?php echo $description;?></h3>
                                <h5><?php echo $price?></h5>
                                <form method="GET" action="actions/addToCart.php">
                                    <input type="hidden" name="pid" value="<?php echo $pid;?>"/>
                                    <input type="submit"  value="add to cart" />
                                </form>
                            </td>
                        </tr>

                    </table>
                </div>
<?php include './includes/footer.php';?>
    </body>
</html>
