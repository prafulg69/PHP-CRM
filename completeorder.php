<?php
if(isset($_POST['submit']))
{
	include 'db_config.php';
      $order_id = $_POST['order_id'];
      $cust_id = $_POST['cust_id'];
	  $amount = $_POST['amount'];
	  $results = $db->query("UPDATE `orders` SET `Order_Status` = 'completed' WHERE `orders`.`Order_ID` = '$order_id';");
	  $results2 = $db->query("UPDATE `customers` SET `no_of_orders` = `no_of_orders`+1, `total_revenue` = `total_revenue`+$amount WHERE `customer_id` = '$cust_id'");
	  if($results2){
		$response = "Order Marked as Completed !";  
	  }
	  else{
		$response = "Error! Contact IT Helpdesk";    
	  }
	  $db->close();
	   
	  
    }

?>
<html>
 <?php
  include('session.php');
?>  
   <head>
      <title>Order Completion</title>
	  <link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
   </head>
   
   <body style="background: #f1f1f1;">
   <?php include('header.php'); ?>
	<div class = "container">
      <div class="col-form-4 login-card" style="float: none; margin: auto;">
        
            <h1 class="title-text">Order Completed</h1>
				
            <div>
               <?php $order_id= $_GET['id']; $cust_id= $_GET['custid']; $amount= $_GET['amount'];?>
               			   
               <form class="enquiry-form lead-form" action = "completeorder.php" method = "post" >
                  <label>Are you sure you want to mark Order #<?php echo $order_id; ?> as Completed ?</label><br>
				  <input type = "text" name = "order_id" value="<?php echo $order_id; ?>" hidden="true"/> 
                  <input type = "text" name = "cust_id" value="<?php echo $cust_id; ?>" hidden="true"/>
                  <input type = "text" name = "amount" value="<?php echo $amount; ?>" hidden="true"/>				  
                  <input class="red-button" type = "submit" name="submit" value = "Mark As Completed"/>
				  <div style = "font-size: 18px;color:#4CAF50;margin-top:10px;text-align: center;"><?php echo $response; ?></div>
               </form>
               
               
					
            </div>
				
         
			
      </div>
  </div>
   </body>
</html>
