<?php include ('includes/header.php');


   $customer_id = $_SESSION['customer_id'];

$dbconnect  = $conn->prepare("SELECT * FROM customer  WHERE customer_id = $customer_id ");

		$dbconnect->execute();
        $row = $dbconnect->fetch(PDO::FETCH_ASSOC);
        $balance = $row['balance'];



if(array_key_exists('submit', $_POST)){

              $error = [];
            if(empty($_POST['recipient_account_no'])){
              $error['account_no'] = '*Please select Account Number';
           }
             if(empty($_POST['amount'])){
              $error['amount'] = '*Please enter amount you wish to transfer';
            }

            if($_POST['amount'] > $balance){
            	$error['check_balance'] =  "Insufficicient balance";
            }

            if(empty($error)){

            	//Deduct amount from the transferring party and update the accoubt balance
              $recipient_account_no = $_POST['recipient_account_no'];
            	$transfer_amount = $_POST['amount'];
            	$new_balance = $balance - $transfer_amount;
            	 $dbconnect  =  $conn->prepare("UPDATE `customer` SET 
        		`balance` = $new_balance
        WHERE `customer_id` = $customer_id ");

				$dbconnect->execute();
        //Update transaction details for sender

         $dbconnect  =  $conn->prepare("INSERT INTO transaction VALUES (NULL,:d, :n, :e,:a , :p, :f ) ");


          $data = [
          ':d' => date('l jS \of F Y h:i:s A'),
          ':n' => $customer_id,
          ':e' => "credit",
          ':a' => $transfer_amount,
          ':p' => $row['account_no'],
          ':f' => $recipient_account_no,
        ]; 
      

     

        $dbconnect->execute($data);
				//Add the transferred amount to the recipient
				$recipient_account_no = $_POST['recipient_account_no'];
					 $dbconnect  = $conn->prepare("SELECT * FROM customer WHERE account_no = $recipient_account_no");
      					  $dbconnect->execute();
                          $row2 = $dbconnect->fetch(PDO::FETCH_ASSOC);

                          $new_recipient_balance = $row2['balance'] + $transfer_amount;
                          $dbconnect  =  $conn->prepare("UPDATE `customer` 
                          								 SET 
        		                                                `balance` = $new_recipient_balance
                                                         WHERE 
                                                                 `account_no` = $recipient_account_no ");




                         if($dbconnect->execute()){

                                            //Update transaction details for sender

        $dbconnect  =  $conn->prepare("INSERT INTO transaction VALUES (NULL,:d, :n, :e,:a, :p, :f ) ");


          $data = [
          ':d' => date('l jS \of F Y h:i:s A'),
          ':n' => $row2['customer_id'],
          ':e' => "debit",
          ':a' => $transfer_amount,
          ':p' => $row['account_no'],
          ':f' => $recipient_account_no,
        ]; 
                   $dbconnect->execute($data);

                         	
                         	$message = "Transaction Successful";
                         	header("location:make_transfer.php?message=$message");
                         }else{
                         		$message = "Transaction Unsuccessful! Try again later";
                         	header("location:make_transfer.php?message=$message");
                         }






            }

         }
            ?>

<section id="cover">
        <div id="cover-caption">
            <div class="container">
                <div class="col-sm-10 col-sm-offset-1">
                
                  <?php 
                  if(isset($_GET['message'])){
                  	echo "<p style='color: red'>". $_GET['message']. "</p>";
                  }

                  echo "<p style='color: black'> Account Balance:". $row['balance'] ;
                if(isset($error['check_balance'])){
  echo "<p style='color: red'>". $error['check_balance'] . "</p>";
						} 
					?> 

<form action="make_transfer.php" class="form-inline" method="POST">       
                    
                <?php 
                if(isset($error['account_no'])){
  echo "<p style='color: red'>". $error['account_no'] . "</p>";
						} 
					?> 
                              
                        <div class="form-group" style="color: black;">
                        <h1>Select Recipient Account no<br>
                          <select class="form-control" id="exampleSelect1" name="recipient_account_no">
                          <option value="">Select</option>
      					  	
      					<?php 
      					 $dbconnect  = $conn->prepare("SELECT * FROM customer ");
      					  $dbconnect->execute($data);
        WHILE($row = $dbconnect->fetch(PDO::FETCH_ASSOC)){

        	echo "<option value='".$row['account_no']."'>". $row['account_no']."</option>";
        }
        		
      					 ?>		



      						
      		
    </select></h1>
  </div><br>
  			<div class="form-group">
  			<?php
  			   if(isset($error['amount'])){
  echo "<p style='color: red'>". $error['amount'] . "</p>";
						} 
					?> 
                          
                            <label class="sr-only">Amount</label>
                            <input type="number" name="amount" class="form-control form-control-lg" placeholder="please enter amount you wish to transfer">
                        </div>
       
                        <br>
                        
                        

                        <button type="submit" name="submit" class="btn btn-success btn-lg">Make Transfer</button>
                        </form>
                        </div>
                        </div>
                        </div>
                        </section>
                        <?php include ('includes/footer.php');?>
