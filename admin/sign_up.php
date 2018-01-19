<?php 
include ('includes/header.php');

   

  if(array_key_exists('submit', $_POST)){

           
            if(empty($_POST['fname'])){
              $error['fname']= '*Please enter first name';
            }
             if(empty($_POST['lname'])){
              $error['lname'] = '*Please enter last name';
            }
             if(empty($_POST['email'])){
              $error['email'] = '*Please enter email';
            }

            if(Utils::checkEmail($conn, $_POST['email']))

            {

              $error['email'] = "Email already exists ";
            
            }          


            if(empty($_POST['password'])){
              $error['password'] = '*Please enter password';
            }
            if($_POST['password'] !== $_POST['password1']){
              $error['confirm'] = '*Please enter same password';
            }

            $destination = "";

  define("MAX_FILE_SIZE", "2097152");

  $ext = ["image/jpg", "image/png", "image/jpeg"];


   if (empty($_FILES['image']['name'])){
    $errors['image'] = "Please choose an Image";
   }
   //To check the size of the file
   if ($_FILES['image']['size'] > MAX_FILE_SIZE) {
    $errors['image'] = "File is too large. 2mb allowed";
   }
   //To check the format
   if(!in_array(strtolower($_FILES['image']['type']), $ext)){
    $errors['image'] = "File format not supported";
   }
  $check = Utils::uploadFile($_FILES, "image");

  if ($check[0]) {
    $destination = $check[1];
  }else{
    $errors['image'] = "File is not uploaded";
  }
         


          if(empty($error)){ 


            $clean = array_map('trim', $_POST);
            $clean['loc'] = $destination;
            $clean['hash_password'] = md5($clean['password']);
    Utils::addAdmin($conn, $clean);           
      }     

 }

 ?>

 <center>
  <section id="cover">
    <div id="cover-caption">
      <div class="container">
        <div class="col-sm-10 col-sm-offset-1">
          
          
          
           <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <?php if(isset($error['fname'])){
  echo "<p style='color: red'>". $error['fname']. "</p>";
} ?>
                            <label style="font-size:">First Name</label>
                            <input type="text" class="form-control form-control-lg"  name="fname">
                        </div><br>
                        <div class="form-group">
                <?php 
                if(isset($error['lname'])){
  echo "<p style='color:red'>". $error['lname'] . "</p>";

} 
?>
                            <label style="font-size:">Last name</label>
                            <input type="text" name="lname" class="form-control form-control-lg" >
                        </div><br>
                       <div class="form-group">
                   <?php if(isset($error['email'])){
  echo "<p style='color: red'>". $error['email'] . "</p>";
} ?>
                          <label style="font-size:">E-mail</label>
                          <input type="email" class="form-control form-control-lg" name="email" placeholder="janedoe@example.com" value="<?php 

                          if(isset($_POST['email'])){
                            echo $_POST['email'];
                          }


                          ?>" >
                       </div><br>
                        <div class="form-group">
                      <?php if(isset($error['password'])){
  echo "<p style='color:red'>". $error['password'] . "</p>";
} ?>
                          <label style="font-size:">Password</label>
                          <input type="password" class="form-control form-control-lg" name="password" placeholder="anything">
                       </div><br>

                        <div class="form-group">
                          <label style="font-size:">Confirm Password</label>
<?php if(isset($error['confirm'])){
  echo "<p style='color: red'>". $error['confirm'] . "</p>";
} ?>

                          <input type="password" class="form-control form-control-lg" name="password1" placeholder="anything">
                       </div><br>




                      <br>

                       <div>
     
      <label>Select an Image:</label>
      <input type="file" name="image" value="Choose File">
    </div> 



                        <button type="submit" name="submit" class="btn btn-success btn-lg">SUBMIT</button>
                    </form>
                    
        </div>
        
      </div>
      
    </div>
    
  </section>
 </center>
 <?php include ('includes/footer.php');?>

