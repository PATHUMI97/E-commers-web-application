<!DOCTYPE html>

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
            <h2>REGISTER</h2>
           
            <form action="actions/registerAction.php" method="post">
                <table border="0" style="background: activecaption">
                    
                    
                        <tr>
                            <td>name</td>
                            <td><input type="text" name="name" value="" /></td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td><input type="text" name="email" value="" /></td>
                        </tr>
                        <tr>
                            <td>username</td>
                            <td><input type="text" name="username" value="" /></td>
                        </tr>
                        
                        <tr>
                            <td>contact no</td>
                            <td><input type="text" name="contactNo" value="" /></td>
                        </tr>
                        <tr>
                            <td>address</td>
                            <td><input type="text" name="address" value="" /></td>
                        </tr>
                        <tr>
                            <td>password</td>
                            <td><input type="password" name="password" value="" /></td>
                        </tr>
                        <tr>
                            <td>confirm password</td>
                            <td><input type="password" name="confirmPassword" value="" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="register" /></td>
                        </tr>
                   
                </table>

            </form>
        </div><?php include './includes/footer.php';?>
    </body>
</html>
