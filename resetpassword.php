<?php
if(isset($_POST['submit']))
{
   include("db_config.php");
   $email = $_POST['email'];
   $password = $_POST['password'];
    $results = $db->query("SELECT password from Users WHERE email = '$email' LIMIT 1"); 
     while ($row = $results->fetch_assoc()){ 
      $current_password = trim($row['password']);	 
      if($current_password == ""){
		$stmt = $db->prepare("Update `Users` SET `password` = ?, `status` = ? WHERE email = '$email';");
      $stmt->bind_param('ss', $password_to_set, $newstatus);
	  $password_to_set = md5($_POST['password']);
	  $newstatus = "active";
      $stmt->execute();	  
        $stmt->close();
		$db->close();	
		echo "<script type='text/javascript'>alert('New Password Created. Login to CRM using your email and new password');</script>";
		echo "<script>window.open('Login.php','_self')</script>";
		 
	  }else{
		  $response = "Error Creating New Password !";
	  }
	  
	  
    }
}

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Create New Password</title>
	  <link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
   </head>
   
   <body>
	<div class = "container">
      <div class="col-form-4 login-card" style="float: none; margin: auto;">
			 <h1 class="title-text">Create New Password</h1>	
            <div>
                <?php $id= $_GET['id']; ?>	
               <form name="myForm" class="enquiry-form lead-form" action = "resetpassword.php" method = "post" onsubmit="return validatePassword()">
                  <input type = "email" name = "email"  value="<?php echo $id; ?>" hidden="true" readonly>
				  <div style = "font-size:12px; color:#cc0000;">Password must be 6-16 characters long and should contain a number and a special character.</div>
                  <label>New Password  :&ensp;</label><input type = "password" name = "password"  required/>
                  <label>Confirm Password  :&ensp;</label><input type = "password" name = "cpassword"  required/>				  
                  <input class="red-button" type = "submit" name="submit" value = " Create Password " style="width: fit-content;"/>
				  <div style = "font-size:15px; color:#cc0000; margin-top:10px"><?php echo $response; ?></div>
               </form>
               
               
					
            </div>
				
         </div>
			
      </div>
	  <script>
	  function validatePassword() {
		  
		  var newPassword = document.forms["myForm"]["password"].value;
		  var cpassword = document.forms["myForm"]["cpassword"].value;
    var minNumberofChars = 6;
    var maxNumberofChars = 16;
    var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    if(newPassword != cpassword){
		alert("Password don't match");
        return false;
	}	
    if(newPassword.length < minNumberofChars || newPassword.length > maxNumberofChars){
		alert("Password must be 6-16 characters long");
        return false;
    }
    if(!regularExpression.test(newPassword)) {
        alert("Password should contain atleast one number and one special character");
        return false;
    }
}
	  </script>

   </body>
</html>