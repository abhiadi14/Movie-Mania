<?php include('./partials-front/menu.php') ?>

    
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Content.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Content</h2>

            <?php 
                //Display Foods that are Active
                $sql = "SELECT * FROM movies WHERE active='Yes'";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //CHeck whether the foods are availalable or not
                if($count>0)
                {
                    //Foods Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $revenue = $row['revenue'];
                        $age_req = $row['age_req'];
                        $image_name = $row['image_name'];
                        $actor = $row['actor'];
                        $producer = $row['producer'];
                        $director = $row['director'];

                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //CHeck whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img  src="<?php echo SITEURL; ?>images/movies/<?php echo $image_name; ?>" alt="Wolf of Wall Street" class="img-responsive1 img-curve1"height="120px">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">Revenue:$ <?php echo $revenue; ?></p>
                                <p class="food-price">Age-req: <?php echo $age_req; ?></p>
                                <p class="food-price">Actor: <?php echo $actor; ?></p>
                                <p class="food-price">Producer: <?php echo $producer; ?></p>
                                <p class="food-price">Director: <?php echo $director; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>
                                
                                <a href="<?php echo SITEURL; ?>./watch.php?id=<?php echo $id ?>" class="btn btn-primary1">Watch Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Food not Available
                    echo "<div class='error'>Content not found.</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    
    <!-- fOOD Menu Section Ends Here -->
<?php include('./partials-front/footer.php') ?>