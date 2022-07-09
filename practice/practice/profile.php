<?php
if(session_id() == '') {
    session_start();
  }
include './actions/dbconnection.php';
$userid="";
$is_login="";

if (isset($_SESSION['is_login'])) {
    $is_login = $_SESSION['is_login'];
}

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}


if ($is_login!=true) {
    header("Location:login.php?msg=please login again");    die();
}

$getProfileData="SELECT * FROM users WHERE id_users='" . $userid . "'";

$result = $conn->query($getProfileData);

$name="";
$email="";
$username="";
$address="";
$password="";
$contactNo="";

if($result==true &&$result->num_rows>0) {
    if($row=$result->fetch_assoc()){
        $name=$row['name'];
        $email=$row['email'];
        $username=$row['username'];
        $address=$row['address'];
        $password=$row['password'];
        $contactNo=$row['contact_no'];
        
    }
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
           
            <h2>PROFILE</h2>
            <img src="imgs/profileImage.jfif" width="261" height="193" />
            <form action="actions/updateUser.php" method="post">
                <table border="0" style="background: #ffcccc">
                    
                    
                        <tr>
                            <td>id</td>
                            <td><?php echo $userid;?></td>
                        </tr>
                        <tr>
                            <td>name</td>
                            <td><input type="text" name="name" value="<?php echo $name;?>" /></td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td><input type="text" name="email" value="<?php echo $email;?>" /></td>
                        </tr>
                        <tr>
                            <td>username</td>
                            <td><?php echo $username;?></td>
                        </tr>
                        
                        <tr>
                            <td>contact no</td>
                            <td><input type="text" name="contactNo" value="<?php echo $contactNo;?>" /></td>
                        </tr>
                        <tr>
                            <td>address</td>
                            <td><input type="text" name="address" value="<?php echo $address;?>" /></td>
                        </tr>
                        <tr>
                            <td>password</td>
                            <td><input type="password" name="password" value="<?php echo $password;?>" /></td>
                        </tr>
                        
                       <tr>
                           <td><a href="actions/deactivateProfile.php">Deactivate Account</a></td>
                    <td><input type="submit" value="Update Account Details" /></td>
                </tr>
                   
                </table>

            </form>
        </div><?php include './includes/footer.php';?>
    </body>
</html>
