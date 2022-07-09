<?php
session_start();
include './actions/dbconnection.php';

$userId = "";
if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
}

$is_login = false;
if (isset($_SESSION['is_login'])) {
    $is_login = $_SESSION['is_login'];
}


$name = "";
$address = "";
$city = "Colombo";
$contactNo = "";
$email = "";
if ($is_login) {
    $query2 = "select * from users where id_users = '" . $userId . "'";
    echo $query2 ;
    $resultUser = $conn->query($query2);
    $record = $resultUser->fetch_assoc();
    $name = $record['name'];
    $address = $record['address'];
    $contactNo = $record['contact_no'];
    $email = $record['email'];
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
            <h2>checkout</h2>
            <form method="POST" action="actions/checkoutAction.php">
            
                
                <b> Billing and delivery details</b> 
                <table style="background-color: #ffcccc" border="0">
                   
                   
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" name="name" value="<?php echo $name; ?>" /></td>
                        </tr>
                        <tr>
                            <td>address:</td>
                            <td><textarea type="text" name="address"><?php echo $address; ?>
                                </textarea></td>
                        </tr>
                           <tr>
                            <td>City:</td>
                            <td><input type="text" name="city" value="Colombo"></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="text" name="email" value="<?php echo $email; ?>" /></td>
                        </tr>
                         
                         <tr>
                            <td>contact number:</td>
                            <td><input type="text" name="contactNumber" value="<?php echo $contactNo; ?>" /></td>
                        </tr>
                        <?php if (!$is_login) {
                                ?>
                        <tr>
                            <td>username:</td>
                            <td><input type="text" name="username"  /></td>
                        </tr>
                         <tr>
                            <td>password:</td>
                            <td><input type="text" name="password" /></td>
                        </tr>
                           
                         <?php       }  ?>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Update Billing Details" /></td>
                        </tr>
                   
                </table>

                </form>
               
        <?php
        include './actions/footer.php';
        ?>
    </body>
</html>

