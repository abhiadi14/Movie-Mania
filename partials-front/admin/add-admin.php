<?php include('./partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
        <form action="" method="POST">

        <table class="tbl-30"><br>
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter full name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Password" ></td>

                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('./partials/footer.php'); ?>

<?php 
    //process  the value from form and save it in database
    if(isset($_POST['submit']))
    {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //encrypted md5

        //sql query
        $sql = "INSERT INTO admin SET 
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        //executeing query
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //check
        if($res == TRUE)
        {
            //echo('data inserted');
            $_SESSION['add'] = 'Admin added successfully';
            //redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //echo('data not inserted');
            $_SESSION['add'] = 'Failed to add ADmin';
            //redirect
            header('location:'.SITEURL.'admin/add-admin.php');
        }
    }
?>