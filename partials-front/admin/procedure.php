<?php include('./partials/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
            <h1>PROCEDURE</h1>
            
                <br><br>

                    
                    <?php 
                        
                        

                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql4 = "CALL getmovies_review('Black-swan');";

                        //Execute the Query
                        $res4 = mysqli_query($conn, $sql4);

                        while($row4 = mysqli_fetch_assoc($res4))
                        {
                            // print_r($row4);
                            echo"{$row4['title']} \t {$row4['review']}<br>";
                        }

                        
                    ?>
                
                <div class="clearfix"></div>

            </div>
        </div>


<?php include('./partials/footer.php'); ?>