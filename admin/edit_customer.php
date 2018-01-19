<?php include ('includes/header.php');


if(array_key_exists('submit', $_POST)){

           
            if(empty($_POST['fname'])){
              $fnameerror = '*Please enter First name';
           }
             if(empty($_POST['lname'])){
              $lnameerror = '*Please enter Last name';
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
              $balanceerror = '*Please enter account balance';
            }
            if(empty($error)){ 

           


            #INSERT INTO THE DATABASE
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $pnumber = $_POST['pnumber'];
            $dateofbirth = $_POST['dateofbirth'];
            $gender = $_POST['gender'];
            $address =$_POST['address'];
            $balance =$_POST['balance'];
            $customer_id = $_POST['customer_id'];
            $account_status = 1;
           




      $dbconnect  =  $conn->prepare("UPDATE `customer` SET 
        `fname` = :p,
        `lname` = :l,
        `email` = :e,
        `pnumber` = :pn,
        `dateofbirth` = :d,
        `gender` = :g,
        `address` = :a,
        `balance` = :b,
        `customer_id`= :f

        WHERE `customer_id` = :f ");

       $data = [
         
          ':p' => $fname,
          ':l' => $lname,
          ':e' => $email,
          ':pn'=> $pnumber,
          ':d' => $dateofbirth,
          ':g' => $gender,
          ':a' => $address,
          ':b' => $balance,
          ':f' => $customer_id

        ]; 

        //bind paramenters
      
          if($dbconnect->execute($data)){
            $message = "Customer has been successfully edited!";
            header("location:view_customer.php?message=$message");
          }else{
            $message = "Customer cannot be edited, Try again!";
            header("location:edit_customer.php?message=$message&customer_id=$customer_id");
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

                if(isset($_GET['customer_id'])){
                  $customer_id = $_GET['customer_id'];
    $dbconn = $conn->prepare("SELECT * FROM customer WHERE customer_id = $customer_id");
    $dbconn->execute();

    $row = $dbconn->fetch(PDO::FETCH_ASSOC);
                }


                ?>
                    

                <form action="" method="POST">
                        <div class="form-group">
                          <?php if(isset($fnameerror)){
  echo "<p style='color: red'>". $fnameerror . "</p>";
} ?>
                            <label style="font-size: 40px;">First Name</label>
                            <input type="text" class="form-control form-control-lg"  name="fname" placeholder="Please enter First name" value="<?php echo $row['fname'] ?>">
                        </div><br>
                        <div class="form-group">
                            <label style="font-size: 40px;">Last Name</label>
                            <input type="text" name="lname" class="form-control form-control-lg" placeholder="Please enter Last name" value="<?php echo $row['lname']?>">
                        </div><br>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="e.g janedoe@email.com" value="<?php echo $row['email'];?>" >
                        </div><br>
                     
                       <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="pnumber" class="form-control form-control-lg" placeholder="Please enter phone number" value="<?php echo $row['pnumber'];?>" >
                        </div><br>
                        <div class="form-group">
                       		<label>D.O.B</label>
                       		<input type="date" class="form-control form-control-lg" name="dateofbirth" placeholder="Please enter date of birth" value="<?php echo $row['dateofbirth'];?>">
                       </div><br>

                        <div class="form-group">
                          <label>Gender</label>
                          <input type="text" class="form-control form-control-lg" name="gender" placeholder="Please enter gender" value="<?php echo $row['gender'];?>">
                       </div><br>
                       <div class="form-group">
                       		<label>Address</label>
                       		<input type="text" class="form-control form-control-lg" name="address" placeholder="Please enter address" value="<?php echo $row['address'];?>">
                       </div><br>

                        <div class="form-group">
                       		<label>Current Balance</label>
                       		<input type="text" class="form-control form-control-lg" name="balance" placeholder="Please enter amount for opening" value="<?php echo $row['balance'];?>">
                       </div><br>

                       <input type="hidden" name="customer_id" value="<?php echo $row['customer_id'] ?>">

                        <button type="submit" name="submit" class="btn btn-success btn-lg">SUBMIT</button>
                    </form>

  </div>
  </div>
  </div>
  </section> 

  <?php include ('includes/footer.php');?>                 