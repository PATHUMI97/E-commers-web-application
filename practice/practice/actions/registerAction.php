<?php

include './dbconn.php';

$name="";
$email="";
$username="";
$contactNo="";
$address="";
$password="";
$confPassword="";

if (isset($_POST['name'])) {$name=$_POST['name'];}
if (isset($_POST['email'])) {$email=$_POST['email'];}
if (isset($_POST['username'])) {$username=$_POST['username'];}
if (isset($_POST['contactNo'])) {$contactNo=$_POST['contactNo'];}
if (isset($_POST['address'])) {$address=$_POST['address'];}
if (isset($_POST['password'])) {$password=$_POST['password'];}
if (isset($_POST['confirmPassword'])) {$confPassword=$_POST['confirmPassword'];}

if ($name=="") {header("Location:../register.php?msg=name required");    die();}
if ($email=="") {header("Location:../register.php?msg=email required");    die();}
if ($username=="") {header("Location:../register.php?msg=username required");    die();}
if ($contactNo=="") {header("Location:../register.php?msg=contact no required");    die();}
if ($address=="") {header("Location:../register.php?msg=address required");    die();}
if ($password=="") {header("Location:../register.php?msg=password required");    die();}
if ($confPassword=="") {header("Location:../register.php?=confirm password required");    die();}
if (!$confPassword==$password) {header("register:../loging.php?msg=not equals to entered password");    die();}

$insertQuery="INSERT INTO users (name,email,username,password,contact_no,address,user_type,is_active) VALUES('".$name."','".$email."','".$username."','".$password."','".$contactNo."','".$address."','2','1')";
$result=$conn->query($insertQuery);
if ($result===TRUE) {
    echo $name;
    header("Location:../login.php?msg=user registered successfully please login");    die();
    
} else {
    echo 'something went wrong'.$conn->error;

}
?>

