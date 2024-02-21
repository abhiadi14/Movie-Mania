<?php include('./partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Subscription</h1>
        <br>

        <?php 
        
            if(isset($_GET['id']))
            {
               //echo 'getting data';
               $id = $_GET['id'];

               $sql = "SELECT * FROM subscription WHERE id=$id";

               $res = mysqli_query($conn, $sql);

               $count = mysqli_num_rows($res);

               if($count==1)
               {
                    $row = mysqli_fetch_assoc($res);

                    $sub_name = $row['sub_name'];
                    $sub_price = $row['sub_price'];
                    $active = $row['active'];
               }
               else
               {
                    $_SESSION['no-genre'] = "<div class='error'>No Subscriptions Found</div>";
                    header('location:'.SITEURL.'admin/manage-sub.php');
               }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-sub.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">       
            <table class="tbl-30">
                <tr>
                    <td>Subscription Name:</td>
                    <td>
                        <input type="text" name="sub_name"  value="<?php echo $sub_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Subscription Price:</td>
                    <td>
                        <input type="number" name="sub_price"  value="<?php echo $sub_name; ?>">
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
                       
                        <input type="hidden" name="id" value="<?php echo $id;?>" >
                        <input type="submit" name="submit" value=" Update Subscription " class="btn-secondary" >
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        
            if(isset($_POST['submit'])){
                //echo 'clicked';
                $id = $_POST['id'];
                $sub_name = $_POST['sub_name'];
                $sub_price = $_POST['sub_price'];
                $active = $_POST['active'];
                

                
                

                $sql2 = "UPDATE subscription SET sub_name='$sub_name', sub_price = '$sub_price', active='$active' WHERE id = $id";

                $res = mysqli_query($conn, $sql2);

                if($res == TRUE)
                {
                    $_SESSION['update'] = "<div class='success'>Subscription updated successfully. </div>";
                    header('location:'.SITEURL.'admin/manage-sub.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Subscription update Failed. </div>";
                    header('location:'.SITEURL.'admin/manage-sun.php');
                }




                
            }

        ?>
    </div>
</div>
<?php include('./partials/footer.php')?>