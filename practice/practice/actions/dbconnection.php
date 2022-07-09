<?php
$username ="root";
$password ="pathu@1997.4";
$database ="codefest";
$host ="localhost";
$port = "3307";

$conn= new mysqli($host,$username,$password,$database,$port);

if ($conn->connect_error) {
    echo 'error'.$conn->connect_error;
}else{
    //echo 'connected';
}
?>


