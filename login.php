<?php include('config/constants.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> A4 Entertainment </title>


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
        <h2 class="text-center text-white">User Login</h2>
        <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-msg']))
                {
                    echo $_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
                }
        ?>
            <form class="order" method="POST">
                <fieldset>
                <legend>Login</legend>
                <table>
                    
                    <tr>
                        <td class="order-label">email:</td>
                        <td>
                            <input class="input-responsive" type="email" name="email" placeholder="Enter your email address.">
                        </td>
                    </tr>
                    <tr>
                        <td  class="order-label">Password:</td>
                        <td>
                        <input class="input-responsive" type="password" name="Password" placeholder="Enter your password.">
                        </td>
                    </tr>
                    
                    <tr>
                       
                        <td colspan="2"><input type="submit" name="submit" value="Login" class="btn btn-primary1"></td>
                    </tr>
                </table>
                    
                </fieldset>
            </form>
        </div>
            
    </section>
</body>
<?php 
    if(isset($_POST['submit']))
    {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $raw_password = md5($_POST['Password']);
        $password = mysqli_real_escape_string($conn, $raw_password);


        $sql = "SELECT * FROM users WHERE email='$email' AND Password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            //user available
            
            $_SESSION['login'] = "<div class='success'>Login Successful. </div>";

            $_SESSION['email'] = $email;

            header('location:'.SITEURL.'./index.php');
        }
        else
        {
            //user not available
            $_SESSION['login'] = "<div class='error'>Login Failed. Username or Password did not match. </div>";
            header('location:'.SITEURL.'./login.php');
        }
    }
?>
<?php include('./partials-front/footer.php') ?>