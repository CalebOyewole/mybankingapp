<?php 

 include ('includes/header.php');
       

 if(array_key_exists('submit', $_POST)){

           
            
            
             if(empty($_POST['email'])){
              $emailerror = '*Please enter email';
            }
            if(empty($_POST['password'])){
              $passworderror = '*Please enter password';
            }
           

           
            #CHECK IF RECORD IS IN DATABASE
            
            $email = $_POST['email'];
            $hash_password = md5($_POST['password']);
           

      $dbconnect  = $conn->prepare("SELECT * FROM customer  WHERE email = :e AND password = :p ");

        //bind paramenters
        $data = [
          
          ':e' => $email,
          ':p' => $hash_password
        ]; 

        $dbconnect->execute($data);
        $count = $dbconnect->rowCount();
        $row = $dbconnect->fetch(PDO::FETCH_ASSOC);



        if($count == 1 ){
            $_SESSION['login'] = 1;
            $_SESSION['customer_fname'] = $row['fname'];
            $_SESSION['customer_balance']= $row['balance'];
            $_SESSION['customer_id']=$row['customer_id'];
            $_SESSION['account_status']=$row['account_status'];           


            header("location:index.php");
        

          }else{
            $message = "Invalid login details, try again!";
            header("location:login.php?message=$message");
          }

        }
      






       ?>
    <section id="cover">
        <div id="cover-caption">
            <div class="container">
                <div class="col-sm-10 col-sm-offset-1">
                <?php 
                if (isset($_GET['message'])) {
             echo $_GET['message'];
                }
                ?>
                    

   
                  <form action="login.php" class="form-inline" method="POST">       
                <?php if(isset($emailerror)){
  echo "<p style='color: red'>". $emailerror . "</p>";
} ?>                      
                              <div class="form-group">
                            <label class="sr-only">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="e.g janedoe@email.com">
                        </div>
                        
         <div class="form-group">
             <?php if(isset($passworderror)){
  echo "<p style='color: red'>". $passworderror . "</p>";
} ?>
                            <label class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="enter password">
                        </div>
                        
                        

                        <button type="submit" name="submit" class="btn btn-success btn-lg">Login</button>
                        </form>
                        </div>
                        </div>
                        </div>
                        </section>
            <?php include ('includes/footer.php');?>            
                    
                    








