<?php include ('includes/header.php');

   echo $_SESSION['customer_id'];
     
     if(array_key_exists('submit', $_POST)){
        $error=[];
           
          echo $_SESSION['customer_fname'];
          echo $_POST['password'];
            if($_POST['password'] !== $_SESSION['customer_fname']){
              $error['crosscheck'] = '*please enter present password';
           }
            if(empty($_POST['newpassword'])){
              $error['newpassword'] = '*please enter new password';
           }
          
           if ($_POST['newpassword'] !== $_POST['newpassword1']) {
               $error['confirmpassword'] = '*Please confirm new password';
           }

           if(empty($error)){
            

       #INSERT INTO THE DATABASE
       
            $newpassword = md5($_POST['newpassword']);
            $customer_id = $_SESSION['customer_id'];
            echo $customer_id;

          
           




      $dbconnect  =  $conn->prepare("UPDATE `customer` SET 
        `password` = :n 
        

        WHERE `customer_id` = :c");

       $data = [
         
          ':c' => $customer_id,
          ':n' => $newpassword
          
               ]; 
       
          if($dbconnect->execute($data)){
            header("location:login.php");
          }else{
            $message = "password could not be changed. Please try again later!";
            header("location:change_password.php?message=$message");
          }


        }
    }


 

 ?>


<section id="cover">
        <div id="cover-caption" style="padding-top: 600px;">
            <div class="container">
                <div class="col-sm-10 col-sm-offset-1">
                <?php 
                if (isset($_GET['message'])) {
             echo $_GET['message'];
                }
                ?>
                    

                <form action="change_password.php" method="POST" style="color: black;">
                        <div class="form-group">
                                    <?php    if(isset($error['crosscheck'])){
                                      echo"<p style= 'color: red'>". $error['crosscheck']."</p>";
                                                                            }         ?>
                            <label style="font-size: 40px;">Password</label>
                            <input type="password" class="form-control form-control-lg"  name="password" placeholder="Please enter present password">
                            </div><br>
                        <div class="form-group">
                     <?php if(isset($error['newpassword'])){
       echo "<p style='color: red'>". $error['newpassword'] . "</p>";
                                                               }
                      ?>
                            <label style="font-size: 40px;">New Password</label>
                            <input type="password" name="newpassword" class="form-control form-control-lg" placeholder="Please enter new password" >
                        </div><br>
                        <div class="form-group">
                       <?php if (isset($error['confirmpassword'])) {
                       echo "<p style='color: red'>". $error['confirmpassword'] . "</p>";
                       }
                        ?>
                            <label style="font-size: 40px;">Confrim  New Password</label>
                            <input type="password" name="newpassword1" class="form-control form-control-lg" placeholder="Please confrim new password" >
                        </div><br>
                     
                     
                        <button type="submit" name="submit" class="btn btn-success btn-lg">SUBMIT</button>
                    </form>

  </div>
  </div>
  </div>
  </section>  
  <?php include ('includes/footer.php');?>                