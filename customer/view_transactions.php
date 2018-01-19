<?php include ('includes/header.php');
    
    $customer_id = $_SESSION['customer_id']; 
    $account_status = $_SESSION['account_status'];
?>


<h1>Welcome <?php echo $_SESSION['customer_fname'] ?></h1>
<p style="color: black; font-size: 20px;">This is your transaction history</p>
<?php 
         if (isset($_SESSION['account_status']) && $_SESSION['account_status'] == 1) {
         	?>
<table border="3" style="background-color: #fff">
	<thead>Transaction History</thead>
	<tr><!-- <th>Transaction ID</th> --><th>Transaction Date</th> <!-- <th>Customer ID</th> --> <th>Transaction Type</th> <th>transaction amount</th><th> Transfer From</th><th> Transfer To</th></tr>

 

        <?php
		$dbconn = $conn->prepare("SELECT * FROM transaction WHERE customer_id = $customer_id ");
		$dbconn->execute();

		WHILE($row = $dbconn->fetch(PDO::FETCH_ASSOC)){

			?>

			<tr><!-- <td><?php echo $row['transaction_id']?></td> --> <td><?php echo $row['transaction_date'];?></td> <!-- <td><?php echo $row['customer_id'];?></td> --> <td><?php echo $row['transaction_type'];?></td><td><?php echo $row['transaction_amount'];?></td><td><?php echo $row['transfer_from'];?></td><td><?php echo $row['transfer_to'];?></td>

			
				


			<?php

		} 
	} else{
		echo "<p> sorry your account is inactive. Please contact us to activate your account! </p>";
	}


?>




</table>








 <?php 
  include 'includes/footer.php';
  ?>