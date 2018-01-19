<?php

	  include 'includes/db.php';
if(isset($_GET['customer_id'])){
  
	$customer_id = $_GET['customer_id'];
   $dbconnect  =  $conn->prepare("DELETE FROM customer WHERE customer_id = $customer_id");

   if($dbconnect->execute()){
   	  header('location:view_customer.php');
   }






}