<?php
 include('session.php');
 ?>
<html>
<head><title>Add New Inquiry</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
</head>
<?php  include 'header.php'; ?>

<body style="background: #f5f5f5;"><div class="container">
<div class="col-form white-bg" style="float: none; margin: auto; box-shadow: 0 2px 1px #777;">
<h1 class="title-text">Add New Enquiry</h1>		
<form  name="myForm" class="enquiry-form lead-form"  onsubmit="return validateForm()" action="sendingenquiry.php" method="POST">
<label >Assign to : </label>
<select name="assign_to">
<option value="none">None</option>
<?php
  include 'db_config.php';
  $result= $db->query("SELECT email, name FROM `Users` WHERE access_level = 'sales' OR access_level = 'sales_head' ORDER BY name ASC");
  while($rows = $result->fetch_assoc()) {?>
 <option value="<?php echo trim($rows["email"])?>"><?php echo trim($rows["name"])?></option>
<?php	} ?>
</select>			
<label >Enquiry Source :</label>
<select name="enquiry_source">
<option value="Cold Call">Cold Call</option>
<option value="Email Marketing">Email Marketing</option>
<option value="Exhibition">Exhibition</option>
<option value="Google Ads">Google Ads</option>
<option value="Incoming Call">Incoming Call</option>
<option value="Live Chat">Live Chat</option>
<option value="Reference">Reference</option>
<option value="Social Media">Social Media</option>
<option value="Website">Website</option>
<option value="Other">Other</option>
</select>
<label >Name : </label>
<input type="text" value="" name="customer_name">
<label >Contact No. : </label>
<input type="text" value="" name="contact" >
<label >Email ID : </label>
<input type="text" value="" name="email">
<label >Company Name : </label>
<input type="text" value="" name="company_name">
<label >Location : </label>
<input type="text" value="" name="location">
<label>Brief Description</label>
<textarea name="description" rows="6"></textarea>
		<input class="red-button" type="submit" name="submit" value="Save and Send Enquiry">
		</form>
		</div>
		</div>
		<script type="text/javascript">
		function validateForm() {		
	var email = document.forms["myForm"]["email"].value;
	var contact = document.forms["myForm"]["contact"].value;
	var x = document.forms["myForm"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
if ((email == null || email == "" || atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) || (contact == null || contact == "" ||  isNaN(contact))) {
        alert("Enter a Valid Email ID or a Contact no.");
        return false;
    } 
}
</script>
		</body>
		</html>