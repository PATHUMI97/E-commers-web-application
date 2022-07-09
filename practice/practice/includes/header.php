<?php 
if(session_id() == '') {
    session_start();
}

 $is_login = false;
 $user_type = "";
if(isset($_SESSION['is_login'])){
    $is_login = $_SESSION['is_login'];
}


if(isset($_SESSION['user_type'])){
    $user_type = $_SESSION['user_type'];
}


?>

<style>
    .center{
        display: flex;
        align-items: center;
        justify-content: center;
        justify-content: space-between;
        background-color: #006666;
        color: white;
    }
    .menu{
        display: flex;
        align-items: center;
        justify-content: center;
        justify-content: space-between;
        width: 350px;
        list-style-type: none;
    }


</style>


<header class="center">
    <div><h2>CODEFEST-2021</h2></div>
    <div>
        <ul class="menu">
            <a href="index.php"> <li>home</li></a>
            <a href="advancedSearch.php"> <li>search</li></a>
            <a href="cart.php"> <li>cart</li></a>
            <a href="profile.php"> <li>profile</li></a>
            <?php if ($user_type==1){
                ?>
            <li><a href="admin.php">Admin</a></li>
               <?php
            }?>
            <li>about us</li>
            <li>contact us</li>
        </ul>
    </div>
    <div>
        <?php
        if($is_login){
            ?>  
        <a href="actions/logout.php">Logout</a>
        <?php 
       }else{
            ?>
        <a href="login.php">Login</a>  
        <a href="register.php">Register</a>
        <?php  
        }
        ?>
        </div>
</header><hr>
   <?php
            if (isset($_GET['msg'])) {
                ?>
            <p style="color: red"><?php echo $_GET['msg']; ?></p>

                <?php
            }
            ?>
<hr>