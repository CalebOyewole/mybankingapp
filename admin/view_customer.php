<?php include ('includes/header.php') ;
      
?>




<h1>The following are the customers registered in our bank</h1>

<table border="3" style="background-color: #fff">
	<thead>Customer Details</thead>
	<tr><th>Name</th> <th>Account No</th> <th>E-mail</th> <th>Phone</th><th>Current Balance</th><th>Account Status</th><th>Actions</th></tr>


<?php 
		$dbconn = $conn->prepare("SELECT * FROM customer");
		$dbconn->execute();



		WHILE($row = $dbconn->fetch(PDO::FETCH_ASSOC)){

			?>

			<tr><td><?php echo $row['fname']. " " . $row['lname'] ?></td> <td><?php echo $row['account_no'];?></td> <td><?php echo $row['email'];?></td> <td><?php echo $row['pnumber'];?></td><td><?php echo $row['balance'];?></td><td><?php 
                  
                  if ($row['account_status'] == 1) {
                  	echo "active"; 
                   
                   

                  	?>
                  	<button><a href="deactivate_customer.php?customer_id=<?php echo $row['customer_id'] ?>">Deactivate</a>  </button>

                  	<?php

                  }
                    else {
                    	echo "inactive ";

                    	?>

                    	<button><a href="activate_customer.php?customer_id=<?php echo $row['customer_id'] ?>">Activate</a>  </button>

                    	<?php
                    }

			?>
				
			</td><td><button><a href="edit_customer.php?customer_id=<?php echo $row['customer_id'] ?>">Edit</a>  </button><button><a href="delete_customer.php?customer_id=<?php echo $row['customer_id'] ?>">Delete</a> </button></td></tr>


			<?php

		}


?>
</table>


 <?php 
   include ('includes/footer.php');?>