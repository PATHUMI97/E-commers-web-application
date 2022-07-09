<?php
session_start();
include './dbconnection.php';

$userid="";
$is_login="";

if (isset($_SESSION['is_login'])) {
   $is_login =$_SESSION['is_login'];
}

if (isset($_SESSION['userid'])) {
   $userid =$_SESSION['userid'];
}

if ($is_login!=true) {
    header("Location:../login.php?msg=please login again");    die();
}

$name="";
$email="";
$contactNo="";
$address="";
$password="";

if (isset($_POST['name'])) {$name=$_POST['name'];}
if (isset($_POST['email'])) {$email=$_POST['email'];}
if (isset($_POST['contactNo'])) {$contactNo=$_POST['contactNo'];}
if (isset($_POST['address'])) {$address=$_POST['address'];}
if (isset($_POST['password'])) {$password=$_POST['password'];}


if ($name=="") {header("Location:../profile.php?msg=name required");    die();}
if ($email=="") {header("Location:../profile.php?msg=email required");    die();}
if ($contactNo=="") {header("Location:../profile.php?msg=contact no required");    die();}
if ($address=="") {header("Location:../profile.php?msg=address required");    die();}
if ($password=="") {header("Location:../profile.php?msg=password required");    die();}


$updateUser="UPDATE users SET name='".$name."',email='".$email."',password='".$password."',contact_no='".$contactNo."',address='".$address."' WHERE id='".$userid."' ";
$result=$conn->query($updateUser);
if ($result===TRUE) {
    header("Location:../profile.php?msg=updated");    die();
}else{
    header("Location:../profile.php?msg=update failed");    die();
}

?>
