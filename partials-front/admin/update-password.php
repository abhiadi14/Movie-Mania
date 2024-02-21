<?php include('./partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>
            Change Password
        </h1>
        <br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="Cunrrent password"></td>
                </tr>
                <tr>
                    <td>New password: </td>
                    <td><input type="password" name="new_password" placeholder="New Password"></input></td>
                </tr>
                <tr>
                    <td>Confirm password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></input></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);


        $sql = "SELECT * FROM admin WHERE id = '$id' AND Password = '$current_password' ";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE) 
        {
           
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                //echo 'user found';

                if($new_password==$confirm_password)
                {
                    //echo 'password match';
                    $sql2 = "UPDATE admin SET password='$new_password' 
                    WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==TRUE)
                    {
                        $_SESSION['change-pwd'] = "<div class='success'>Passwords changed Successfully. </div>";

                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['change-pwd'] = "<div class='error'>Passwords change Failed. </div>";

                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['pwd-no-match'] = "<div class='error'>Passwords dont match. </div>";

                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['user-not-found'] = "<div class='error'>User not found. </div>";

                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    }
?>

<?php include('./partials/footer.php') ?>