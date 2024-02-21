<?php include('config/constants.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOVIE MANIA</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php SITEURL ?>./index.php" title="Logo">
                    <img src="images/movies.png" alt="Movie Logo" height="120" width="10" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Content</a>
                    </li>
                    <!-- <li>
                        <a href="#">Contact</a>
                    </li> -->
                    <li>
                        <a href="<?php echo SITEURL; ?>profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>login.php">LogOut</a>
                    </li>
                </ul>
            </div>

            <!-- <div class="clearfix"></div> -->
        </div>
    </section>
    <!-- Navbar Section Ends Here -->