<?php include('./partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Content</h1>
        <br>
        <?php
            if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Movie Title:</td>
                    <td>
                        <input type="text" name="title"  placeholder="Enter Movie Title.">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Enter decription of the movie"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Revenue: </td>
                    <td>
                        <input type="number" name="revenue" placeholder="Revenue in Rupees. ">
                    </td>
                </tr>
                <tr>
                    <td>Age-Requirement: </td>
                    <td>
                        <input type="number" name="age_req" placeholder="Age-Required">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="genre">

                            <?php
                                //to display catogaries from database.
                                $sql = "SELECT * FROM genre WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                echo $count;
                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No Genre Found</option>
                                    <?php
                                }
                            ?>

                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value='Yes'>Yes
                        <input type="radio" name="featured" value='No'>No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value='Yes'>Yes
                        <input type="radio" name="active" value='No'>No
                    </td>
                </tr>
                <tr>
                    <td>Actor:</td>
                    <td>
                        <input type="text" name="actor">
                    </td>
                </tr>
                <tr>
                    <td>Producer:</td>
                    <td>
                        <input type="text" name="producer">
                    </td>
                </tr>
                <tr>
                    <td>Director:</td>
                    <td>
                        <input type="text" name="director">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value=" Add Content " class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        
            if(isset($_POST['submit']))
            {
                //echo 'clicked';
                $title = $_POST['title'];
                $description = $_POST['description'];
                $revenue = $_POST['revenue'];
                $age_req = $_POST['age_req'];
                $genre = $_POST['genre'];
                $actor = $_POST['actor'];
                $producer = $_POST['producer'];
                $director = $_POST['director'];

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }
                
                if(isset($_FILES['image']['name']))
                {
                    //get detaild of the selected image.
                    $image_name = $_FILES['image']['name'];
                    if($image_name!=""){
                        //image is selected.
                        //rename and upload
                        $tmp = (explode('.',$image_name));
                        $ext = end($tmp);

                        $image_name = "content_".rand(0000,9999).'.'.$ext;

                        $src=$_FILES['image']['tmp_name'];

                        $dst = "../images/movies/".$image_name;

                        $upload = move_uploaded_file($src, $dst);

                        if($upload == false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                            header('location:'.SITEURL.'admin/add-content.php');
                            die();
                        }


                    }
                }
                else
                {
                    $image_name= "";
                }

                $sql2 = "INSERT INTO movies SET
                    title ='$title',
                    description = '$description',
                    revenue = $revenue,
                    age_req = '$age_req',
                    image_name = '$image_name',
                    genre = $genre,
                    featured = '$featured',
                    active = '$active',
                    actor = '$actor',
                    producer = '$producer',
                    director = '$director'
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == TRUE)
                {
                    //data inserted.
                    $_SESSION['add'] = "<div class='success'>Content added successfully</div>";
                    echo("<script>location.href = '".SITEURL."admin/manage-content.php?';</script>");

                }
                else
                {
                    //Filed
                    $_SESSION['upload'] = "<div class='error'>Faailed to Upload Image</div>";
                            header('location:'.SITEURL.'admin/add-content.php');
                }

            }

        ?>

    </div>
</div>

<?php include('./partials/footer.php') ?>