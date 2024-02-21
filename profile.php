<?php include('./partials-front/menu.php') ?>
<?php
                
                    $sql = "SELECT * FROM users";
                    $res = mysqli_query($conn, $sql);
                    $count  = mysqli_num_rows($res);
                    $sn=1;
                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res))
                        {
                                $id = $rows['id'];
                                $F_name=$rows['F_name'];
                                $L_name=$rows['L_name'];
                                $email=$rows['email'];
                                $age_req=$rows['age_req'];
                                $username=$rows['username'];
                                $sub=$rows['subscription'];
                                $gender=$rows['gender'];
                                
                            

                        }
                    }
                    else
                    {
                        echo"<tr><td colspan='7' class='error'>Content not Available. </td></tr>";
                    }
?>

                                

<section class="food-search">

<div class="conatiner">
<h2 class="text-center text-white">User Profile</h2>
    <form class="order">
        <fieldset>
        <legend>Profile</legend>
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
                    <input class="input-responsive" value="<?php echo $age_req ?>" type="number">
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
                        <select class="input-responsive" name="genre">

                            <?php
                                //to display catogaries from database.
                                $sql2 = "SELECT * FROM subscription WHERE active='Yes'";
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);
                                if($count2>0)
                                {
                                    while($row2=mysqli_fetch_assoc($res2))
                                    {
                                        $id = $row2['id'];
                                        $sub_name = $row2['sub_name'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $sub_name ?></option>
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
            <td colspan="2">
            <a href="<?php echo SITEURL; ?>./update-profile.php?id=<?php echo $id ?>" class="btn-primary1">Update Profile</a>
            </td>
        
            </tr>
        </table>
            
        </fieldset>
    </form>
</div>
    
</section>
<?php include('./partials-front/footer.php') ?>