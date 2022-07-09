<?php
session_start();
include '../errorHandling.php';
include './dbconnection.php';
$is_login = "";
$userid = "";
if (isset($_SESSION['is_login'])) {$is_login = $_SESSION['is_login'];}
if (isset($_SESSION['userid'])) {$userid = $_SESSION['userid'];}

$deactivate="UPDATE users SET is_active ='0' WHERE id_users='".$userid."'";
$result = $conn->query($deactivate);

if($result===TRUE){
    header("Location:./logout.php");die(); 
}else{
     header("Location:../profile.php?msg=account deactivation failed");die(); 
}
?>
