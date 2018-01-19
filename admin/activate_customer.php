<?php include ('includes/header.php');


          $customer_id = $_GET['customer_id'];




		$dbconn = $conn->prepare("UPDATE  `customer` SET 

          `account_status` = 1

          WHERE `customer_id`= :c");
		
		 $data = [
         
          ':c' => $customer_id
          
               ]; 

       if($dbconn->execute($data)){
            header("location:view_customer.php");
          }else{
            $message = "account could not be activated. Please try again later!";
            header("location:view_customer.php?message=$message");
          }

          include ('includes/footer.php');
          ?>