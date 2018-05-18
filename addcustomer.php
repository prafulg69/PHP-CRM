<?php
 include('session.php');
 $message= $_GET['campaign'];
 $enquiry_id= $_GET['id'];
 $url = $_GET['url'];
 include 'db_config.php';
 if ($message == "create_lead"){
?>
<html>
<head>
<title>Add Customer and Lead</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
</head>
<script>
function hideShow(str){
if(str.checked == true ){		
document.getElementById("followup_input").style.display='block';		
}	
else{		
document.getElementById("followup_input").style.display='none';	
}}
</script>

<script>
     function handleClick(subscriber) {
		 var currentValue = 0;
	   var email = document.forms["myForm"]["email1"].value;
	var name = document.forms["myForm"]["full_name"].value;
	var x = document.forms["myForm"]["email1"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
	   if (email == null || email == "" || atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length){
		   alert('Email ID and Name is Required to Add Subscriber');
		   document.getElementById('direct_subscriber').checked = false;
		   document.getElementById('reseller_subscriber').checked = false;
		   return false;
	   }
	   else if(name == null || name == ""){
		  alert('Email ID and Name is Required to Add Subscriber');
		  document.getElementById('direct_subscriber').checked = false;
		   document.getElementById('reseller_subscriber').checked = false;
		   return false; 
	   }
	   else{
	var xhttp = new XMLHttpRequest();
	 if(subscriber == "Direct"){
		var url = "https://emailoctopus.com/lists/491f0667-c54e-11e7-8825-026f7644009e/members/external-add"; 
	 }else{
		var url = "https://emailoctopus.com/lists/554f4325-3180-11e7-b170-0244cade5e89/members/external-add";  
	 }
    
    var params = "emailAddress="+email+"&firstName="+name;
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
    xhttp.onreadystatechange = function() {//Call a function when the state changes.
    if(xhttp.readyState == 4 && xhttp.status == 200) {
        //alert(xhttp.responseText);
		document.getElementById("response").innerHTML = "Thanks! Added to Email Subscribers";
		document.getElementById("subscribe").style.display='none';    
    }
} 
 xhttp.send(params); 
 }
   } 
</script>
<body>
<?php include('header.php'); ?>
<div class="container">
<?php
		
		//fetch products from the database
		$results= $db->query("SELECT * FROM `enquiries` where enq_id= '$enquiry_id'");
		while($row = $results->fetch_assoc())
		{
  ?>
<form name="myForm" class="lead-form" onsubmit="return validateForm()" action="addcustomer.php" method="POST">
<input type="text" value="<?php echo $enquiry_id; ?>" name="enquiry_id" hidden="true">
<h1 class="title-text">Add New Customer and Lead</h1>
<div class="cover">
<div class="col-form-2">
<h3 class="subtitle-text">Customer Info</h3>
<label>Full Name</label>
<input type="text" value="<?php echo trim($row["full_name"])?>" name="full_name">
<label class="required-label">Company Name *</label>
<input list="companies" type="text" value="<?php echo trim($row["company"])?>" name="company_name" autocomplete="off">
<datalist id="companies">
<?php
include ('db_config.php');	
  $result= $db->query("SELECT DISTINCT(customer_companyname) FROM `customers` ORDER BY customer_companyname ASC");
  while($rows = $result->fetch_assoc()) {?>
 <option value="<?php echo trim($rows["customer_companyname"])?>">
<?php	} ?>
</datalist>
<label class="required-label">Contact No. *</label>
<input type="text" value="<?php echo trim($row["mobile"])?>" name="mobile">
<label>Customer Email&ensp;&ensp;</label><span id="response"></span>
<input type="email" value="<?php echo trim($row["email"])?>" name="email1">
<div id="subscribe">
<input type="radio" id="direct_subscriber" name="subscriber_type" value="Direct" onclick="handleClick(this.value);"> Add to Direct Subscribers&ensp;&ensp;&ensp;
<input type="radio" id="reseller_subscriber" name="subscriber_type" value="Reseller" onclick="handleClick(this.value);"> Add to Reseller Subscribers<br>
</div>

<label>Customer Type</label>
<select name="customer_type">
<option value="Direct">Direct</option>
<option value="Reseller">Reseller</option>
</select>
<div class="col-form-13">
<label>Secondary Email</label>
<input type="email" value="" name="email2">
</div>
<div class="col-form-13 fl-right">
<label>Alternate Contact No.</label>
<input type="text" value="" name="telephone">
</div>
<label>GST No.</label>
<input type="text" value="" name="gst_no">
<label>Shipping Address</label>
<textarea name="ship_address" rows="4" id="ship_address"></textarea>
<div>
<div class="two-col-left">
<label>Shipping City</label>
<input type="text" value="<?php echo trim($row["location"])?>" name="ship_city" id="ship_city">
</div>
<div class="two-col-right">
<label>Zip Code</label>
<input type="text" value="" name="ship_zip" id="ship_zip">
</div>
</div>
<label>Billing Address&ensp;&ensp;<input type="checkbox" name="billingtoo" onclick="FillBilling(this.form)" style="width:auto;margin: 0;">
<em style="color:#333;">Same as shipping address</em></label>
<textarea name="bill_address" rows="4" id="bill_address"></textarea>
</div>
<div class="col-form-2">
<h3 class="subtitle-text">Lead Info</h3>
<input type="text" value="<?php echo $login_session; ?>" name="lead_owner" hidden="true" readonly>
<!--<select name="lead_owner"><option value=""></option><option value="ishwar@iotenterprise.in">ishwar@iotenterprise.in</option><option value="mohan.jha@customshape.in">mohan.jha@customshape.in</option><option value="nikita.kumawat@customshape.in">nikita.kumawat@customshape.in</option><option value="chiranjeet.das@iotenterprise.in">chiranjeet.das@iotenterprise.in</option><option value="rohan.karbelkar@customshape.in">rohan.karbelkar@customshape.in</option></select>-->
<label class="required-label">Lead Source * (<?php echo trim($row["campaign"])?>)</label>
<select name="lead_source">
<option value=""></option>
<option value="Cold Call">Cold Call</option>
<option value="Email Marketing">Email Marketing</option>
<option value="Exhibition">Exhibition</option>
<option value="Existing Client">Existing Client</option>
<option value="Google Ads">Google Ads</option>
<option value="Incoming Call">Incoming Call</option>
<option value="Live Chat">Live Chat</option>
<option value="Reference">Reference</option>
<option value="Social Media">Social Media</option>
<option value="Website">Website</option>
<option value="Other">Other</option>
</select>
<label class="required-label">Lead Status *</label>
<select name="lead_status">
<option value="contacted" title="You have contacted and spoken with the customer" selected>Contacted</option>
<option value="contact_in_future" title="Contact this customer in future or customer would like to be contacted at some specific time">Contact in Future</option>
<option value="no_answer" title="Customer did not answered your call">Not Answered</option>
<option value="lost" title="Customer purchased the items from other vendor or supplier">Lost Lead</option>
<option value="dead_lead" title="Customer dropped the idea of purchasing this items and don't want to buy them">Dead Lead</option>
</select>
<label>
<input type="checkbox" onclick="hideShow(this)" name="followup" value="true" style="margin-right: 5px;">Set Next Follow up</label>
<input type="datetime-local" name="followupon" value="<?php echo date('Y-m-d\TH:i'); ?>" id="followup_input" style="display:none;">
<label class="trackid-label required-label">Last Action Taken*</label>
<textarea name="lead_remark" rows="4"></textarea>
<div class="col-form-13">
<label>Budget</label>
<input type="text" value="" name="budget">
</div>
<div class="col-form-13 fl-right">
<label>Quantity</label>
<select name="required_qty">
<option value="Less than 50">Less than 50</option>
<option value="50-99">50-99</option>
<option value="100-199" selected>100-199</option>
<option value="200-499">200-499</option>
<option value="500-999">500-999</option>
<option value="1000-1499">1000-1499</option>
<option value="1500 and above">1500 and above</option>
</select>
</div>
<!--<div class="four-col">
<label>Budget</label>
<input type="text" value="" name="budget">
</div>-->
<label>Expected Revenue</label>
<select name="order_value">
<option value="Less than 25K">Less than 25K</option>
<option value="25K - 50K" selected>25K - 50K</option>
<option value="50K - 1L">50K - 1L</option>
<option value="1L - 2L">1L - 2L</option>
<option value="2L - 5L">2L - 5L</option>
<option value="5L - 10L">5L - 10L</option>
<option value="More than 10L">More than 10L</option>
</select>
<label>Interested in</label>
<input list="browsers" type="text" value="" name="interested_in">
<datalist id="browsers">
<option value="Pendrives">
<option value="Card USB">
<option value="Metal USB">
<option value="Swivel USB">
<option value="Wooden USB">
<option value="OTG USB">
<option value="Card OTG USB">
<option value="Pen with USB">
<option value="Crystal USB">
<option value="Wristband USB">
<option value="Slapband USB">
<option value="Cube USB">
<option value="Leather USB">
<option value="Pen with USB">
<option value="Powerbanks">
<option value="Card Powerbank">
<option value="Bluetooth Speakers">
<option value="Bluetooth Headphones">
<option value="Activity Trackers">
<option value="Diary with USB">
<option value="Diary with Powerbank">
<option value="VR Box">
<option value="Smart Bottle">
<option value="Other">
</datalist>
<label>Lead Description</label>
<textarea name="lead_description" rows="5" placeholder="Mention any specific customer requirements..."><?php echo trim($row["looking_for"])?></textarea>

</div>

</div>
<button class="full-width-btn" type="submit" name="submit">SAVE CUSTOMER & LEAD</button>
</form>
		<?php } ?>
</div>
<script type="text/javascript">
function FillBilling(f) { 
if(f.billingtoo.checked == true) {
	var shipping_address = f.ship_address.value;
	var shipping_city = f.ship_city.value;
	var shipping_zip = f.ship_zip.value;
	var a = " - ";
	var b = "\n";
	var c = shipping_city.concat(a, shipping_zip);
	var billing_address = shipping_address.concat(b,c);
	f.bill_address.value = billing_address; 
	} 
	else {
		f.bill_address.value = ""; 
		} 
		}
</script>

	<script type="text/javascript">
		function validateForm() {		
	var contact = document.forms["myForm"]["mobile"].value;
	var company_name = document.forms["myForm"]["company_name"].value;
	var lead_source = document.forms["myForm"]["lead_source"].value;     
	var lead_remark = document.forms["myForm"]["lead_remark"].value;

	if (contact == null || contact == "" || isNaN(contact)) {
        alert("Error: Customer's contact no is invalid");
        return false;
    }
	else if (company_name == null || company_name == "" ) {
        alert("Error: Company name is missing");
        return false;
    }
    else if (lead_source == null || lead_source == "" ) {
        alert("Error: Select Lead Source");
        return false;
    } 
	else if (lead_remark == null || lead_remark == "" ) {

        alert("Error: Last Action Taken is missing");

        return false;

    }
}
</script>
</body>
</html>
<?php	
	}
	elseif($message == "edit_enquiry"){
				
			
		echo '<html><head><title>Edit this Inquiry</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet"></head>';
include 'header.php';
$results= $db->query("SELECT * FROM `customshape_data` where enq_id= '$enquiry_id'");
		while($row = $results->fetch_assoc())
		{
echo '<body><div class="container">
<div class="col-form" style="float: none; margin: auto; border: 1px solid #ccc;"><h1 class="title-text">Update this Enquiry</h1>		
		<form class="enquiry-form lead-form" action="updatingenquiry.php" method="POST">
<input type="text" value="'.$enquiry_id.'" name="enq_id" hidden="true">
<input type="text" value="'.$url.'" name="url" hidden="true">				
<label >Enquiry Source :</label>
<select name="enquiry_source">
<option value="'.$row['campaign'].'">'.$row['campaign'].'</option>
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
<input type="text" value="'.$row['full_name'].'" name="customer_name">
<label >Contact No. : </label>
<input type="text" value="'.$row['mobile'].'" name="contact" >
<label >Email ID : </label>
<input type="text" value="'.$row['email'].'" name="email">
<label >Company Name : </label>
<input type="text" value="'.$row['company'].'" name="company_name">
<label>Brief Description</label>
<textarea name="description" rows="6">'.$row['looking_for'].'</textarea>
		<input class="red-button" type="submit" name="submit" value="Update Enquiry">
		</form></div></div></body></html>';
	}
	}
	elseif($message == "assign_enquiry"){
	echo '<html><head><title>Assign this Inquiry</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet"></head>';
include 'header.php';
echo '<body style="background: #f9f9f9;"><div class="container">
<div class="col-form-4" style="float: none; margin: auto;"><h1 class="title-text">Assign this Enquiry</h1>		
		<form class="enquiry-form lead-form" action="assigningenquiry.php" method="POST">
<input type="text" value="'.$enquiry_id.'" name="enq_id" hidden="true">
<input type="text" value="'.$url.'" name="url" hidden="true">				
<label >Select Sales Person : </label>
<select name="assign_to">
<option value="info@customshape.in">None</option>';
  $result= $db->query("SELECT email, name FROM `Users` WHERE access_level = 'sales' OR access_level = 'sales_head' AND status = 'active' ORDER BY name ASC");
  while($rows = $result->fetch_assoc()) {
  echo '<option value="'.$rows['email'].'">'.$rows['name'].'</option>'; }
echo '</select>
<input class="red-button" type="submit" name="submit" value="Save">
</form></div></div></body></html>';	
	}
	
	elseif($message == "trash_enquiry"){
	echo '<html><head><title>Trash this Enquiry</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet"></head>';
include 'header.php';
echo '<body style="background: #f9f9f9;"><div class="container">
<div class="col-form-4" style="float: none; margin: auto;"><h1 class="title-text">Trash this Enquiry</h1>		
		<form class="enquiry-form lead-form" action="trashingenquiry.php" method="POST">
<input type="text" value="'.$enquiry_id.'" name="enq_id" hidden="true">
<input type="text" value="'.$url.'" name="url" hidden="true">				
<label >Are you sure you want to trash this enquiry ?</label>
<input class="red-button" type="submit" name="submit" value="Yes, sure !">
</form></div></div></body></html>';	
	}
	?>
	
<?php
if(isset($_POST['submit']))
{
	date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i:s");
$lead_owner=trim(addslashes($_POST['lead_owner']));
$required_qty=trim(addslashes($_POST['required_qty']));
$budget= trim(addslashes($_POST['budget']));
$full_name=trim(addslashes($_POST['full_name']));
$mobile=trim(addslashes($_POST['mobile']));
$telephone=trim(addslashes($_POST['telephone']));
$gst_no=trim(addslashes($_POST['gst_no']));
$ship_address=trim(addslashes($_POST['ship_address']));
$ship_city=trim(addslashes($_POST['ship_city']));
$ship_zip=trim(addslashes($_POST['ship_zip']));
$bill_address=trim(addslashes($_POST['bill_address']));
$lead_source=trim(addslashes($_POST['lead_source']));
$company_name=trim(addslashes($_POST['company_name']));
$email1=trim(addslashes($_POST['email1']));
$email2=trim(addslashes($_POST['email2']));
$location=trim(addslashes($_POST['location']));
$lead_description=trim(addslashes($_POST['lead_description']));
$customer_type=trim(addslashes($_POST['customer_type']));
$lead_remark=trim(addslashes($_POST['lead_remark']));
$lead_remark = "<p><b>".$lead_owner."</b><br>".$lead_remark."<span>".$fulldate."</span></p>";
$lead_status=trim(addslashes($_POST['lead_status']));
$enquiry_id=$_POST['enquiry_id'];
$followup=$_POST['followup'];
$followupon=$_POST['followupon'];
$interested_in=trim(addslashes($_POST['interested_in']));
$order_value=trim(addslashes($_POST['order_value']));
$url = "leadstable.php?person=".$lead_owner;

$results1 = $db->query("SELECT `customer_owner` FROM customers WHERE lower(`customer_companyname`) = lower('$company_name') OR lower(`customer_contactno1`) = lower('$mobile')");
if(mysqli_num_rows($results1)>=1)
           {
			   while($row1 = $results1->fetch_assoc()) {
			$existmessage = "<p><b>Error : </b>A customer with matching company name or contact number already exist.</p><p>Customer Owner : ".$row1["customer_owner"]."</p>";
            echo $existmessage;
			   }
           }
         else
            {
	$results2 = $db->query("INSERT INTO `customers` (`customer_name`, `customer_contactno1`, `customer_email1`, `customer_companyname`, `customer_type`, `customer_email2`, `customer_contactno2`, `customer_gstno`, `customer_shipaddress`, `customer_shipcity`, `customer_shipzip` , `customer_billaddress`, `customer_owner`, `no_of_leads`) VALUES ('$full_name', '$mobile', '$email1', '$company_name', '$customer_type', '$email2', '$telephone', '$gst_no', '$ship_address', '$ship_city', '$ship_zip', '$bill_address', '$lead_owner', '1');");
	
	$customer_id = $db->insert_id;

	$results3 = $db->query("INSERT INTO `leads` (`customer_id`, `enq_id`, `lead_owner`, `required_qty`, `budget`, `lead_source`, `lead_description`, `full_date`, `lead_remark`, `last_action_date`, `lead_status`, `followup`, `followupon`, `interested_in`, `order_value`) VALUES (
	'$customer_id', '$enquiry_id', '$lead_owner', '$required_qty', '$budget', '$lead_source', '$lead_description', '$fulldate', '$lead_remark', '$fulldate', '$lead_status',	'$followup', '$followupon', '$interested_in',  '$order_value');");
	
	if($results3){      
		$results4 = $db->query("UPDATE `enquiries` SET `lead_created` = '1' WHERE `enq_id` = '$enquiry_id'");
	    if($results4)
			{
              echo "<script type='text/javascript'>alert('New Customer and Lead Added');</script>";
               echo "<script>window.open('$url','_self')</script>";
            }
    }
    else {
          echo "<script type='text/javascript'>alert('Error Adding This Lead');</script>";
    }
  }
}
?>