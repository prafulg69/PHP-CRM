<?php
 include('session.php');
 $action = $_GET['action'];
 $lead_id = $_GET['leadid'];
 $cust_id = $_GET['custid'];
 include 'db_config.php';
 if($action == "convert"){
	 $url = "orderform.php?custid=".$cust_id."&leadid=".$lead_id;
	 header("location: $url");
 }
 elseif($action == "send_quote"){
	 $geturl = rawurlencode($_GET['url']);
	 $url = "createquotation.php?leadid=".$lead_id."&cust_id=".$cust_id."&url=".$geturl;
	 header("location: $url");
 }
 /*elseif($action == "priority"){
	 	$url2 = $_GET['url'];
		$results= $db->query("SELECT priority_level FROM `leads` where 	lead_id= '$lead_id'");
		while($row = $results->fetch_assoc())
		{
	   $priority= $row["priority_level"];
	 echo '<html><head><title>Add this Lead to Prority</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet"></head>';
include 'header.php';
echo '<body><div class="container">
<div class="col-form-4" style="float: none; margin: auto;"><h1 class="title-text">Add to My Priority Leads</h1>		
<form name="myForm" onsubmit="return validateForm()" class="enquiry-form lead-form" action="addingpriority.php" method="POST">
  <input type="text" value="'.$lead_id.'" name="lead_id" hidden="true">
  <input type="text" value="'.$url2.'" name="url" hidden="true">
  <label class="required-label">Select Priority Level*</label>
  <select name="priority_level">
  <option value="2" '.(($priority=='2')?'selected="selected"':"").'>High</option>
  <option value="1" '.(($priority=='1')?'selected="selected"':"").'>Medium</option>
  <option value="0" '.(($priority=='0')?'selected="selected"':"").'>No Priority (Default)</option>
  </select>
  <input class="red-button" type="submit" name="submit" value="Save">
  </div></div></body></html>';
 }
 }*/
 elseif ($action == "edit"){
$geturl = $_GET['url'];	 
?>
<html>
<head>
<title>Update This Lead</title>
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
		$results= $db->query("SELECT  customers.*, leads.* FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id where leads.lead_id = '$lead_id'");
		while($row = $results->fetch_assoc())
		{			
	      $followupon = new DateTime($row["followupon"]);
  ?>
<form name="myForm" class="lead-form" onsubmit="return validateForm()" action="editlead.php" method="POST">
<input type="text" value="<?php echo $lead_id; ?>" name="lead_id" hidden="true">
<input type="text" value="<?php echo $cust_id; ?>" name="cust_id" hidden="true">
<input type="text" value="<?php echo $login_session; ?>" name="loginid" hidden="true">
<input type="text" value="<?php echo $geturl; ?>" name="geturl" hidden="true">
<h1 class="title-text">Update this Lead</h1>
<div>
<div class="col-form-12" style="opacity: 0.6;">
<h3 class="subtitle-text">Customer Info&ensp;<a href="customerinfo.php?url=&custid=<?php echo $cust_id; ?>" target="_blank"><span>(Edit)</span></a></h3>
<label>Customer Owner</label>
<input type="text" value="<?php echo trim($row["customer_owner"])?>" name="lead_owner" readonly>
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

<div class="col-form-12">
<h3 class="subtitle-text">Lead Info</h3>
<label class="required-label">Lead Source*</label>
<?php $options = trim($row['lead_source']); ?>
<select name="lead_source">
<option value="Cold Call" <?php if($options=="Cold Call") echo 'selected="selected"'; ?>>Cold Call</option>
<option value="Email Marketing" <?php if($options=="Email Marketing") echo 'selected="selected"'; ?>>Email Marketing</option>
<option value="Exhibition" <?php if($options=="Exhibition") echo 'selected="selected"'; ?>>Exhibition</option>
<option value="Existing Client" <?php if($options=="Existing Client") echo 'selected="selected"'; ?>>Existing Client</option>
<option value="Google Ads" <?php if($options=="Google Ads") echo 'selected="selected"'; ?>>Google Ads</option>
<option value="Incoming Call" <?php if($options=="Incoming Call") echo 'selected="selected"'; ?>>Incoming Call</option>
<option value="Live Chat" <?php if($options=="Live Chat") echo 'selected="selected"'; ?>>Live Chat</option>
<option value="Reference" <?php if($options=="Reference") echo 'selected="selected"'; ?>>Reference</option>
<option value="Social Media" <?php if($options=="Social Media") echo 'selected="selected"'; ?>>Social Media</option>
<option value="Website" <?php if($options=="Website") echo 'selected="selected"'; ?>>Website</option>
<option value="Other" <?php if($options=="Other") echo 'selected="selected"'; ?>>Other</option>
</select>

<label class="required-label">Lead Status*</label>
<?php $options = trim($row['lead_status']); ?>
<select name="lead_status" >
<option value="contacted" title="You have contacted and spoken with the customer" <?php if($options=="contacted") echo 'selected="selected"'; ?>>Contacted</option>
<option value="contact_in_future" title="Contact this customer in future or customer would like to be contacted at some specific time" <?php if($options=="contact_in_future") echo 'selected="selected"'; ?>>Contact in Future</option>
<option value="no_answer" title="Customer did not answered your call" <?php if($options=="no_answer") echo 'selected="selected"'; ?>>Not Answered</option>
<option value="lost" title="Customer purchased the items from other vendor or supplier" <?php if($options=="lost") echo 'selected="selected"'; ?>>Lost Lead</option>
<option value="dead_lead" title="Customer dropped the idea of purchasing this items and don't want to buy them" <?php if($options=="dead_lead") echo 'selected="selected"'; ?>>Dead Lead</option>
</select>

<?php $options = $row['followup']; ?>
<label style="width: 100%;">
<input type="checkbox" onclick="hideShow(this)" name="followup" value="true" <?php if($options == "true"){ echo "checked"; } ?>>Set Next Follow up</label>
<input type="datetime-local" name="followupon" value="<?php echo $followupon->format('Y-m-d\TH:i') ?>" id="followup_input"  <?php if($options != "true"){ ?>style="display:none;" <?php } ?>>

<div class="col-form-13">
<label>Budget</label>
<input type="text" value="<?php echo trim($row["budget"])?>" name="budget">
</div>
<div class="col-form-13 fl-right">
<label>Quantity</label>
<?php $options = trim($row['required_qty']); ?>
<select name="required_qty">
<option value="Less than 50" <?php if($options=="Less than 50") echo 'selected="selected"'; ?>>Less than 50</option>
<option value="50-99" <?php if($options=="50-99") echo 'selected="selected"'; ?>>50-99</option>
<option value="100-199" <?php if($options=="100-199") echo 'selected="selected"'; ?>>100-199</option>
<option value="200-499" <?php if($options=="200-499") echo 'selected="selected"'; ?>>200-499</option>
<option value="500-999" <?php if($options=="500-999") echo 'selected="selected"'; ?>>500-999</option>
<option value="1000-1499" <?php if($options=="1000-1499") echo 'selected="selected"'; ?>>1000-1499</option>
<option value="1500 and above" <?php if($options=="1500 and above") echo 'selected="selected"'; ?>>1500 and above</option>
</select>
</div>
<!--<div class="four-col">
<label>Budget</label>
<input type="text" value="" name="budget">
</div>-->
<label>Expected Revenue</label>
<?php $options = trim($row['order_value']); ?>
<select name="order_value">
<option value="Less than 25K" <?php if($options=="Less than 25K") echo 'selected="selected"'; ?>>Less than 25K</option>
<option value="25K - 50K" <?php if($options=="25K - 50K") echo 'selected="selected"'; ?>>25K - 50K</option>
<option value="50K - 1L" <?php if($options=="50K - 1L") echo 'selected="selected"'; ?>>50K - 1L</option>
<option value="1L - 2L" <?php if($options=="1L - 2L") echo 'selected="selected"'; ?>>1L - 2L</option>
<option value="2L - 5L" <?php if($options=="2L - 5L") echo 'selected="selected"'; ?>>2L - 5L</option>
<option value="5L - 10L" <?php if($options=="5L - 10L") echo 'selected="selected"'; ?>>5L - 10L</option>
<option value="More than 10L" <?php if($options=="More than 10L") echo 'selected="selected"'; ?>>More than 10L</option>
</select>
<label>Interested in</label>
<input list="browsers" type="text" value="<?php echo $row["interested_in"] ?>" name="interested_in">
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
<textarea name="lead_description" rows="4" placeholder="Mention any specific customer requirements..."><?php echo trim($row["lead_description"])?></textarea>
<?php if($access_level == "sales_head")	{ ?>
<label>Bottom Price</label>
<input type="text" value="<?php echo trim($row["bottom_price"])?>" name="bottom_price">
<?php } ?>
</div>
<div class="col-form-4">
<h3 class="subtitle-text">Actions Taken</h3>
<div class="order-log">
<?php echo $row["lead_remark"]; ?>
</div>
<label class="trackid-label required-label">Last Action Taken*</label>
<textarea name="lead_remark" rows="3"></textarea>
</div>
<div class="three-btn-col">
<button class="red-button-2" type="submit" name="submit">SAVE AND UPDATE</button>
<a href="createquotation.php?id=<?php echo $_GET['leadid']; ?>&cust_id=<?php echo $_GET['custid']; ?>url=<?php echo rawurlencode($_GET['url']); ?>" class="red-button-2">SEND QUOTATION</a>
<a href="orderform.php?custid=<?php echo $_GET['custid']; ?>&id=<?php echo $_GET['leadid']; ?>" class="red-button-2">CONVERT LEAD</a>
</div>
</div>
</form>
<?php	
	}
	?>
	</div>
	<script type="text/javascript">
		function validateForm() {		
	var lead_remark = document.forms["myForm"]["lead_remark"].value;

	if (lead_remark == null || lead_remark == "" ) {
        alert("Error: Last Action Taken is missing");
        return false;
    }
    
}

function newOwnerMessage()
{
        alert('Selecting a new customer owner will transfer this customer to the selected sales person.');
}
</script>	
</body>
</html>
<?php
 }  
 if(isset($_POST['submit'])){
	 
	 date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i:s");
$cust_id=trim(addslashes($_POST['cust_id']));
$lead_id=trim(addslashes($_POST['lead_id']));
$required_qty=trim(addslashes($_POST['required_qty']));
$budget= trim(addslashes($_POST['budget']));
$lead_source=trim(addslashes($_POST['lead_source']));
$lead_description=trim(addslashes($_POST['lead_description']));
$results1 = $db->query("SELECT lead_remark FROM leads WHERE lead_id = '$lead_id'");
while($row1 = $results1->fetch_assoc()){
	$remark_log = $row1["lead_remark"];
}
$loginid= trim(addslashes($_POST['loginid']));
$lead_remark=trim(addslashes($_POST['lead_remark']));
$lead_remark = "<p><b>".$loginid."</b><br>".$lead_remark."<span>".$fulldate."</span></p>".$remark_log;
$lead_status=trim(addslashes($_POST['lead_status']));
$followup=trim(addslashes($_POST['followup']));
$followupon=trim(addslashes($_POST['followupon']));
$interested_in=trim(addslashes($_POST['interested_in']));
$order_value=trim(addslashes($_POST['order_value']));
$bottom_price=trim(addslashes($_POST['bottom_price']));
$geturl= trim(addslashes($_POST['geturl']));
$url = "leadstable.php?person=".$loginid;

	$results = $db->query("UPDATE `leads` SET  `required_qty` = '$required_qty', `budget` = '$budget', `lead_source` = '$lead_source', `lead_status` = '$lead_status', `lead_description` = '$lead_description', `lead_remark` = '$lead_remark', `last_action_date` = '$fulldate', `followup` = '$followup', `followupon` = '$followupon', `interested_in` = '$interested_in', `order_value` = '$order_value', `bottom_price` = '$bottom_price' WHERE lead_id = '$lead_id';");
	if($results)
{      

 echo "<script type='text/javascript'>alert('Lead Updated');</script>";
 echo "<script>window.open('$geturl','_self')</script>";
			}
else
{
echo "<script type='text/javascript'>alert('Error Updating Lead');</script>";
}}
?>