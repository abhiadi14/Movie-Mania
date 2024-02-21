<?php include('./partials-front/menu.php') ?>
<?php 
        
        if(isset($_GET['id']))
        {
           //echo 'getting data';
           $movie_id = $_GET['id'];

           
        }
        else
        {
            header('location:'.SITEURL.'./foods.php');
        }

                    $sql = "SELECT * FROM users";
                    $res = mysqli_query($conn, $sql);
                    $count  = mysqli_num_rows($res);
                    $sn=1;
                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res))
                        {
                                $user_id = $rows['id'];
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
<div class="container1">
    <section class="food-search">
        <div class="container">
            <form action="#" class="order" method="POST" enctype="multipart/form-data" >
                <fieldset>
                    <legend>Review</legend>
    
                    <div class="food-menu-desc">
                        

                        
                        <div class="order-label">Review:</div>
                        <textarea class="input-responsive" name="review" cols="50" rows="5"></textarea>
                        <div>
                            <input class="order-label" type="radio" value="1" name="like">Like
                            <input class="order-label" type="radio" value="1" name="dislike">Dislike
                        </div>
                        <div>
                            <input type="submit"name="submit" value="Add Review" class="btn btn-primary1">
                        </div>
                        
                    </div>

                </fieldset>
            </form>
            <br>
            <br>
            
            <?php 
        
            if(isset($_POST['submit']))
            {
                $review = $_POST['review'];

                $like = $_POST['like'];

                $dislike = $_POST['dislike'];

                $review = $_POST['review'];

            
                
                // print_r($_FILES['image']);

                // die();//break the code.

                $sql = "INSERT INTO review SET likes ='$like', dislikes = '$dislike' , review='$review', movie_id = '$movie_id', user_id ='$user_id'";

                $res = mysqli_query($conn, $sql);

                
                if($res == TRUE)
                {
                    $_SESSION['add'] = "<div class='success'>Genre added successfully. </div>";

                    echo("<script>location.href = '".SITEURL."./watch.php?';</script>");
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to add Genre. </div>";

                    header('location:'.SITEURL.'./watch.php');
                }
            }


        ?>

        </div>
    </section>
</div>
<?php include('./partials-front/footer.php') ?>