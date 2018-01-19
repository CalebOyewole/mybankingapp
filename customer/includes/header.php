<?php 
    include 'includes/db.php';
    session_start();
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>banking customer</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- linking boostrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="styles.css">

    <script src="jquery/dist/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body style="background-image: url('img/1.jpg');">
<nav class="navbar navbar-dark bg-inverse navbar-full" id="nav-main">

        <a class="navbar-brand" href="">Digits Bank</a>
        
        <?php 
            if(isset($_SESSION['login']) && $_SESSION['login'] == 1 ){
                    ?>
        <ul class="nav navbar-nav">
             <li class="nav-item active ">
                <a class="nav-link" href="">Welcome <?php echo $_SESSION['customer_fname'] ?></a>
            </li>
             <!-- <li class="nav-item active">
                <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li -->


            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>
           
              
            <li class="nav-item active pull-xs-right">
                <a class="nav-link" href="view_transactions.php">View Transactions</a>
            </li>
            <li class="nav-item active pull-xs-right">
                <a class="nav-link" href="change_password.php">Change Password</a>
            </li>
            <li class="nav-item active pull-xs-right">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            </ul>
          

             <?php

                  

            }else{

            ?>
            <ul class="nav navbar-nav">
            
            <li class="nav-item pull-xs-right active">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            
        </ul>
          <?php } 
           
                if (isset($_SESSION['account_status']) && $_SESSION['account_status'] == 1) {
                    ?>
            <ul class="nav navbar-nav">
            <li class="nav-item active pull-xs-right">
                <a class="nav-link" href="make_transfer.php">Make Transfer</a>
            </li>
            </ul>
                 <?php } ?>
            





        <!-- <form class="form-inline pull-xs-right">
            <input class="form-control" type="text" placeholder="Search">
            <button class="btn btn-success-outline" type="submit">Search</button>
        </form> -->
    </nav>
    

