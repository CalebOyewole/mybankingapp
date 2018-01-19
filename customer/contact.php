<?php include ('includes/header.php');
if(array_key_exists('submit', $_POST)){

           
            if(empty($_POST['name'])){
              $nameerror = '*Please enter name';
           }
             if(empty($_POST['email'])){
              $email = '*Please enter email';
            }
             if(empty($_POST['phone'])){
              $phoneerror = '*Please enter phone number';
            }
            if(empty($_POST['message'])){
              $messageerror = '*Please enter message';
            }

            if(empty($error)){ 
            	 echo $_POST['name'];
                 echo $_POST['email'];    


          


            #INSERT INTO THE DATABASE
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $messaget = $_POST['message'];

             $dbconnect  =  $conn->prepare("INSERT INTO contact(name,email,phone,message) VALUES (:n, :e, :p, :m) ");

        //bind paramenters
        $data = [
          ':n' => $name,
          ':e' => $email,
          ':p' => $phone,
          ':m' => $messaget,
          ]; 
          if($dbconnect->execute($data)){
          	$message = "Thanks for reaching out! message successfully sent";
            header("location:index.php");
          }else{
            $message = "message not sent, try again!";
            header("location:contact.php?message=$message");
          }
       }
   }
   ?>


<section id="cover">
<div id="cover-caption">
<div class="container">
<div class="col-sm-10 col-sm-offset-1">
<form action="contact.php" method="POST" class="form-inline">
<div class="form-group" style="margin-top: 100px;">
<p>Name</p> <input type="text" name="name">
<p>Email</p> <input type="text" name="email">
<p>Phone</p> <input type="text" name="phone">
<p>Message</p><textarea name="message" rows="6" cols="25"></textarea><br />
<input type="submit" name="submit"><input type="reset" value="Clear">
</div>
</form>
</div>
</div>
</div>
</section>



<?php include ('includes/footer.php');
       ?>

