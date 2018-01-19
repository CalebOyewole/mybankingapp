<?php 

 include ('includes/header.php');
 
 
       

 if(array_key_exists('submit', $_POST)){

           
          
             if(empty($_POST['email'])){
              $error['email'] = '*Please enter email';
            }
            if(empty($_POST['password'])){
              $error ['password']= '*Please enter password';
            }

           if(empty($error)){
           
            
           $map = array_map('trim', $_POST);
            Utils:: login($conn,$map);
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
                            <input type="text" name="email" class="form-control form-control-lg" placeholder="e.g janedoe@email.com">
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