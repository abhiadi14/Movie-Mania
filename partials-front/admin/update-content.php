<?php ob_start(); include('partials/menu.php'); ob_end_flush();?>
<?php ob_start();
    //CHeck whether id is set or not 
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected Food
        $sql2 = "SELECT * FROM movies WHERE id=$id";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected Food
        $title = $row2['title'];
        $description = $row2['description'];
        $revenue = $row2['revenue'];
        $age_req = $row2['age_req'];
        $current_image = $row2['image_name'];
        $current_genre = $row2['genre'];
        $featured = $row2['featured'];
        $active = $row2['active'];
        $actor = $row2['actor'];
        $producer = $row2['producer'];
        $director = $row2['director'];

    }
    else
    {
        //Redirect to Manage Food
        header('location:'.SITEURL.'admin/manage-content.php');
    }
    ob_end_flush();
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php ob_start(); echo$title; ob_end_flush();?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php ob_start(); echo$description; ob_end_flush();?></textarea>
                </td>
            </tr>

            <tr>
                <td>Revenue:</td>
                <td>
                    <input type="number" name="revenue" value="<?php ob_start(); echo$revenue;ob_end_flush();?>" >
                </td>
            </tr>
            <tr>
                <td>Age-Requirement:</td>
                <td>
                    <input type="number" name="age_req" value="<?php ob_start(); echo$age_req;ob_end_flush();?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td><?php ob_start();
                        if($current_image == "")
                        {
                            //Image not Available 
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image Available
                            ob_end_flush(); ?>
                            <img src="<?php ob_start(); echo SITEURL; ob_end_flush();?>images/movies/<?php ob_start(); echo$current_image; ob_end_flush();?>" width="150px"><?php  ob_start();
                        }
                    ob_end_flush();
                ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="genre">
                    <?php  ob_start();
                            //Query to Get ACtive Categories
                            $sql = "SELECT * FROM genre WHERE active='Yes'";
                            //Execute the Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);

                            //Check whether category available or not
                            if($count>0)
                            {
                                //CAtegory Available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $genre_title = $row['title'];
                                    $genre_id = $row['id'];
                                    
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ob_end_flush();
                                    ?>
                                    <option <?php ob_start(); if($current_genre==$genre_id){echo"selected";} ob_end_flush();?> value="<?php ob_start(); echo$genre_id; ob_end_flush();?>"><?php ob_start(); echo$genre_title; ob_end_flush();?></option><?php ob_start();
                                }
                            }
                            else
                            {
                                //CAtegory Not Available
                                echo "<option value='0'>Category Not Available.</option>";
                            }
                        ob_end_flush();
                    ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php ob_start(); if($featured=="Yes") {echo"checked";}ob_end_flush();?> type="radio" name="featured" value="Yes"> Yes 
                    <input <?php ob_start(); if($featured=="No") {echo"checked";}ob_end_flush();?> type="radio" name="featured" value="No"> No 
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php ob_start(); if($active=="Yes") {echo"checked";}ob_end_flush();?> type="radio" name="active" value="Yes"> Yes 
                    <input <?php ob_start(); if($active=="No") {echo"checked";}ob_end_flush();?> type="radio" name="active" value="No"> No 
                </td>
            </tr>

            <tr>
                <td>Actor:</td>
                <td>
                    <input type="text" name="actor" value="<?php echo $actor ?> " >
                </td>
            </tr>
            <tr>
                <td>Producer:</td>
                <td>
                    <input type="text" name="producer" value="<?php echo $producer ?> " >
                </td>
            </tr>
            <tr>
                <td>Director:</td>
                <td>
                    <input type="text" name="director" value="<?php echo $director ?> " >
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php ob_start(); echo$id;ob_end_flush();?>">
                    <input type="hidden" name="current_image" value="<?php ob_start(); echo$current_image; ob_end_flush();?>">

                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        
        </form>
        <?php ob_start();
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $revenue = $_POST['revenue'];
                $age_req = $_POST['age_req'];
                $current_image = $_POST['current_image'];
                $genre = $_POST['genre'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $actor = $_POST['actor'];
                $producer = $_POST['producer'];
                $director = $_POST['director'];

                //2. Upload the image if selected

                //CHeck whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload BUtton Clicked
                    $image_name = $_FILES['image']['name']; //New Image NAme

                    //CHeck whether th file is available or not
                    if($image_name!="")
                    {
                        //IMage is Available
                        //A. Uploading New Image

                        //REname the Image

                        $tmp = explode('.', $image_name);
                        $ext = end($tmp); //Gets the extension of the image //Gets the extension of the image

                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; //THis will be renamed image

                        //Get the Source Path and DEstination PAth
                        $src_path = $_FILES['image']['tmp_name']; //Source Path
                        $dest_path = "../images/movies/".$image_name; //DEstination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        /// CHeck whether the image is uploaded or not
                        if($upload==false)
                        {
                            //FAiled to Upload
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                            //REdirect to Manage Food 
                            header('location:'.SITEURL.'admin/manage-content.php');
                            //Stop the Process
                            die();
                        }
                        //3. Remove the image if new image is uploaded and current image exists
                        //B. Remove current Image if Available
                        if($current_image!="")
                        {
                            //Current Image is Available
                            //REmove the image
                            $remove_path = "../images/movies/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false)
                            {
                                //failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
                                //redirect to manage food
                                header('location:'.SITEURL.'admin/manage-content.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Default Image when Image is Not Selected
                    }
                }
                else
                {
                    $image_name = $current_image; //Default Image when Button is not Clicked
                }

                

                //4. Update the Food in Database
                $sql3 = "UPDATE movies SET
                    title = '$title',
                    description = '$description',
                    revenue = '$revenue',
                    age_req = '$age_req',
                    image_name = '$image_name',
                    genre = '$genre',
                    featured = '$featured',
                    active = '$active',
                    actor = '$actor',
                    producer = '$producer',
                    director = '$director'
                    WHERE id=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    echo("<script>location.href = '".SITEURL."admin/manage-content.php?';</script>");
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }
            ob_end_flush();
        ?>

    </div>
</div>

<?php ob_start(); include('partials/footer.php'); ob_end_flush();?>