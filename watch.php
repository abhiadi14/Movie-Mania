<?php include('./partials-front/menu.php') ?>
<div class="container1">

<?php 
        
        if(isset($_GET['id']))
        {
           //echo 'getting data';
           $id = $_GET['id'];

           $sql2 = "SELECT * FROM movies WHERE id=$id";

           $res2 = mysqli_query($conn, $sql2);

           $count2 = mysqli_num_rows($res2);

           if($count2==1)
           {
                $row2 = mysqli_fetch_assoc($res2);

                $movietitle = $row2['title'];
                $movie_descreiption = $row2['description'];
                $movie_revenue = $row2['revenue'];
                $movie_actor = $row2['actor'];
                $movie_producer = $row2['producer'];
                $movie_director = $row2['director'];
           }
           else
           {
                $_SESSION['no-genre'] = "<div class='error'>No Genres Found</div>";
                header('location:'.SITEURL.'./foods.php');
           }
        }
        else
        {
            header('location:'.SITEURL.'./foods.php');
        }

    ?>
    <section class="food-search1">
        <br>
        <video class="video" autoplay src="./video/engstudent.mp4"  width="1200px" height="750px" style="background-color:black" type="video/mp4" controls></video>
        <div class="container">
            <a href="<?php echo SITEURL; ?>./add-review.php?id=<?php echo $id ?>" class="btn-primary1">Add Review</a>
            <br><br>
            <table class="tbl-full">
                <tr class="reviewtext">
                    <th>Sl No.</th>
                    <th>Review</th>
                    <th>Likes</th>
                    <th>Dislikes</th>
                    
                </tr>
                <!-- <php
                $sql4 = "SELECT * FROM users WHERE id = '$id'";
                $res4 = mysqli_query($conn, $sql4);

                $count4 = mysqli_num_rows($res4);


                if($count4>0)
                {
                    //we have data
                    while($row4=mysqli_fetch_assoc($res4))
                    {
                        $username = $row4['username'];
                    }
                }
                else
                {
                    //no data
                    ?>
                    <tr>
                        <td colspan="6"><div class="error">No Review added. </div></td>
                    </tr>
                    <php 
                }

                ?> -->
                <?php 
                $sql = "SELECT * FROM review WHERE movie_id = '$id' ";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn=1;

                $like_count = 0;
                $dislike_count = 0;

                if($count>0)
                {
                    //we have data
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['user_id'];
                        $review = $row['review'];
                        $likes = $row['likes'];
                        $dislikes = $row['dislikes'];
                       
                        $sql5 = "SELECT * FROM users WHERE id = '$id'";

                        $res5 = mysqli_query($conn, $sql5);

                        $count = mysqli_num_rows($res5);

                        while($row5=mysqli_fetch_assoc($res5))
                        {
                            $username = $row5['username'];
                        }
                        ?>

                        
                        <tr class="reviewtext">
                            <td ><?php echo $username ?></td>
                            <td ><?php echo $review ?></td>
                            <td><?php echo $likes?></td>
                            <td><?php echo $dislikes?></td>
                            
                            
                                <?php 
                                    if($likes == '1')
                                    {
                                        $like_count++;
                                    }
                                    if($dislikes == '1')
                                    {
                                        $dislike_count++;
                                    }
                                ?>
                            <!-- <td><php echo $like_count?></td>
                            <td><php echo $dislike_count?></td> -->
                            
                            
                            
                            
                            <td>
                                
                                <!-- <a href="<?php echo SITEURL; ?>./delete-review.php?id=<?php echo $id; ?>" class="btn-danger">Delete Review</a> -->

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
                        <td colspan="6"><div class="error">No Review added. </div></td>
                    </tr>
                    <?php 
                }
                ?>

        </div>
        <br>
    </section>
    <div class="container">
    <table class="tbl-20 input-responsivee">
        
        <tr  class="text-black">
            <td><h3>Movie:</h3>
        </td>
            <td>
            <h3><?php echo $movietitle  ?></h3>
            </td>
        </tr>

        <h3 class="reviewtext">Reviews:</h3>
        
        <tr class="text-black">
       
            <td >Likes:</td>
            <td ><?php echo $like_count ?></td>
        </tr>
        <tr class="text-black">
            <td>Dislikes:</td>
            <td><?php echo $dislike_count ?></td>
        </tr>
        <tr>
            <td><h3></h3></td>
        </tr>
        <tr  class="text-black">
            
            <td>Revenue:</td>
            <td><?php echo $movie_revenue  ?></td>
        </tr>
        <tr  class="text-black">
            <td>Actor:</td>
            <td><?php echo $movie_actor  ?></td>
        </tr>
        <tr  class="text-black">
            <td>Producer:</td>
            <td><?php echo $movie_producer  ?></td>
        </tr>
        <tr  class="text-black">
            <td>Director:</td>
            <td><?php echo $movie_director  ?></td>
        </tr>
        <form class="order">
            <br>
            <table>
                <tr>
                    <h3 class="reviewtext">Latest Review:</h3>
                    <h3 name="review" class="input-responsivee" cols="30" rows="5" ><?php echo $review ?></h3>
                    
                
                </tr>
            </table>
        </form>
    </table>
    </div>
    
    
</div>
<?php include('./partials-front/footer.php') ?>