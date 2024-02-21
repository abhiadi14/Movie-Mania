 <?php --> -->
    include('../config/constants.php');
    echo "delete page"
    if(isset($_GET['id'])  AND  isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/category/".$image_name;
            $remove = unlink($path);

            if($remove == FALSE)
            {
                $_SESSION['remove'] = "<div class='error'>Delete Failed. </div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }

        }

        $sql="DELETE FROM genre WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>Genre Deleted. </div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Failed to Deleted Genre. </div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    } 
    else
    {
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>

