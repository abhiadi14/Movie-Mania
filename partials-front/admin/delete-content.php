<?php

    include('../config/constants.php');
    //echo "delete content."
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name!= ""){
            $path = "../images/movies/".$image_name;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to remove Image</div>";
                header('location:'.SITEURL.'admin/manage-content.php');
                die();
            }
            $sql = "DELETE FROM movies WHERE id=$id";
            $res = mysqli_query($conn,$sql);
            if($res==true)
            {
                $_SESSION['upload'] = "<div class='success'>Deletion successful</div>";
                header('location:'.SITEURL.'admin/manage-content.php');
            }
            else
            {
                $_SESSION['upload'] = "<div class='error'>Deletion Failed</div>";
                header('location:'.SITEURL.'admin/manage-content.php');
            }
        }
    }
    else
    {
        $_SESSION['delete'] = "<div class = 'error' >Unauthorized Access. </div>";
        header('location:'.SITEURL.'admin/manage-content.php');
    }
?>