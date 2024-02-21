<?php 
    //check whether the user is logged in
    //Authorization
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login-msg'] = "<div class='error'>PLease Login to access Admin Panel</div>";

        header('location:'.SITEURL.'admin/login.php');

    }
?>