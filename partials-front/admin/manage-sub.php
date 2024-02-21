<?php include('./partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">

    
    <h1>Categories</h1>
    <br>
        

        <br>
            <a href="<?php echo SITEURL; ?>admin/add-sub.php" class="btn-primary">Add subscription</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl No.</th>
                    <th>Subscription Name.</th>
                    <th>Subscription Price</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>


                <?php 
                $sql = "SELECT * FROM subscription";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0)
                {
                    //we have data
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $sub_name = $row['sub_name'];
                        $sub_price = $row['sub_price'];
                        $active = $row['active'];
                        

                        ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $sub_name ?></td>
                            <td><?php echo $sub_price ?></td>
                            <td><?php echo $active ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-sub.php?id=<?php echo $id; ?>" class="btn-secondary">Update Subscription</a>
                                <!-- <a href="<?php echo SITEURL; ?>admin/delete-sub.php?id=<?php echo $id; ?>" class="btn-danger">Delete Subscription</a> -->

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
                        <td colspan="6"><div class="error">No Subscription added. </div></td>
                    </tr>
                    <?php 
                }
                ?>

                
            </table>
    </div>
</div>
<?php include('./partials/footer.php'); ?>
