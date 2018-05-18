<?php
 include('session.php');
 $cust_id= $_GET['custid'];
 $url = $_GET['url'];
 include 'db_config.php';
?>
<html>
<head>
<title>Customer Info</title>
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
<?php include('header.php'); ?>
<div class="container">
<?php
		
		//fetch products from the database
		$results= $db->query("SELECT * FROM `customers` where customer_id= '$cust_id'");
		while($row = $results->fetch_assoc())
		{
			$original_lead_owner = trim($row['customer_owner']);
  ?>
  


<div class="cover">
<div class="col-form-6">
  <h1 class="title-text"><?php echo trim($row["customer_companyname"])?></h1>
</div>
<div class="fl-right" style="padding-right: 10px;">
  <a href="sampleorderform.php?custid=<?php echo $cust_id; ?>" class="red-button-2">Send Sample</a>&ensp;
  <a href="newlead.php?custid=<?php echo $cust_id; ?>" class="red-button-2">New Lead</a>&ensp;
  <a href="orderform.php?custid=<?php echo $cust_id; ?>&leadid=1" class="red-button-2">New Order</a>
</div>
<div class="col-form-12 border-frame grey-bg" style="margin-right: 30px;">
<form name="myForm" class="lead-form" onsubmit="return validateForm()" action="customerinfo.php" method="POST">
<input type="text" value="<?php echo $cust_id; ?>" name="cust_id" hidden="true">
<input type="text" value="<?php echo $original_lead_owner; ?>" name="original_lead_owner" hidden="true">
<h3 class="subtitle-text">Customer Info</h3>
 
<label>Sales Representative</label>
 <select name="customer_owner" onchange="newOwnerMessage();">
<option value="<?php echo $original_lead_owner; ?>" selected><?php echo $original_lead_owner; ?></option>
<?php 
  $result= $db->query("SELECT email FROM `Users` WHERE email != '$original_lead_owner' AND (access_level = 'sales' OR access_level = 'sales_head') ORDER BY name ASC ");
  while($rows = $result->fetch_assoc()) { ?>
  <option value="<?php echo trim($rows["email"])?>"><?php echo trim($rows["email"])?></option>
 <?php	}?></select>
 
<label>Full Name</label>
<input type="text" value="<?php echo trim($row["customer_name"])?>" name="full_name">
<label class="required-label">Company Name *</label>
<input list="companies" type="text" value="<?php echo trim($row["customer_companyname"])?>" name="company_name" autocomplete="off">
<datalist id="companies">
<?php
include ('db_config.php');	
  $result= $db->query("SELECT DISTINCT(customer_companyname) FROM `customers` ORDER BY customer_companyname ASC");
  while($rows = $result->fetch_assoc()) {?>
 <option value="<?php echo trim($rows["customer_companyname"])?>">
<?php	} ?>
</datalist>
<label class="required-label">Contact No. *</label>
<input type="text" value="<?php echo trim($row["customer_contactno1"])?>" name="mobile">
<label>Customer Email&ensp;&ensp;</label><span id="response"></span>
<input type="email" value="<?php echo trim($row["customer_email1"])?>" name="email1">
<div id="subscribe">
<input type="radio" id="direct_subscriber" name="subscriber_type" value="Direct" onclick="handleClick(this.value);"> Add to Direct Subscribers&ensp;&ensp;&ensp;
<input type="radio" id="reseller_subscriber" name="subscriber_type" value="Reseller" onclick="handleClick(this.value);"> Add to Reseller Subscribers<br>
</div>

<label>Customer Type</label>
<?php $options = trim($row['customer_type']); ?>
<select name="customer_type">
<option value="Direct" <?php if($options=="Direct") echo 'selected="selected"'; ?>>Direct</option>
<option value="Reseller" <?php if($options=="Reseller") echo 'selected="selected"'; ?>>Reseller</option>
</select>
<div class="col-form-13">
<label>Secondary Email</label>
<input type="email" value="<?php echo trim($row["customer_email2"])?>" name="email2">
</div>
<div class="col-form-13 fl-right">
<label>Alternate Contact No.</label>
<input type="text" value="<?php echo trim($row["customer_contactno2"])?>" name="telephone">
</div>
<label>GST No.</label>
<input type="text" value="<?php echo trim($row["customer_gstno"])?>" name="gst_no">
<label>Shipping Address</label>
<textarea name="ship_address" rows="4" id="ship_address"><?php echo trim($row["customer_shipaddress"])?></textarea>
<div>
<div class="two-col-left">
<label>Shipping City</label>
<input type="text" value="<?php echo trim($row["customer_shipcity"])?>" name="ship_city" id="ship_city">
</div>
<div class="two-col-right">
<label>Zip Code</label>
<input type="text" value="<?php echo trim($row["customer_shipzip"])?>" name="ship_zip" id="ship_zip">
</div>
</div>
<label>Billing Address&ensp;&ensp;<input type="checkbox" name="billingtoo" onclick="FillBilling(this.form)" style="width:auto;margin: 0;">
<em style="color:#333;">Same as shipping address</em></label>
<textarea name="bill_address" rows="4" id="bill_address"><?php echo trim($row["customer_billaddress"])?></textarea>
<button class="red-button" type="submit" name="submit">Save Changes</button>
</form>
</div>
<?php } ?>
<div class="col-form-14 border-frame grey-bg">
<h3 class="subtitle-text">Orders</h3>
<table>
    <tr class="header">
		<td>Products</td>
		<td>Amount</td>
        <td>Status</td> 		
		<td>Order Date</td>
        <td>Sales Person</td>		
		<td>Options</td> 
    </tr>	
 <?php
		date_default_timezone_set('Asia/Kolkata');
