<?php include ('includes/header.php');
        #DEFINING INDEX

   $customer_id = $_SESSION['customer_id'];

$dbconnect  = $conn->prepare("SELECT * FROM customer  WHERE customer_id = $customer_id");

            $dbconnect->execute();
        $row = $dbconnect->fetch(PDO::FETCH_ASSOC);
       
     ?>
          <h1>Welcome <?php echo $_SESSION['customer_fname']; ?></h1>
          <P>Your Current Balance is: <?php echo $row['balance']; ?></P>
          <P>Account Status: <?php if($row['account_status'] == 1 ) {
          	echo "Active";
          	} else{
          		echo "Inactive";
          	}

          	?></P>
            <?php include ('includes/footer.php');?>




		