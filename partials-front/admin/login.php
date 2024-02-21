<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login - Movie Database</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body1>
      
        <div class="login">
            <h1 class='motiv'>
                Login
            </h1>
            <br>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-msg']))
                {
                    echo $_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
                }
            ?>
            <br>
            <form method="POST">
                <label class="motiv3">Username:</label><br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                <label class="motiv3">Password:</label><br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
        </div>
       
    </body1>
</html>

<?php 
    if(isset($_POST['submit']))
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);


        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            //user available
            $_SESSION['login'] = "<div class='success'>Login Successful. </div>";

            $_SESSION['user'] = $username;

            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available
            $_SESSION['login'] = "<div class='error'>Login Failed. Username or Password did not match. </div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>

<?php include('./partials/footer.php'); ?>