$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.*,DATE_FORMAT(orders.Order_Date, '%d %m %Y') FROM customers INNER JOIN orders ON customers.customer_id = orders.customer_id WHERE customers.customer_id = '$cust_id' ORDER BY UNIX_TIMESTAMP(orders.Order_Date) DESC LIMIT 6"); 

$results2 = $db->query("SELECT FOUND_ROWS() AS count");
while($row = $results->fetch_assoc()) {	
    while($row2 = $results2->fetch_assoc()){				
		$count = $row2['count'];			
	}
    $create_date = new DateTime($row["Order_Date"]); 
           $productname2 = trim($row["Product_Name2"]);
			$productname3 = trim($row["Product_Name3"]);
			$productname4 = trim($row["Product_Name4"]);
			$productname5 = trim($row["Product_Name5"]);
			if($productname2 != ""){
				$a = 1;
			}
			if($productname3 != ""){
				$a = 2;
			}
			if($productname4 != ""){
				$a = 3;
			}
			if($productname5 != ""){
				$a = 4;
			}	?>
    <tr>
	    <td><?php echo $row["Product_Name1"]; if($productname2 != ""){ echo "&ensp;<span class='lead_count'>+".$a." more</span>"; }?></td>
		<td>Rs. <?php echo $row["Grand_Total"] ?></td>
        <td><?php echo $row["Order_Status"]?></td> 		
		<td class="date"><?php echo $create_date->format('h:i A d-M-y') ?></td>		
        <td><?php echo substr($row["Sales_Rep_Email"], 0, strpos($row["Sales_Rep_Email"], '@')) ?></td>		
		<td><a href="ordertable.php?url=&searchtype=idsearch&id=<?php echo $row["Order_ID"] ?>">Show</a></td>  
	</tr><?php	
	} ?>
</table>
<?php echo "<p class='center-text'>".$count." Orders Found "; if($count > 6){ echo "<a href='ordertable.php?url=&searchtype=customeridsearch&custid=".$cust_id."'>&ensp;Show All</a>"; } echo "</p>";  ?>
</div>
<div>&nbsp;</div>
<div class="col-form-14 border-frame grey-bg">
<h3 class="subtitle-text">Leads</h3>
<table>
    <tr class="header">
		<td>Budget</td>
		<td>Quantity</td>
        <td>Expected Revenue</td> 
        <td>Interested in</td>
        <td>Status</td>		
		<td>Created on</td>						
		<td>Options</td> 
    </tr>	
 <?php
		date_default_timezone_set('Asia/Kolkata');
$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*,DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id = leads.customer_id WHERE customers.customer_id = '$cust_id' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT 6"); 

$results2 = $db->query("SELECT FOUND_ROWS() AS count");
while($row = $results->fetch_assoc()) {	
    while($row2 = $results2->fetch_assoc()){				
		$count2 = $row2['count'];			
	}
    $create_date = new DateTime($row["full_date"]); 	?>
    <tr>
	    <td><?php echo $row["budget"]?></td>
		<td><?php echo $row["required_qty"]?></td>
        <td>Rs. <?php echo $row["order_value"]?></td> 
		<td><?php echo $row["interested_in"]?></td> 
        <td><?php echo $row["lead_status"]?></td>  		
		<td class="date"><?php echo $create_date->format('h:i A d-M-y') ?></td>						
		<td class="tbl-dropdown"><form action="editlead.php" method="GET">
	    <input type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden="true" name="url">
		<input type="text" value="<?php echo $row["customer_id"]?>" hidden="true" name="custid">
	    <input type="text" value="<?php echo $row["lead_id"]?>" hidden="true" name="id">
		<select name="action" onchange="this.form.submit()"><option value=""></option><!--<option value="priority">Set Priority</option>--><option value="send_quote">Send Quote</option><option value="edit">Update Lead</option><option value="convert">Convert Lead</option></select></form></td>  
	</tr><?php	
	} ?>
</table>
<?php echo "<p class='center-text'>".$count2." Leads Found "; if($count2 > 6){ echo "<a href='leadstable.php?url=&searchtype=customeridsearch&custid=".$cust_id."'>&ensp;Show All</a>"; } echo "</p>";  ?>
</div>
<div>&nbsp;</div>
<div class="col-form-14 border-frame grey-bg">
<h3 class="subtitle-text">Samples</h3>
<table>
    <tr class="header">
		<td>Item sent</td>
		<td>Quantity</td>
		<td>Returnable</td>
		<td>Status</td>
		<td>Order Date</td>
		<td>Days</td>
		<td>Options</td>
    </tr>	
 <?php
		date_default_timezone_set('Asia/Kolkata');
