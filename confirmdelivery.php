<?php
if(isset($_POST['submit']))
{
   $id = $_POST['id'];
   $comment = $_POST['comment'];
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'ishwark5_adwords_data');
   define('DB_USER','ishwark5_adwords');
   define('DB_PASSWORD','custom@shape_123');

   $con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
   $db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());

$query = "UPDATE `orders` SET `Delivery_Received` = '1', `Feedback` = '$comment', `Order_Status` = 'completed' WHERE `Order_ID` = '$id'";
$result=mysqli_query($con,$query);

 mysqli_close($con);

$response = "Thanks! Shipment Marked as Received";

}
?>
<!DOCTYPE html>
<html>
   
   <head>
      <title>Confirm Delivery of Order #<?php echo $_GET['id']; ?></title>
	  <link rel="stylesheet" type="text/css" href="https://promousb.in/crm3692/css/crm-stylesheet.css" />	
	  <link rel="icon" href="https://promousb.in/media/favicon/default/promo-usb-logo-favicon-2_1.png" type="image/x-icon" />
<link rel="shortcut icon" href="https://promousb.in/media/favicon/default/promo-usb-logo-favicon-2_1.png" type="image/x-icon" />
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
   </head>
   
   <body>
	
      <div align = "center">
         <div class="login-card">
            <div style = "background-color:#4CAF50; color:#FFFFFF; padding:10px;"><b>Optional Feedback for Order #<?php echo $_GET['id']; ?></b></div>
				
            <div style = "margin:35px 0">
               
               <form class="enquiry-form lead-form" action = "confirmdelivery.php" method = "post" >
			      <input type = "text" name = "id" value="<?php echo $_GET['id']; ?>" hidden="true"/>
                  <label>Comment (optional)</label>
				  <textarea name="comment" rows="5"></textarea>            
                  <input class="red-button" type = "submit" name="submit" value = "MARK AS RECEIVED"/>
				  <div style = "font-size: 18px;color:#4CAF50;margin-top:10px;text-align: center;font-weight: 600;"><?php echo $response; ?></div>
               </form>              
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>