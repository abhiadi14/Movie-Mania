<?php include('./partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Genre</h1>
        <br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                 <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Genre Title"> </td>
                 </tr>

                 <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                 </tr>
                 <tr>

                    <td>Featured: </td>
                    <td><input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No

                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value=" Add Genre " class="btn-secondary">
                    </td>
                </tr>
                
            </table>

        </form>


        <?php
        
        if(isset($_POST['submit']))
        {
            //echo 'clicked';

            $title = $_POST['title'];

            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }
            else
            {
                $featured= "No";
            }

            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }
            else
            {
                $active= "No";
            }

            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];

                if($image_name!="")
                {
                    $tmp = (explode('.',$image_name));
                    $ext = end($tmp);

                    $image_name = 'genere_'.rand(000, 999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destinaton_path = "../images/category/".$image_name;

                    $upload = move_uploaded_file($source_path, $destinaton_path);

                    if($upload == FALSE){
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";

                        header('location:'.SITEURL.'admin/add-category.php');

                        die();
                    }
                            
                }

            }
            else
            {
                $image_name="";
            }

            // print_r($_FILES['image']);

            // die();//break the code.

            $sql = "INSERT INTO genre SET title='$title', featured='$featured', active='$active', img_name='$image_name'";

            $res = mysqli_query($conn, $sql);

            
            if($res == TRUE)
            {
                $_SESSION['add'] = "<div class='success'>Genre added successfully. </div>";

                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to add Genre. </div>";

                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }


        ?>

    </div>
</div>
<?php include('./partials/footer.php'); ?>