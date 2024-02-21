<?php include('./partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">

    
    <h1>Content</h1>
    <br>
    
    <?php
            if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
            }
            if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
            }
            if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
            }
            if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
            }
    ?>
    <br>
    <br>
            <a href="<?php echo SITEURL;?>admin/add-content.php" class="btn-primary">Add Content</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl.No</th>
                    <th>Title</th>
                    <th>Revenue</th>
                    <th>Age-req</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                    <th>Actor</th>
                    <th>Producer</th>
                    <th>Director</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM movies";
                    $res = mysqli_query($conn, $sql);
                    $count  = mysqli_num_rows($res);
                    $sn=1;
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $revenue = $row['revenue'];
                            $age_req = $row['age_req'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            $actor = $row['actor'];
                            $producer = $row['producer'];
                            $director = $row['director'];
                            ?>

                                <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo $title ?></td>
                                    <td>Rs.<?php echo $revenue ?></td>
                                    <td><?php echo $age_req ?></td>
                                    <td>
                                        <?php 
                                            if($image_name=="")
                                            {
                                                echo"<div class='error'>Image unavailable. </div>";
                                            }
                                            else
                                            {
                                                ?>
                                                    <img src="<?php echo SITEURL;?>images/movies/<?php echo $image_name; ?>"width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured ?></td>
                                    <td><?php echo $active ?></td>

                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-content.php?id=<?php echo $id ?>" class="btn-secondary">Update Content</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-content.php?id=<?php echo $id ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Content</a>

                                    </td>
                                    <td><?php echo $actor ?></td>
                                    <td><?php echo $producer ?></td>
                                    <td><?php echo $director ?></td>
                                </tr>

                            <?php

                        }
                    }
                    else
                    {
                        echo"<tr><td colspan='7' class='error'>Content not Available. </td></tr>";
                    }
                ?>

                
            </table>
    </div>
</div>
<?php include('./partials/footer.php'); ?>