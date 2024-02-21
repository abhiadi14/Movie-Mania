<?php include('./partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">

    
    <h1>Categories</h1>
    <br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-genre']))
            {
                echo $_SESSION['no-genre'];
                unset($_SESSION['no-genre']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>

        <br>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl No.</th>
                    <th>Title</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>


                <?php 
                $sql = "SELECT * FROM genre";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0)
                {
                    //we have data
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        $image_name = $row['img_name'];

                        ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $title ?></td>
                            <td><?php echo $featured ?></td>
                            <td><?php echo $active ?></td>
                            <td>
                                <?php 
                                    //check whether image_name is available .
                                    if($image_name!="")
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name?>" width="100px">
                                        <?php
                                    }
                                    else
                                    {
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                <!-- <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name?>" class="btn-danger">Delete Category</a> -->

                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    //no data
                    ?>
                    <tr>
                        <td colspan="6"><div class="error">No Category added. </div></td>
                    </tr>
                    <?php 
                }
                ?>

                
            </table>
    </div>
</div>
<?php include('./partials/footer.php'); ?>
