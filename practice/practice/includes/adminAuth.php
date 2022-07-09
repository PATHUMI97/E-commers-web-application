<?php
  $user_type = 0;
    if(isset($_SESSION['user_type'])){
    $user_type = $_SESSION['user_type'];
}
echo $user_type;
if ($user_type!=1){
header("Location: index.php?msg=You attempt to visit Admin Area with a customer account !!!");
die();
}