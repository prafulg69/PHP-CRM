<?php
if(isset($_POST['submit']))
{
   include("db_config.php");
   session_start();
         
      
	  $stmt = $db->prepare('INSERT INTO Users (email, name, access_level) VALUES (?, ?, ?)');
      $stmt->bind_param('sss', $email,$username,$access_level);
	  $email = $_POST['email'];
      $username = $_POST['name'];
	  $access_level = $_POST['access_level'];
      $stmt->execute();
	  
        $response = $username." created as new user. Now ".$username." will receive an email with a link to create his/her Password";
        $stmt->close();
		$db->close();
$url1 = "https://crm2308.customshape.in/resetpassword.php?id=".$email;
$headers = "From: CustomShape CRM <noreply@customshape.in>\r\n";
$headers .= "Reply-To: noreply@customshape.in\r\n";
$headers .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers.= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;	
$subject = "Welcome ".$username.", Create Your Account Password";
$message = '<p>Hello '.$username.',</p>';
$message .= '<p><a href="'.$url1.'">Click Here</a> to create your account password then Login using this email id and your new created password</p>';


mail($email,$subject,$message,$headers);
    }

?>
<!DOCTYPE html>
<html>
  <?php
  include('session.php');
?>  
   <head>
      <title>Create New User</title>
	  <link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
   </head>
   
   <body style="background: #f9f9f9;">
	<?php include('header.php'); ?>
	<div class = "container">
      <div class="col-form-4 login-card" style="float: none; margin: auto;">
			 <h1 class="title-text">Create New User</h1>	
            <div>
               
               <form class="enquiry-form lead-form" action = "createuser.php" method = "post" >
                  <label>Email  :&ensp;</label><input type = "email" name = "email"  style="width:  auto;" required/>
                  <label>User Name  :&ensp;</label><input type = "text" name = "name"  style="width:  auto;" required/>
				  <label>Access Level  :&ensp;</label>
				  <select name="access_level">
                  <option value="sales_head">Sales Head</option>
                  <option value="sales" selected="selected">Sales</option>
                  <option value="production">Production</option>
                  </select>
                  <input class="red-button" type = "submit" name="submit" value = " Create " style="width: fit-content;"/>
				  <div style = "font-size:15px; color:#cc0000; margin-top:10px"><?php echo $response; ?></div>
               </form>
               
               
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>