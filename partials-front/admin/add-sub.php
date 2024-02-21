<?php include('./partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Subscription</h1>
        <br>

        

        <br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                 <tr>
                    <td>Subscription Name: </td>
                    <td><input type="text" name="sub_name" placeholder="Enter Subscription"> </td>
                 </tr>

                 <tr>
                    <td>Subscription Price</td>
                    <td>
                        <input type="number" name="sub_price" placeholder="Enter price">
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
                        <input type="submit" name="submit" value=" Add Subscription " class="btn-secondary">
                    </td>
                </tr>
                
            </table>

        </form>


        <?php
        
        if(isset($_POST['submit']))
        {
            //echo 'clicked';

            $sub_name = $_POST['sub_name'];
            $sub_price = $_POST['sub_price'];
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
            

            // print_r($_FILES['image']);

            // die();//break the code.

            $sql = "INSERT INTO subscription SET sub_name='$sub_name', sub_price='$sub_price', active='$active'";

            $res = mysqli_query($conn, $sql);

            
            if($res == TRUE)
            {
                $_SESSION['add'] = "<div class='success'>Subscription added successfully. </div>";

                header('location:'.SITEURL.'admin/manage-sub.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to add Subscription. </div>";

                header('location:'.SITEURL.'admin/manage-sub.php');
            }
        }


        ?>

    </div>
</div>
<?php include('./partials/footer.php'); ?>