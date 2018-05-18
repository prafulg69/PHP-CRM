<?php
if(isset($_POST['submit']))
{
   include("db_config.php");
   session_start();
   
      $myusername = $_POST['email'];
      $mypassword = md5($_POST['password']);
      $accountstatus = "active";
	  $stmt = $db->prepare('SELECT access_level FROM Users WHERE email = ? and password = ? and status = ? LIMIT 1');
      $stmt->bind_param('sss', $myusername,$mypassword,$accountstatus);
      $stmt->execute();
	  $stmt->bind_result($access_level);
      $stmt->store_result();
	  
     
   
   
   if($stmt->num_rows == 1)  //To check if the row exists
        {
			date_default_timezone_set('Asia/Kolkata');
            $fulldate= date("Y-m-d H:i");
			$results = $db->query("UPDATE Users SET login_time = '$fulldate' WHERE email = '$myusername'");
			
            while($stmt->fetch()) //fetching the contents of the row

              {
               $_SESSION['login_user'] = $myusername;
			      if($access_level== "sales"){
					 header("location: sales-dashboard.php"); 
				  }
				  elseif($access_level== "sales_head"){
					 header("location: saleshead-dashboard.php"); 
				  }
				  elseif($access_level== "production"){
					header("location: production-dashboard.php");   
				  }
               
               }

        }
        else {
            $error = "Your Login Email or Password Don't Match !";
        }
        $stmt->close();
		$db->close();
    }

?>
<!DOCTYPE html>
<html>
   
   <head>
      <title>Login to CRM</title>
	  <link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
   </head>
   
   <body style="background: url(https://crm2308.customshape.in/images/login-background.jpg) no-repeat; background-size: cover;">
	
      <div align = "center">
         <div class="login-card" style="background: rgba(255, 255, 255, 0.5);margin-top: 5em;">
            <div style = "background-color:#000; color:#FFFFFF; padding:10px;"><b>Login to CRM</b></div>
				
            <div>
               
               <form class="enquiry-form lead-form" action = "Login.php" method = "post" >
                  <label>Email  :&ensp;</label><input type = "email" name = "email"  style="width: auto;" required/>
                  <label>Password  :&ensp;</label><input type = "password" name = "password"  style="width: auto; margin-bottom: 2.5em;" required/>
                  <input class="red-button" type = "submit" name="submit" value = " Login "/>
				  <div style = "font-size:15px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
               </form>
               
               
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>