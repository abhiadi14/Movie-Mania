<?php include('./partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>

        <?php 
        
            if(isset($_GET['id']))
            {
               //echo 'getting data';
               $id = $_GET['id'];

               $sql = "SELECT * FROM genre WHERE id=$id";

               $res = mysqli_query($conn, $sql);

               $count = mysqli_num_rows($res);

               if($count==1)
               {
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_image = $row['img_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
               }
               else
               {
                    $_SESSION['no-genre'] = "<div class='error'>No Genres Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
               }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">       
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title"  value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image!= "")
                            {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image Not Found. </div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == 'Yes'){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == 'No'){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input <?php if($active == 'Yes'){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active == 'No'){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <input type="submit" name="submit" value=" Update Category " class="btn-secondary" >
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        
            if(isset($_POST['submit'])){
                //echo 'clicked';
                $id = $_POST['id'];
                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $current_image = $_POST['current_image'];

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name!= "")
                    {
                        //image available
                        //upload new image and remove current image
                        $tmp = (explode('.',$image_name));
                        $ext = end($tmp);

                        $image_name = 'genere_'.rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destinaton_path = "../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destinaton_path);

                        if($upload == FALSE){
                            $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";

                            header('location:'.SITEURL.'admin/manage-category.php');

                            die();
                        }


                        if($current_image!= "")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            if($remove == false)
                            {
                                //failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image. </div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();//stop the process
                            }
                        }

                        

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                $sql2 = "UPDATE genre SET title='$title', featured = '$featured', active='$active', img_name='$image_name' WHERE id=$id";

                $res = mysqli_query($conn, $sql2);

                if($res == TRUE)
                {
                    $_SESSION['update'] = "<div class='success'>Genre updated successfully. </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Genre update Failed. </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }




                
            }

        ?>
    </div>
</div>
<?php include('./partials/footer.php')?>