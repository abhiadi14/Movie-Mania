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
                <a href="#" title="Logo">
                    <img src="images/movies.png" alt="Movie Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>signup.php">Signup</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Login section starts here -->
    <section class="food-search">

        <div class="conatiner">
        <h2 class="text-center text-white">User Profile</h2>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <form class="order" action="" method="POST" enctype="multipart/form-data">
                <fieldset>
                <legend>Profile</legend>
                
                <table>
                    <tr>
                        <td class="order-label">Username:</td>
                        <td>
                            <input name="Username" class="input-responsive" type="text"  placeholder="Enter your username">
                        </td>
                    </tr>
                    <tr>
                        <td class="order-label">email:</td>
                        <td>
                            <input class="input-responsive" type="email" name="Email" placeholder="Type your email address">
                        </td>
                    </tr>
                    <tr>
                        <td class="order-label">Age:</td>
                        <td>
                            <input class="input-responsive" type="number" name="Age_req" placeholder="Enter Your Age">
                        </td>
                    </tr>
                    <tr>
                        <td class="order-label">Gender:</td>
                        <td>
                            <input  type="radio" value="Male" name="Gender">Male
                            <input  type="radio" value="Female" name="Gender">Female
                            <input  type="radio" value="Other" name="Gender">Other
                        </td>
                    </tr>
                    <tr>
                        <td  class="order-label">Subscription:</td>
                        <td>
                            <select name="Subscription" class="input-responsive">
                            <?php
                                //to display catogaries from database.
                                $sql = "SELECT * FROM subscription WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                echo $count;
                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $sub_name = $row['sub_name'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $sub_name ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No Subscription Found</option>
                                    <?php
                                }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="order-label">Firts_name:</td>
                        <td>
                            <input class="input-responsive" type="text" name="F_name" placeholder="Enter First Name ">
                        </td>
                    </tr>
                    <tr>
                        <td class="order-label">Last_name:</td>
                        <td>
                            <input class="input-responsive" type="text" name="L_name" placeholder="Enter Last Name">
                        </td>
                    </tr>
                    <tr>
                        <td class="order-label">Password:</td>
                        <td>
                            <input class="input-responsive" type="password" name="Password" placeholder="Set Password">
                        </td>
                    </tr>
                    <tr>
                    
                        <td colspan="2"><input type="submit" name="submit" value="Sign Up" class="btn btn-primary1"></td>
                    </tr>
                </table>
                    
                </fieldset>
            </form>
        </div>
            
    </section>
</body>
<?php include('./partials-front/footer.php') ?>

<?php 
    if(isset($_POST['submit']))
    {
        echo $full_name = $_POST['F_name'];
        echo $last_name = $_POST['L_name'];
        echo $username = $_POST['Username'];
        echo $password = md5($_POST['Password']); //encrypted md5
        echo $gender = $_POST['Gender'];
        echo $email = $_POST['Email'];
        echo $subscription = $_POST['Subscription'];
        echo $age_req = $_POST['Age_req'];

        //sql query
        $sql = "INSERT INTO users SET 
            F_name = '$full_name',
            L_name = '$last_name',
            email = '$email',
            username = '$username',
            Password = '$password',
            subscription = '$subscription',
            gender = '$gender',
            age_req = '$age_req'
            
        ";

        //executeing query
        $res = mysqli_query($conn, $sql);
        
        //check
        if($res == TRUE)
        {
            
            //echo('data inserted');
            $_SESSION['add'] = 'User added successfully';
            //redirect
            echo("<script>location.href = '".SITEURL."login.php?';</script>");

        }
        else
        {
            //echo('data not inserted');
            $_SESSION['add'] = 'Failed to add User';
            //redirect
            header('location:'.SITEURL.'./signup.php');
        }
    }
?>