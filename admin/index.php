<?php include ('includes/header.php');?>

<section style="margin-top: 100px;">
 <?php 
            if(isset($_SESSION['login']) && $_SESSION['login'] == 1 ){
                    ?>
         <div><p><h1> Welocme <?php echo $_SESSION['admin_name']; ?></h1></p>
               <p>This is your admin account</p>
               <p>You can Add, View and Delete customers</p>
         </div>
        <?php } ?>
        </section>
	














     <?php include ('includes/footer.php');
       ?>

      
























    