<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link type="text/css" rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
         <?php
                   include './includes/header.php';
            ?>
        <div align="center">
            <h2>LOGIN</h2>
            
            <form action="actions/loginAction.php" method="POST">
                <table border="0" style="background: #ffcccc;">
                    
                    
                        <tr>
                            <td>Username</td>
                            <td><input type="text" name="username" value="" /></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="text" name="password" value="" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="LOGIN" /></td>
                        </tr>
                    
                </table>

            </form>
        </div>
        <?php include './includes/footer.php';?>
    </body>
</html>