$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, sample_orders.*,DATE_FORMAT(sample_orders.Order_Date, '%d %m %Y') FROM customers INNER JOIN sample_orders ON customers.customer_id = sample_orders.customer_id WHERE customers.customer_id = '$cust_id' ORDER BY UNIX_TIMESTAMP(sample_orders.Order_Date) DESC LIMIT 2"); 

$results3 = $db->query("SELECT FOUND_ROWS() AS count");
while($row = $results->fetch_assoc()) {	
    while($row3 = $results3->fetch_assoc()){				
		$count3 = $row3['count'];			
	}
    $orderdate = new DateTime($row["Order_Date"]); 		
    $del_date = strtotime($orderdate->format('d-m-Y'));
	$today = strtotime(date('d-m-Y'));
	$diff=$today-$del_date;
	$days = 0;
	$days=floor($diff/(60*60*24));	 	?>
    <tr>
	   <td><?php echo $row["Product_Name1"] ?></td>					
		<td><?php echo $row["Quantity1"]?></td>
        <td><?php echo $row["Returnable_Basis"]?></td>	
		<td><?php echo $row["Order_Status"]?></td>	
		<td class="date"><?php echo $orderdate->format('d-M-y H:i') ?></td>		
        <td><?php echo $days; ?> Days ago</td> 
        <td class="tbl-dropdown"><a href="editsampleorder.php?id=<?php echo $row["Order_ID"]?>&custid=<?php echo $row["customer_id"]?>" title="Edit Order or Change Status">SHOW</a></td>
	</tr><?php	
	} ?>
</table>
<?php echo "<p class='center-text'>".$count3." Samples Found "; if($count3 > 2){ echo "<a href='samplestable.php?searchtype=customeridsearch&custid=".$cust_id."'>&ensp;Show All</a>"; } echo "</p>";  ?>
</div>
</div>
		
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
		
		function newOwnerMessage()
{
        alert('Selecting a new customer owner will transfer this customer to the selected sales person.');
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
	date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i:s");
$cust_id=trim(addslashes($_POST['cust_id']));
$original_lead_owner= trim($_POST['original_lead_owner']);
$customer_owner=trim(addslashes($_POST['customer_owner']));
$full_name=trim(addslashes($_POST['full_name']));
$company_name=trim(addslashes($_POST['company_name']));
$mobile=trim(addslashes($_POST['mobile']));
$email1=trim(addslashes($_POST['email1']));
$customer_type=trim(addslashes($_POST['customer_type']));
$email2=trim(addslashes($_POST['email2']));
$telephone=trim(addslashes($_POST['telephone']));
$gst_no=trim(addslashes($_POST['gst_no']));
$ship_address=trim(addslashes($_POST['ship_address']));
$ship_city=trim(addslashes($_POST['ship_city']));
$ship_zip=trim(addslashes($_POST['ship_zip']));
$bill_address=trim(addslashes($_POST['bill_address']));

$url = "customerinfo.php?url=&custid=".$cust_id;

$results = $db->query("UPDATE `customers` SET `customer_name` = '$full_name', `customer_contactno1` = '$mobile', `customer_email1` = '$email1', `customer_companyname` = '$company_name', `customer_type` = '$customer_type', `customer_email2` = '$email2', `customer_contactno2` = '$telephone', `customer_gstno` = '$gst_no', `customer_shipaddress` = '$ship_address', `customer_shipcity` = '$ship_city', `customer_shipzip` = '$ship_zip', `customer_billaddress` = '$bill_address', `customer_shipzip` = '$ship_zip', `customer_owner` = '$customer_owner' WHERE customer_id = '$cust_id';");
	if($results)
{      
echo '<p>Customer Info Updated...</p><br>';
 if($original_lead_owner != $customer_owner){
echo '<p>Transferring this Customer...</p>';	
$leadurl = "https://crm2308.customshape.in/customerinfo.php?url=&custid=".$cust_id;
$headers = "From: CustomShape CRM<".$original_lead_owner.">\r\n";
$headers .= "Reply-To: ".$original_lead_owner."\r\n";
$headers .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers .= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
$subject = $original_lead_owner." Transferred you a Lead";
$message = '<p>Hello,</p>';
$message .= '<p>'.$original_lead_owner.' have transferred you a new Customer. <a href="'.$leadurl.'">See Customer Details</a></p>';

mail($lead_owner,$subject,$message,$headers);
echo '<p>Customer Transferred...</p>';
}
echo "<script type='text/javascript'>alert('Customer Info Updated');</script>";
 echo "<script>window.open('$url','_self')</script>";
	}
	else
{
echo "<script type='text/javascript'>alert('Error Updating Customer Info');</script>";
}
}
?>