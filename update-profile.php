<?php include('./partials-front/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <br>
        <br>
        <?php 
            $id = $_GET['id'];

            $sql="SELECT * FROM users where id=$id";

            $res= mysqli_query($conn, $sql);

            if($res == TRUE)
            {
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //echo "Admin Available";
                    $rows= mysqli_fetch_assoc($res);

                                $Uid = $rows['id'];
                                $F_name=$rows['F_name'];
                                $L_name=$rows['L_name'];
                                $email=$rows['email'];
                                $age_req=$rows['age_req'];
                                $username=$rows['username'];
                                $current_sub=$rows['subscription'];
                                $gender=$rows['gender'];
                                $password=$rows['password'];
                }
                else
                {
                    header('location:'.SITEURL.'./profile.php');
                }
            }
        ?>
                                
                                

<section class="food-search">

<div class="conatiner">
<h2 class="text-center text-white">Update Profile</h2>
    <form class="order">
        <fieldset>
        <legend>Update Profile</legend>
        <table>
            <tr>
                <td class="order-label">Username:</td>
                <td>
                    <input class="input-responsive" value="<?php echo $username ?>" type="text" name="username">
                </td>
            </tr>
            <tr>
                <td class="order-label">email:</td>
                <td>
                    <input class="input-responsive" value="<?php echo $email ?>" type="email" name="email">
                </td>
            </tr>
            <tr>
                <td  class="order-label">Age:</td>
                <td>
                    <input value="<?php echo $age_req ?>" class="input-responsive" type="number">
                </td>
            </tr>
            <tr>
                <td class="order-label">Gender:</td>
                <td>
                    <input  type="radio" value="<?php echo $gender ?>" name="gender">Male
                    <input  type="radio" value="<?php echo $gender ?>" name="gender">Female
                    <input  type="radio" value="<?php echo $gender ?>" name="gender">Other
                </td>
            </tr>
            <tr>
                <td class="order-label">Subscription:</td>
                <td>
                    <select class="input-responsive" name="subscription">
                    <?php  ob_start();
                            //Query to Get ACtive Categories
                            $sql = "SELECT * FROM subscription WHERE active='Yes'";
                            //Execute the Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);

                            //Check whether category available or not
                            if($count>0)
                            {
                                //CAtegory Available
                                while($row2=mysqli_fetch_assoc($res))
                                {
                                    $sub_name = $row['sub_name'];
                                    $id = $row['id'];
                                    
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ob_end_flush();
                                    ?>
                                    <option <?php ob_start(); if($current_sub==$id){echo"selected";} ob_end_flush();?> value="<?php ob_start(); echo$id; ob_end_flush();?>"><?php ob_start(); echo$sub_name; ob_end_flush();?></option><?php ob_start();
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
                <td class="order-label">Firts_name:</td>
                <td>
                    <input value="<?php echo $F_name ?>" class="input-responsive" type="text" name="F_name">
                </td>
            </tr>
            <tr>
                <td class="order-label">Last_name:</td>
                <td>
                    <input value="<?php echo $L_name ?>" class="input-responsive" type="text" name="L_name">
                </td>
            </tr>
            <tr>
            <td>
                <a href="<?php echo SITEURL; ?>./update-profile.php?id=<?php echo $id ?>" ></a></td>
                <td colspan="2"><input type="submit" name="submit" value="Submit" class="btn btn-primary1"></td>
            </tr>
        </table>
            
        </fieldset>
    </form>
</div>

</section>

<?php ob_start();
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                                //1. Get all the details from the form
                                $Uid = $rows2['Uid'];
                                $F_name=$rows2['F_name'];
                                $L_name=$rows2['L_name'];
                                $email=$rows2['email'];
                                $age_req=$rows2['age_req'];
                                $username=$rows2['username'];
                                $subscription=$rows2['subscription'];
                                $gender=$rows2['gender'];
                                $password=$rows2['password'];

                //2. Upload the image if selected

                //CHeck whether upload button is clicked or not
               

                

                //4. Update the Food in Database
                $sql3 = "UPDATE users SET
                    username = '$username',
                    F_name = '$F_name',
                    L_name = '$L_name',
                    age_req = '$age_req',
                    email = '$email',
                    subscription = '$subscription',
                    gender = '$gender',
                    
                    WHERE id=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    echo("<script>location.href = '".SITEURL."./profile.php?';</script>");
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'./profile.php');
                }

                
            }
            ob_end_flush();
        ?>
<?php include('./partials-front/footer.php') ?>