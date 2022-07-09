<?php
session_start();
include './dbconnection.php';

$username="";
$password="";

if (isset($_POST['username'])) {$username=$_POST['username'];}
if (isset($_POST['password'])) {$password=$_POST['password'];}

if ($username=="") {header("Location:../login.php?msg=username required");    die();}
if ($password=="") {header("Location:../login.php?msg=password required");    die();}

$selectQuery="SELECT * FROM users WHERE username='".$username."'";
$result=$conn->query($selectQuery);
if($result->num_rows>0){
    //echo 'usr found';
    while ($row = $result->fetch_assoc()) {
        if ($row['is_active']!='1') {
            echo 'inactive user';
        }elseif ($password==$row['password']) {
            $_SESSION['userid']=$row['id_users'];
            $_SESSION['username']=$row['username'];
            $_SESSION['name']=$row['name'];
            $_SESSION['user_type']=$row['user_type'];
            $_SESSION['is_login']=TRUE;
            header("Location:../index.php?msg=welcome to home");      
            die();
            
        } else {
            header("Location:../login.php?msg=invalid password");            
            die(); 
        }
        
    }
    
} else {
    echo 'invalid user';
}