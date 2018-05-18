<?php
if(isset($_POST['submit']))
{
	include 'db_config.php';
    $order_id = $_POST['order_id'];
      
	  $results = $db->query("UPDATE `orders` SET `Order_Status` = 'cancel' WHERE `orders`.`Order_ID` = '$order_id';");
	  if($results){
		$response = "Order Cancelled !";  
	  }
	  else{
		$response = "Error! Contact IT Team";    
	  }
	  $db->close();	   	 
    }
?>
<html>
 <?php
  include('session.php');
?>  
   <head>
      <title>Order Cancellation</title>
	  <link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
   </head>
   
   <body style="background: #f1f1f1;">
   <?php include('header.php'); ?>
	<div class = "container">
      <div class="col-form-4 login-card" style="float: none; margin: auto;">
        
            <h1 class="title-text">Order Cancellation</h1>
				
            <div>
               <?php $order_id= $_GET['id']; ?>	
               <form class="enquiry-form lead-form" action = "cancelorder.php" method = "post" >
                  <label>Are you sure you want to cancel Order #<?php echo $order_id; ?> ?</label><br>
				  <input type = "text" name = "order_id" value="<?php echo $order_id; ?>" hidden="true"/>               
                  <input class="red-button" type = "submit" name="submit" value = "Cancel Order"/>
				  <div style = "font-size: 18px;color:#4CAF50;margin-top:10px;text-align: center;"><?php echo $response; ?></div>
               </form>
               
               
					
            </div>
				
         
			
      </div>
  </div>
   </body>
</html>
