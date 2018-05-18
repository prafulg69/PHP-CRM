<?php
 include('session.php');
 $cust_id= $_GET['custid'];
 include 'db_config.php';
?>
<html>
<head>
<title>Add New Lead of Customer</title>
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

<body>
<?php include('header.php'); ?>
<div class="container">
<?php
		
		//fetch products from the database
		$results= $db->query("SELECT * FROM `customers` where customer_id= '$cust_id'");
		while($row = $results->fetch_assoc())
		{
  ?>
<form name="myForm" class="lead-form" onsubmit="return validateForm()" action="newlead.php" method="POST">
<input type="text" value="<?php echo $cust_id; ?>" name="cust_id" hidden="true">
<input type="text" value="<?php echo $login_session; ?>" name="lead_owner" hidden="true" readonly>
<h1 class="title-text">Add New Lead of <?php echo trim($row["customer_companyname"])?></h1>
<div class="cover">
<div class="col-form-2" style="opacity: 0.6;">
<h3 class="subtitle-text">Customer Info&ensp;<a href="customerinfo.php?url=&custid=<?php echo $cust_id; ?>" target="_blank"><span>(Edit)</span></a></h3>
<label>Customer Owner</label>
<input type="text" value="<?php echo trim($row["customer_owner"])?>" name="customer_owner" readonly>
<label>Full Name</label>
<input type="text" value="<?php echo trim($row["customer_name"])?>" name="full_name" readonly>
<label>Company Name</label>
<input type="text" value="<?php echo trim($row["customer_companyname"])?>" name="company_name" readonly>
<label>Contact No.</label>
<input type="text" value="<?php echo trim($row["customer_contactno1"])?>" name="mobile" readonly>
<label>Customer Email</label>
<input type="email" value="<?php echo trim($row["customer_email1"])?>" name="email1" readonly>

<label>Customer Type</label>
<input type="text" value="<?php echo trim($row["customer_type"])?>" name="customer_type" readonly>
<div class="col-form-13">
<label>Secondary Email</label>
<input type="email" value="<?php echo trim($row["customer_email2"])?>" name="email2" readonly>
</div>
<div class="col-form-13 fl-right">
<label>Alternate Contact No.</label>
<input type="text" value="<?php echo trim($row["customer_contactno2"])?>" name="telephone" readonly>
</div>
<label>GST No.</label>
<input type="text" value="<?php echo trim($row["customer_gstno"])?>" name="gst_no" readonly>
<label>Shipping Address</label>
<textarea name="ship_address" rows="4" id="ship_address" readonly><?php echo trim($row["customer_shipaddress"])?></textarea>
<div>
<div class="two-col-left">
<label>Shipping City</label>
<input type="text" value="<?php echo trim($row["customer_shipcity"])?>" name="ship_city" id="ship_city" readonly>
</div>
<div class="two-col-right">
<label>Zip Code</label>
<input type="text" value="<?php echo trim($row["customer_shipzip"])?>" name="ship_zip" id="ship_zip" readonly>
</div>
</div>
<label>Billing Address</label>
<textarea name="bill_address" rows="4" id="bill_address" readonly><?php echo trim($row["customer_billaddress"])?></textarea>
</div>
<div class="col-form-2">
<h3 class="subtitle-text">Lead Info</h3>
<!--<select name="lead_owner"><option value=""></option><option value="ishwar@iotenterprise.in">ishwar@iotenterprise.in</option><option value="mohan.jha@customshape.in">mohan.jha@customshape.in</option><option value="nikita.kumawat@customshape.in">nikita.kumawat@customshape.in</option><option value="chiranjeet.das@iotenterprise.in">chiranjeet.das@iotenterprise.in</option><option value="rohan.karbelkar@customshape.in">rohan.karbelkar@customshape.in</option></select>-->
<label class="required-label">Lead Source *</label>
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
<textarea name="lead_description" rows="5" placeholder="Mention any specific customer requirements..."></textarea>

</div>

</div>
<button class="full-width-btn" type="submit" name="submit">SAVE CUSTOMER & LEAD</button>
</form>
		<?php } ?>
</div>

	<script type="text/javascript">
		function validateForm() {		
	var lead_source = document.forms["myForm"]["lead_source"].value;     
	var lead_remark = document.forms["myForm"]["lead_remark"].value;

    if (lead_source == null || lead_source == "" ) {
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
if(isset($_POST['submit']))
{
date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i:s");
$lead_owner = trim(addslashes($_POST['lead_owner']));
$customer_id = trim(addslashes($_POST['cust_id']));
$required_qty=trim(addslashes($_POST['required_qty']));
$budget= trim(addslashes($_POST['budget']));
$lead_source=trim(addslashes($_POST['lead_source']));
$lead_description=trim(addslashes($_POST['lead_description']));
$lead_remark=trim(addslashes($_POST['lead_remark']));
$lead_remark = "<p><b>".$lead_owner."</b><br>".$lead_remark."<span>".$fulldate."</span></p>";
$lead_status=trim(addslashes($_POST['lead_status']));
$followup=$_POST['followup'];
$followupon=$_POST['followupon'];
$interested_in=trim(addslashes($_POST['interested_in']));
$order_value=trim(addslashes($_POST['order_value']));
$url = "customerinfo.php?url=&custid=".$customer_id;

$results1 = $db->query("INSERT INTO `leads` (`customer_id`, `enq_id`, `lead_owner`, `required_qty`, `budget`, `lead_source`, `lead_description`, `full_date`, `lead_remark`, `last_action_date`, `lead_status`, `followup`, `followupon`, `interested_in`, `order_value`) VALUES (
	'$customer_id', '1', '$lead_owner', '$required_qty', '$budget', '$lead_source', '$lead_description', '$fulldate', '$lead_remark', '$fulldate', '$lead_status',	'$followup', '$followupon', '$interested_in',  '$order_value');");
	
	if($results1){      
		$results2 = $db->query("UPDATE `customers` SET `no_of_leads` = `no_of_leads`+1 WHERE `customer_id` = '$customer_id'");
	    if($results2){
              echo "<script type='text/javascript'>alert('New Lead Added');</script>";
              echo "<script>window.open('$url','_self')</script>";
            }
    }
    else {
          echo "<script type='text/javascript'>alert('Error Adding This Lead');</script>";
    }
}
?>