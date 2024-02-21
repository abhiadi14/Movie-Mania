<?php include('./partials/menu.php'); ?>



    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

            ?>
                <br><br>

                <div class="col-4 text-center">

                    <?php 
                        //Sql Query 
                        $sql = "SELECT * FROM genre";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count Rows
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Genres
                </div>

                <div class="col-4 text-center">

                    <?php 
                        //Sql Query 
                        $sql2 = "SELECT * FROM movies";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Movies&Series
                </div>
                <div class="col-4 text-center">
                    
                    <?php 
                        //Sql Query 
                        $sql3 = "SELECT * FROM subscription";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Subscriptions.
                </div>
                <div class="col-4 text-center">
                    
                    <?php 
                        
                        

                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql4 = "SELECT SUM(sub_price) AS Total from users JOIN subscription on users.subscription = subscription.id;";

                        //Execute the Query
                        $res4 = mysqli_query($conn, $sql4);

                        //Get the VAlue
                        $row4 = mysqli_fetch_assoc($res4);
                        
                        //GEt the Total REvenue
                        $total_revenue = $row4['Total'];

                    ?>

                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br />
                    Revenue Generated
                </div>

                <div class="col-4 text-center">
                    
                    <?php 
                        
                        

                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql5 = "SELECT MAX(revenue) AS Maximum from movies ";

                        //Execute the Query
                        $res5 = mysqli_query($conn, $sql5);

                        //Get the VAlue
                        $row5 = mysqli_fetch_assoc($res5);
                        
                        //GEt the Total REvenue
                        $total_revenue = $row5['Maximum'];

                    ?>

                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br />
                    Max revenue from a movie.
                </div>

                <div class="col-4 text-center">
                    
                    <?php 
                        
                        

                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql6 = "SELECT MIN(revenue) AS Minimum from movies ";

                        //Execute the Query
                        $res6 = mysqli_query($conn, $sql6);

                        //Get the VAlue
                        $row6 = mysqli_fetch_assoc($res6);
                        
                        //GEt the Total REvenue
                        $total_revenue = $row6['Minimum'];

                    ?>

                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br />
                    Minimum revenue from a movie.
                </div>


               

                <div class="clearfix"></div>

            </div>
        </div>
<?php include('./partials/footer.php'); ?>
    
        