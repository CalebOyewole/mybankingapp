<?php 

    session_start();
    include 'includes/db.php';
    include('includes/function.php');
    
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>banking admin</title>
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

        <a class="navbar-brand" href="">Bank PHP</a>
        
        <?php 
            if(isset($_SESSION['login']) && $_SESSION['login'] == 1 ){
                    ?>
        <ul class="nav navbar-nav">
             <li class="nav-item active">
                <a class="nav-link" href="index.php"><?php echo $_SESSION['admin_name']; ?></a>
            </li>
             <li class="nav-item active">
                <a class="nav-link" href="">
                <img src="<?php echo $_SESSION['img_path']; ?>" width="50px" height="50px">

                </a>
            </li>


            <li class="nav-item active">
                <a class="nav-link" href="add_customer.php">Add Customer <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="view_customer.php">View Customers</a>
            </li>
            <li class="pull-xs-right  nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            </ul>

             <?php



            }else{

            ?>
            <ul class= "pull-xs-right nav navbar-nav">
            
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sign_up.php">Sign Up</a>
            </li>
        </ul>
          <?php } ?>
            





        <!-- <form class="form-inline pull-xs-right">
            <input class="form-control" type="text" placeholder="Search">
            <button class="btn btn-success-outline" type="submit">Search</button>
        </form> -->
    </nav>
    

