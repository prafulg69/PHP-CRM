<?php
 include('session.php');
 
 ?>
<html>
<head>
<title>Add New Customer</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
</head>

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
<?php  include('header.php'); ?>
<div class="container">
<form name="myForm" class="lead-form" onsubmit="return validateForm()" action="newcustomer.php" method="POST">

<h1 class="title-text">Add New Customer</h1>
<div class="cover">
<div class="col-form-2">
<h3 class="subtitle-text">Customer Info</h3>
<label>Full Name</label>
<input type="text" value="" name="full_name">
<label class="required-label">Company Name *</label>
<input list="companies" type="text" value="" name="company_name" autocomplete="off">
<datalist id="companies">
<?php
include ('db_config.php');	
  $result= $db->query("SELECT DISTINCT(customer_companyname) FROM `customers` ORDER BY customer_companyname ASC");
  while($rows = $result->fetch_assoc()) {?>
 <option value="<?php echo trim($rows["customer_companyname"])?>">
<?php	} ?>
</datalist>
<label class="required-label">Contact No. *</label>
<input type="text" value="" name="mobile">
<label >Customer Email&ensp;&ensp;</label><span id="response"></span>
<input type="text" value="" name="email1">
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
<input type="text" value="" name="email2">
</div>
<div class="col-form-13 fl-right">
<label>Alternate Contact No.</label>
<input type="text" value="" name="telephone">
</div>
</div>
<div class="col-form-2">
<h3 class="subtitle-text">Billing & Shipping Info</h3>
<label>Customer Owner</label>
<input type="text" value="<?php echo $login_session; ?>" name="lead_owner" readonly>
<!--<select name="lead_owner"><option value=""></option><option value="ishwar@iotenterprise.in">ishwar@iotenterprise.in</option><option value="mohan.jha@customshape.in">mohan.jha@customshape.in</option><option value="nikita.kumawat@customshape.in">nikita.kumawat@customshape.in</option><option value="chiranjeet.das@iotenterprise.in">chiranjeet.das@iotenterprise.in</option><option value="rohan.karbelkar@customshape.in">rohan.karbelkar@customshape.in</option></select>-->
<label>GST No.</label>
<input type="text" value="" name="gst_no">
<label>Shipping Address</label>
<textarea name="ship_address" rows="4" id="ship_address"></textarea>
<div>
<div class="two-col-left">
<label>Shipping City</label>
<input type="text" value="" name="ship_city" id="ship_city">
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

</div>
<button class="full-width-btn" type="submit" name="submit">SAVE CUSTOMER</button>
</form>
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

	if (contact == null || contact == "" || isNaN(contact)) {
        alert("Error: Customer's contact no is invalid");
        return false;
    }
    else if (company_name == null || company_name == "" ) {
        alert("Error: Company name is missing");
        return false;
    } 
}
</script>
</body>
</html>
	
<?php
if(isset($_POST['submit']))
{
	include ('db_config.php');	
	
	date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i:s");
$lead_owner=trim(addslashes($_POST['lead_owner']));
$full_name=trim(addslashes($_POST['full_name']));
$mobile=trim(addslashes($_POST['mobile']));
$telephone=trim(addslashes($_POST['telephone']));
$company_name=trim(addslashes($_POST['company_name']));
$email1=trim(addslashes($_POST['email1']));
$email2=trim(addslashes($_POST['email2']));
$customer_type=trim(addslashes($_POST['customer_type']));
$gst_no=trim(addslashes($_POST['gst_no']));
$ship_address=trim(addslashes($_POST['ship_address']));
$ship_city=trim(addslashes($_POST['ship_city']));
$ship_zip=trim(addslashes($_POST['ship_zip']));
$bill_address=trim(addslashes($_POST['bill_address']));

$url = "leadstable.php?person=".$lead_owner;

$results1 = $db->query("SELECT `customer_owner` FROM customers WHERE lower(`customer_companyname`) = lower('$company_name') OR lower(`customer_contactno1`) = lower('$mobile')");
//$results1 = $db->query("SELECT * FROM `customers` WHERE `customer_id` = '1'");

if(mysqli_num_rows($results1) >=1)
           {
			   
			   while($row1 = $results1->fetch_assoc()) {
		
			$existmessage = "Error : A customer with matching company name or contact number already exist. Customer Owner : ".$row1["customer_owner"];
            //echo $existmessage;
			echo "<script type='text/javascript'>alert('Error : A customer with matching company name or contact number already exist. Customer Owner : ".$row1["customer_owner"]."');</script>";
			   }
           }
		 else
            {  
	$results = $db->query("INSERT INTO `customers` (`customer_name`, `customer_contactno1`, `customer_email1`, `customer_companyname`, `customer_type`, `customer_email2`, `customer_contactno2`, `customer_gstno`, `customer_shipaddress`, `customer_shipcity`, `customer_shipzip`,`customer_billaddress`, `customer_owner`) VALUES (
	'$full_name',
	'$mobile',
	'$email1',
	'$company_name',
	'$customer_type',
	'$email2',
	'$telephone',
	'$gst_no',
	'$ship_address',
	'$ship_city',
	'$ship_zip',
	'$bill_address',
	'$lead_owner');");
	if($results){      
echo "<script type='text/javascript'>alert('New Customer Added Successfully');</script>";
header("location: $url");
}
else
{
echo "<script type='text/javascript'>alert('Error Adding This Customer');</script>";
}
			}

}
?>