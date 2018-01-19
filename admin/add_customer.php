<?php include ('includes/header.php');

if(array_key_exists('submit', $_POST)){

           
            if(empty($_POST['fname'])){
              $fnameerror = '*Please enter First name';
           }
             if(empty($_POST['lname'])){
              $lname = '*Please enter Last name';
            }
             if(empty($_POST['email'])){
              $emailerror = '*Please enter email';
            }
            if(empty($_POST['date'])){
              $doberror = '*Please enter date of birth';
            }
            if(empty($_POST['gender'])){
              $gendererror = '*Please enter gender';
            }
            if(empty($_POST['address'])){
              $addresserror = '*Please enter address';
            }
            if(empty($_POST['balance'])){
              $error = '*Please enter account balance';
            }
            if(empty($error)){ 

          echo $_POST['fname'];
          echo $_POST['password'];    


            #INSERT INTO THE DATABASE
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $hash_password =md5($_POST['fname']);
            $pnumber = $_POST['pnumber'];
            $dateofbirth = $_POST['dateofbirth'];
            $gender = $_POST['gender'];
            $address =$_POST['address'];
            $balance =$_POST['balance'];
            $account_number = rand(10000,999999);
            $account_status = 0;
           




      $dbconnect  =  $conn->prepare("INSERT INTO customer(fname,lname,email,password,pnumber,dateofbirth,gender,address,balance,account_no, account_status) VALUES (:f, :l, :e, :p, :pn, :d, :g, :a, :b, :ac, :nd) ");

        //bind paramenters
        $data = [
          ':f' => $fname,
          ':l' => $lname,
          ':e' => $email,
          ':p' => $hash_password,
          ':pn' => $pnumber,
          ':d' => $dateofbirth,
          ':g' => $gender,
          ':a' => $address,
          ':b' => $balance,
          ':ac' => $account_number,
          ':nd' => $account_status



        ]; 
          if($dbconnect->execute($data)){
            header("location:view_customer.php");
          }else{
            $message = "Invalid registration details, try again!";
            header("location:add_customer.php?message=$message");
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
                    

                <form action="" method="POST">
                        <div class="form-group">
                          <?php if(isset($fnameerror)){
  echo "<p style='color: red'>". $fnameerror . "</p>";
} ?>
                            <label style="font-size: 40px;">First Name</label>
                            <input type="text" class="form-control form-control-lg"  name="fname" placeholder="Please enter First name">
                        </div><br>
                        <div class="form-group">
                            <label style="font-size: 40px;">Last Name</label>
                            <input type="text" name="lname" class="form-control form-control-lg" placeholder="Please enter Last name" >
                        </div><br>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="e.g janedoe@email.com" >
                        </div><br>
                     
                       <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="pnumber" class="form-control form-control-lg" placeholder="Please enter phone number" >
                        </div><br>
                        <div class="form-group">
                       		<label>D.O.B</label>
                       		<input type="date" class="form-control form-control-lg" name="dateofbirth" placeholder="Please enter date of birth">
                       </div><br>

                        <div class="form-group">
                          <label>Gender</label>
                          <input type="text" class="form-control form-control-lg" name="gender" placeholder="Please enter gender">
                       </div><br>
                       <div class="form-group">
                       		<label>Address</label>
                       		<input type="text" class="form-control form-control-lg" name="address" placeholder="Please enter address">
                       </div><br>

                        <div class="form-group">
                       		<label>Current Balance</label>
                       		<input type="text" class="form-control form-control-lg" name="balance" placeholder="Please enter amount for opening">
                       </div><br>

                        <button type="submit" name="submit" class="btn btn-success btn-lg">SUBMIT</button>
                    </form>

  </div>
  </div>
  </div>
  </section>                  