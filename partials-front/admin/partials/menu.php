<?php 

    include('../config/constants.php');
    include('login-check.php');
    
?>
<html>
    <head>

        <Title>Movies Adminstration</Title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        
    <div class="menu">
        <div class="wrapper">
            <ul class="navbar">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-sub.php">Subscriptions</a></li>
                <li><a href="manage-category.php" >Category</a></li>
                <li><a href="manage-content.php">Content</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="procedure.php">Procedure</a></li>
            </ul>
        </div>
         
    </div>