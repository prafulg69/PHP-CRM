<?php
if(isset($_POST['submit']))
{
	include 'db_config.php';
      $order_id = trim($_POST['order_id']);
	  $priority_level = trim($_POST['priority_level']);
      
	  $results = $db->query("UPDATE `orders` SET `Priority_Level` = '$priority_level' WHERE `orders`.`Order_ID` = '$order_id';");
	  if($results){
		$response = "Order Priority has been set !";  
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
      <title>Set Order Priority</title>
	  <link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
   </head>
   
   <body style="background: #f1f1f1;">
   <?php include('header.php'); ?>
	<div class = "container">
      <div class="col-form-4 login-card" style="float: none; margin: auto;">
        
            <h1 class="title-text">Set Priority of Order #<?php echo $_GET['id']; ?></h1>
			<div style = "font-size: 18px;color:#4CAF50;margin-top:10px;text-align: center;"><?php echo $response; ?></div>	
            <div>
               <?php $order_id= $_GET['id']; 
			   include 'db_config.php'; 
			   $results= $db->query("SELECT Priority_Level FROM `orders` where Order_ID = '$order_id'");
		       while($row = $results->fetch_assoc()){ 
		         $priority = $row["Priority_Level"]; ?>	
               <form class="enquiry-form lead-form" action = "addtopriority.php" method = "post" >
                  <label class="required-label">Select Priority Level*</label>
                   <select name="priority_level">
                   <option value="2" <?php if($priority=='2') echo 'selected="selected"' ?>>High</option>
                   <option value="1" <?php if($priority=='1') echo 'selected="selected"' ?>>Medium</option>
                   <option value="0" <?php if($priority=='0') echo 'selected="selected"' ?>>No Priority (Default)</option>
                  </select>
				  <input type = "text" name = "order_id" value="<?php echo $order_id; ?>" hidden="true"/>               
                  <input class="red-button" type = "submit" name="submit" value = "Save"/>
				  
		       </form> <?php } ?>
               
               
					
            </div>
				
         
			
      </div>
  </div>
   </body>
</html>
