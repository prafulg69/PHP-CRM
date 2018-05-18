<?php
  include('session.php');
?>
<html>
<head>
<title>CustomShape.in Order Form</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
</head>
<script>
/*function showHint(str) {  
var xhttp;  
if (str.length == 0) {    
 document.getElementById("txtHint").innerHTML = "";    
 return;  
 }	
 document.getElementById("loading-text").style.display='inline-block';    
 document.getElementById("loading-text").innerHTML = "Fetching Last Order Details...";	       
 xhttp = new XMLHttpRequest();     
 xhttp.onreadystatechange = function() {    
 if (this.readyState == 4 && this.status == 200) {		
 var response = this.responseText;	
if(response.length == 0){ 
 document.getElementById("full_name").value = "";	  
 document.getElementById("mobile").value = "";	 
 document.getElementById("telephone").value = "";	  
 document.getElementById("email1").value = "";
 document.getElementById("email2").value = "";	 
 document.getElementById("ship_address").value = "";	 
 document.getElementById("ship_city").value = "";	 
 document.getElementById("ship_zip").value = "";	 
 document.getElementById("bill_address").value = "";	 	  
 document.getElementById("gst_no").value = "";	 
 document.getElementById("order_description").value = "";	 
 document.getElementById("branding_type").value = "";	 
 document.getElementById("packaging").value = "";	 
 document.getElementById("payment_term").value = "";	 
 document.getElementById("logo_name").value = "";
}
else{
var [a, b, c, d, e, f, g, h, i, j, k, l, m, n, o] = response.split('^');	 
 //document.getElementById("txtHint").innerHTML = this.responseText;      
 document.getElementById("full_name").value = a;	  
 document.getElementById("mobile").value = b;	 
 document.getElementById("telephone").value = c;	  
 document.getElementById("email1").value = d;
 document.getElementById("email2").value = e;	 
 document.getElementById("ship_address").value = f;	 
 document.getElementById("ship_city").value = g;	 
 document.getElementById("ship_zip").value = h;	 
 document.getElementById("bill_address").value = i;	    
 document.getElementById("gst_no").value = j;	 
 document.getElementById("order_description").value = k;	 
 document.getElementById("branding_type").value = l;	 
 document.getElementById("packaging").value = m;	 
 document.getElementById("payment_term").value = n;	 
 document.getElementById("logo_name").value = o;
}
 document.getElementById("loading-text").style.display='none';    
 }  }; 
 xhttp.open("GET", "ajaxordercopying.php?q="+str, true);  
 xhttp.send(); 
 }  */
 </script>
<body>
<?php include('header.php'); ?>
<div class="container"><p id="loading-text"></p>

<?php
        include 'db_config.php';
		
        $cust_id= $_GET['custid'];
        $lead_id= $_GET['leadid'];			
		$results= $db->query("SELECT * FROM `customers` where customer_id='$cust_id'");
		while($row = $results->fetch_assoc())
		{
  ?>
  
<form name="myForm" class="lead-form" onsubmit="return validate(this);" action="orderform.php" method="POST" enctype="multipart/form-data">
<input type="text" value="<?php echo $lead_id; ?>" name="lead_id" hidden="true">
<input type="text" value="<?php echo $cust_id; ?>" name="cust_id" hidden="true">
<h1 class="title-text">New Order Form&ensp;&ensp;<a href="orderformmultiproducts.php?leadid=<?php echo $lead_id; ?>&custid=<?php echo $cust_id; ?>" style="font-size: 18px;font-weight: 500;text-decoration:  underline;">(Multiple Products Order Form)</a></h1>
<div class="cover">
<div class="col-form-2" style="opacity: 0.6;">
<h3 class="subtitle-text">Customer Info&ensp;<a href="customerinfo.php?url=&custid=<?php echo $cust_id; ?>" target="_blank"><span>(Edit)</span></a></h3>
<label>Customer Owner</label>
<input type="text" value="<?php echo trim($row["customer_owner"])?>" name="lead_owner" class="required" readonly>
<label>Full Name</label>
<input type="text" value="<?php echo trim($row["customer_name"])?>" name="full_name" class="required" readonly>
<label>Company Name</label>
<input type="text" value="<?php echo trim($row["customer_companyname"])?>" name="company_name" class="required" readonly>
<label>Contact No.</label>
<input type="text" value="<?php echo trim($row["customer_contactno1"])?>" name="mobile" class="required" readonly>
<label>Customer Email</label>
<input type="email" value="<?php echo trim($row["customer_email1"])?>" name="email1" class="required" readonly>

<label>Customer Type</label>
<input type="text" value="<?php echo trim($row["customer_type"])?>" name="customer_type" class="required" readonly>
<div class="col-form-13">
<label>Secondary Email</label>
<input type="email" value="<?php echo trim($row["customer_email2"])?>" name="email2"  readonly>
</div>
<div class="col-form-13 fl-right">
<label>Alternate Contact No.</label>
<input type="text" value="<?php echo trim($row["customer_contactno2"])?>" name="telephone"  readonly>
</div>
<label>GST No.</label>
<input type="text" value="<?php echo trim($row["customer_gstno"])?>" name="gst_no" class="required" readonly>
<label>Shipping Address</label>
<textarea name="ship_address" rows="4" id="ship_address" class="required" readonly><?php echo trim($row["customer_shipaddress"])?></textarea>
<div>
<div class="two-col-left">
<label>Shipping City</label>
<input type="text" value="<?php echo trim($row["customer_shipcity"])?>" name="ship_city" id="ship_city" class="required" readonly>
</div>
<div class="two-col-right">
<label>Zip Code</label>
<input type="text" value="<?php echo trim($row["customer_shipzip"])?>" name="ship_zip" id="ship_zip" class="required" readonly>
</div>
</div>
<label>Billing Address</label>
<textarea name="bill_address" rows="4" id="bill_address" class="required" readonly><?php echo trim($row["customer_billaddress"])?></textarea>
</div>

<div class="col-form-2">
<h3 class="subtitle-text">Order Details</h3>
<div class="col-form-13">
<label class="required-label">Product Name*</label>
<input type="text" value="" name="product_name" class="required">
</div>
<div class="col-form-13 fl-right">
<label class="required-label">Specification / Capacity*</label>
<input list="capacities" type="text" value="" name="product_capacity" class="required">
<datalist id="capacities">
 <option value="4GB">
 <option value="8GB">
 <option value="16GB">
 <option value="32GB">
 <option value="64GB">
 <option value="2500mAh">
 <option value="3000mAh">
 <option value="4000mAh">
 <option value="5000mAh">
 <option value="10000mAh">
</datalist>
</div>

<div>
<div class="four-col">
<label class="required-label">Unit Price *</label>
<input type="text" value="" name="price" class="required" id="price" onkeyup="revertAmount()">
</div>
<div class="four-col">
<label class="required-label">Quantity *</label>
<input type="text" value="" name="quantity" class="required" id="quantity" onkeyup="revertAmount()">
</div>
<div class="four-col">
<label class="required-label">GST *</label>
<select name="gst_percent" id="gst_percent" onchange="return calculateAmount(this.value)">
<option value="0">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</div>
<div class="four-col">
<label class="required-label">Amount*</label>
<input type="text" value="" name="totalamount" id="totalamount" class="required" readonly>
</div>
</div>
<label>Product Code</label>
<input type="text" value="" name="product_code"  >
<label>Order Description</label>
<textarea name="order_description" rows="4" id="order_description"></textarea>
<label>Shipping Method</label>
<div>
<input type="radio" name="shipping_method" value="self_pickup" onclick="hideShow(this.value);" required> Self Pick-up&ensp;&ensp;&ensp;
<input type="radio" name="shipping_method" value="self_drop" onclick="hideShow(this.value);" required> Self Drop&ensp;&ensp;&ensp;
<input type="radio" name="shipping_method" value="courier_ship" onclick="hideShow(this.value);" required> Courier&ensp;&ensp;&ensp;
<input type="radio" name="shipping_method" value="courier_thirdparty" onclick="hideShow(this.value);" required> Third Party
<textarea name="thirdparty_address" rows="4" id="thirdparty_address" placeholder= "Third Party Shipping Address" style="display: none;"></textarea>
</div>
<label class="required-label">Branding Type*</label>
<select name="branding_type" id="branding_type">
<option value="No Branding">No Branding</option>
<option value="Screen Printing">Screen Printing</option>
<option value="Digital Printing">Digital Printing</option>
<option value="Engraving">Engraving</option>
<option value="Embossing">Embossing</option>
<option value="Pad Printing">Pad Printing</option>
<option value="Other">Other</option>
</select>
<label class="required-label">Packaging*</label>
<select name="packaging" id="packaging">
<option value="Black Box">Black Box</option>
<option value="Black Box with Printing">Black Box with Printing</option>
<option value="Box Packing">Box Packing</option>
<option value="Poly Bag">Poly Bag</option>
<option value="Paper Box">Paper Box</option>
<option value="Plastic Box">Plastic Box</option>
<option value="Plastic Box with Printing">Plastic Box with Printing</option>
<option value="Metal Box">Metal Box</option>
<option value="Metal Box with Printing">Metal Box with Printing</option>
<option value="No Packaging">No Packaging</option>
<option value="Other">Other</option>
</select>
<label class="required-label">Payment Term*</label>
<select name="payment_term" id="payment_term">
<option value="50% Advance and balance on the delivery">50% Advance and balance on the delivery</option>
<option value="100% on the delivery">100% on the delivery</option>
<option value="100% Advance">100% Advance</option>
<option value="15 Days after delivery">15 Days after delivery</option>
<option value="30 Days after delivery">30 Days after delivery</option>
<option value="Other">Other</option>
</select>
<div>
<div class="two-col-left">
<label>Logo Name</label>
<input type="text" value="" name="logo_name" id="logo_name">
</div>
<div class="two-col-right">
<label class="required-label">Delivery Date*</label>
<input type="date" name="deliverydate" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?>" >
</div>
</div>
<label>Upload Logo or Artworks Files</label>
<div>
<div class="col-form-5">
<input type="file" name="image"> 
</div>
<div class="col-form-6">
<input class="android-input" type="text" name="art_comment1" value="" placeholder="Comment" maxlength="20">
</div>
</div>
<div>
<div class="col-form-5">
<input type="file" name="image2"> 
</div>
<div class="col-form-6">
<input class="android-input" type="text" name="art_comment2" value="" placeholder="Comment" maxlength="20">
</div>
</div>
<div>
<div class="col-form-5">
<input type="file" name="image3"> 
</div>
<div class="col-form-6">
<input class="android-input" type="text" name="art_comment3" value="" placeholder="Comment" maxlength="20">
</div>
</div>
</div>
</div>
<button class="full-width-btn" type="submit" name="submit">SUBMIT ORDER</button>
</form>
<?php	
	}
	
	?>
	</div>
	<script>
function hideShow(method){
if(method == "courier_thirdparty"){	
document.getElementById("thirdparty_address").style.display='block';		
}	
else{		
document.getElementById("thirdparty_address").style.display='none';
document.getElementById("thirdparty_address").value = "";	
}}
</script>

<script type="text/javascript">
  var validate = (function() {
  var reClass = /(^|\s)required(\s|$)/;  // Field is required
  var reValue = /^\s*$/;   // Match all whitespace
  

  return function (form) {
    var elements = form.elements;
    var el;
	var price = document.forms["myForm"]["price"].value;
    var quantity = document.forms["myForm"]["quantity"].value;
	var today =new Date();
    var inputDate = new Date(document.forms["myForm"]["deliverydate"].value);  
  

    for (var i=0, iLen=elements.length; i<iLen; i++) {
      el = elements[i];

      if (reClass.test(el.className) && reValue.test(el.value)) {
        // Required field has no value or only whitespace
        // Advise user to fix
        alert('Please fix ' + el.name);
        return false;
      }
	  
    }
	if (price == null || price == "" || isNaN(price)) {
        alert("Price must be only numbers");
        return false;
    } 
	else if (quantity == null || quantity == "" || isNaN(quantity)) {
        alert("Quantity must be only numbers");
        return false;
    }
	else if (inputDate.setHours(0,0,0,0) < today.setHours(0,0,0,0)) {
        alert("Delivery date cannot be today's or passed date");
        return false;
    }
	else{
	if (confirm("Confirm Order Submission ?")) return true;
    else return false;       
	}
  }
}());
</script>


<script type="text/javascript">
function calculateAmount(str) {
var price = document.forms["myForm"]["price"].value;
var quantity = document.forms["myForm"]["quantity"].value;

var a= parseFloat(price)*parseFloat(quantity);
var b= parseFloat(a)+(parseFloat(a)*parseFloat(str)/100);
document.getElementById("totalamount").value = b; 
}
</script>

<script type="text/javascript">
function revertAmount(){
	document.getElementById("totalamount").value = "";
}
</script>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
	echo '<p>Submitting Your Order...</p><br>';
	$cust_id= trim(addslashes($_POST['cust_id']));
	$lead_id= trim(addslashes($_POST['lead_id']));
	$customer_type=trim(addslashes($_POST['customer_type']));
$lead_owner=trim(addslashes($_POST['lead_owner']));
$company_name=trim(addslashes($_POST['company_name']));
$full_name=trim(addslashes($_POST['full_name']));
$mobile=trim(addslashes($_POST['mobile']));
$telephone=trim(addslashes($_POST['telephone']));
$email1=trim(addslashes($_POST['email1']));
$email2=trim(addslashes($_POST['email2']));
$ship_address=trim(addslashes($_POST['ship_address']));
$ship_city=trim(addslashes($_POST['ship_city']));
$ship_zip=trim(addslashes($_POST['ship_zip']));
$bill_address=trim(addslashes($_POST['bill_address']));
$gst_no=trim(addslashes($_POST['gst_no']));
$product_name=trim(addslashes($_POST['product_name']));
$product_capacity=trim(addslashes($_POST['product_capacity']));
$product_code=trim(addslashes($_POST['product_code']));
$price=trim(addslashes($_POST['price']));
$quantity=trim(addslashes($_POST['quantity']));
$amount=trim(addslashes($_POST['totalamount']));
$gst_percent=trim(addslashes($_POST['gst_percent']));
$order_description=trim(addslashes($_POST['order_description']));
$branding_type=trim(addslashes($_POST['branding_type']));
$packaging=trim(addslashes($_POST['packaging']));
$payment_term=trim(addslashes($_POST['payment_term']));
$deliverydate=trim(addslashes($_POST['deliverydate']));
$logo_name=trim(addslashes($_POST['logo_name']));
$shipping_method=trim(addslashes($_POST['shipping_method']));
$thirdparty_address=trim(addslashes($_POST['thirdparty_address']));
date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i");

$art_comment1= trim(addslashes($_POST['art_comment1']));
$art_comment2= trim(addslashes($_POST['art_comment2']));
$art_comment3= trim(addslashes($_POST['art_comment3']));

$target = "artworks/";
$targeta = $target . basename( $_FILES['image']['name']);
$targetb = $target . basename( $_FILES['image2']['name']);
$targetc = $target . basename( $_FILES['image3']['name']);
$pic=($_FILES['image']['name']);
$pic2=($_FILES['image2']['name']);
$pic3=($_FILES['image3']['name']);

if(trim($pic) != ""){
 echo '<p>Checking file name 1...</p><br>';
  if(file_exists($targeta)) {	
    $lastdot = strrpos($_FILES['image']['name'], '.');
    $basefilename = substr($_FILES['image']['name'], 0, $lastdot);
    $extension = substr($_FILES['image']['name'], $lastdot);
    $pic = $basefilename . '_0' . $extension;
    $targeta = $target . $pic;
    echo '<p>File name already exist. Renaming to:' . $pic.'</p><br>';		
}
if(move_uploaded_file($_FILES['image']['tmp_name'], $targeta))
{
       echo '<p>Uploading Artwork 1...</p><br>';
}
}

if(trim($pic2) != ""){
echo '<p>Checking file name 2...</p><br>';
  if(file_exists($targetb)) {	
    $lastdot2 = strrpos($_FILES['image2']['name'], '.');
    $basefilename2 = substr($_FILES['image2']['name'], 0, $lastdot2);
    $extension2 = substr($_FILES['image2']['name'], $lastdot2);
    $pic2 = $basefilename2 . '_0' . $extension2;
    $targetb = $target . $pic2;
     echo '<p>File name already exist. Renaming to:' . $pic2.'</p><br>';			
}
if(move_uploaded_file($_FILES['image2']['tmp_name'], $targetb))
{
	 echo '<p>Uploading Artwork 2...</p><br>';
}
}

if(trim($pic3) != ""){
echo '<p>Checking file name 3...</p><br>';
  if(file_exists($targetc)) {	
    $lastdot3 = strrpos($_FILES['image3']['name'], '.');
    $basefilename3 = substr($_FILES['image3']['name'], 0, $lastdot3);
    $extension3 = substr($_FILES['image3']['name'], $lastdot3);
    $pic3 = $basefilename3 . '_0' . $extension3;
    $targetc = $target . $pic3;
    echo '<p>File name already exist. Renaming to:' . $pic3.'</p><br>';			
}
if(move_uploaded_file($_FILES['image3']['tmp_name'], $targetc))
{
       echo '<p>Uploading Artwork 3...</p><br>';
}
}
	
	$results = $db->query("INSERT INTO `orders` (`customer_id`, `Lead_ID`, `Sales_Rep_Email`, `Product_Name1`, `Product_Capacity1`, `Product_Code1`,`Price_per_pc1`, `Quantity1`, `Total_Amount1`, `Grand_Total`, `GST_Percentage1`,  `Order_Description`, `Branding_Type`, `Packaging`, `Payment_Term`, `Delivery_Date`, `Logo_Name`, `Order_Date`, `Artwork1`, `Artwork_Comment1`, `Artwork2`, `Artwork_Comment2`, `Artwork3`, `Artwork_Comment3`, `Shipping_Method`, `ThirdParty_Address`) VALUES (
	'$cust_id',
	'$lead_id',
	'$lead_owner',
	'$product_name',
	'$product_capacity',
	'$product_code',
	'$price',
	'$quantity',
	'$amount',
	'$amount',
	'$gst_percent',
	'$order_description',
	'$branding_type',
	'$packaging',
	'$payment_term',
	'$deliverydate',
	'$logo_name',
	'$fulldate',
	'$pic',
	'$art_comment1',
	'$pic2',
	'$art_comment2',
	'$pic3',
	'$art_comment3',
	'$shipping_method',
	'$thirdparty_address');");
	$last_id = $db->insert_id;
	
    //echo "Last inserted ID is: " . $last_id;
     
	
	if($results)
{ 

	if($lead_id != "1"){
echo '<p>Converting Lead...</p><br>';     
$results3 = $db->query("UPDATE `leads` SET `lead_status` = 'converted' WHERE `leads`.`lead_id` = '$lead_id'");
if($results3){
echo '<p>Lead Converted...</p><br>';
} 
}

echo '<p>Sending Order Mails...</p><br>';

/*$headers = "From: IOT Order <sales1@promousb.in>\r\n";
//$headers .= "CC: accounts@iotenterprise.in, order@iotenterprise.in, ishwar@iotenterprise.in, shujaat@startup-buzz.com  \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$to = $lead_owner;
$subject = 'Order'.$last_id.' of '.$company_name.' is Submitted';
$message = '<div style="width:800px;margin:10px auto;padding:15px 10px;border: 1px solid #ccc;border-radius: 3px;background: #f8f8f8;">
<table width="100%">
<tbody>
<tr>
<td align="left" >
<img src="https://promousb.in/skin/frontend/smartwave/porto/images/promo-usb-logo-small.png" alt="PromoUSB Logo">
<p><b>Sales Executive Email:</b><br>'.$lead_owner.'
</td>
<td align="right" style="line-height: 1.5;" width="250px">
<h2>Order Confirmation</h2>
<p><b>Order Date: </b>'.$fulldate.'<br>
<b>Delivery Date: </b>'.$deliverydate.'<br>
<b>Order ID: </b>'.$last_id.'</p>
</td>
</tr>
</tbody>
</table><br><br>
<table width="100%">
<tbody>
<tr>
<td>
<p style="font-size: large; line-height: 1.5;">Your order has been placed, below is your order details.</p>
</td>
</tr>
</tbody>
</table>
<table cellpadding = "5" rules= "all" width= "100%" style="border: 1px solid #999;">
<tbody>
<tr bgcolor = "#a1d8ff">
<th>Product Name</th>
<th>Code</th>
<th>Unit Price</th>
<th>Quantity</th>
<th>GST%</th>
<th>Amount</th>
</tr>
<tr>
<td>'.$product_name.'</td>
<td>'.$product_code.'</td>
<td>Rs. '.$price.'</td>
<td>'.$quantity.'</td>
<td>'.$gst_percent.'%</td>
<td>Rs. '.$amount.'</td>
</tr>
</tbody>
</table><br><br>
<table width="100%" rules="cols" cellpadding = "10" style="border: 1px solid #999;">
<tbody>
<tr>
<td><b>Company: </b>'.$company_name.'</td>
<td><b>Customer Name: </b>'.$full_name.'</td>
</tr>
<tr>
<td><b>Mobile: </b>'.$mobile.'</td>
<td><b>Telephone: </b>'.$telephone.'</td>
</tr>
<tr>
<td><b>Email 1: </b>'.$email1.'</td>
<td><b>Email 2: </b>'.$email2.'</td>
</tr>
<tr>
<td><b>GST No: </b>'.$gst_no.'</td>
<td><b>Order Description: </b>'.$order_description.'</td>
</tr>
<tr>
<td><b>Branding Type: </b>'.$branding_type.'</td>
<td><b>Packaging Type: </b>'.$packaging.'</td>
</tr>
<tr>
<td><b>Logo Name: </b> '.$logo_name.'</td>
<td><b>Order Date: </b>'.$fulldate.'</td>
</tr>
<tr>
<td><b>Shipping Address: </b> '.$ship_address.'</td>
<td><b>Billing Address: </b>'.$bill_address.'</td>
</tr>
<tr>
<td><b>Shipping City: </b> '.$ship_city.'</td>
<td><b>Delivery Date: </b> '.$deliverydate.'</td>
</tr>
<tr>
<td><b>Shipping Pin Code: </b> '.$ship_zip.'</td>
<td style="background: #a1d8ff;"><b>Order ID: </b>'.$last_id.'</td>
</tr>
</tbody>
</table><br>	
<table width="100%"  cellpadding="10" >
<tbody>
<tr>'; 
if(trim($pic) != ""){
	$link1= "https://crm3692.promousb.in/artworks/".str_replace(" ",'%20',$pic);
	$message .= '<td>Artwork 1:<br><a href='.$link1.'><button>Download ('.$art_comment1.')</button></a></td>';
}
if(trim($pic2) != ""){
	$link2= "https://crm3692.promousb.in/artworks/".str_replace(" ",'%20',$pic2);
	$message .= '<td>Artwork 2:<br><a href='.$link2.'><button>Download ('.$art_comment2.')</button></a></td>';
}
if(trim($pic3) != ""){
	$link3= "https://crm3692.promousb.in/artworks/".str_replace(" ",'%20',$pic3);
	$message .= '<td>Artwork 1:<br><a href='.$link3.'><button>Download ('.$art_comment3.')</button></a></td>';
}
$message .= '</tr>
</tbody>
</table>
<table width="100%">
<tbody>
<tr>
<td align="center"><p style="margin-top: 30px; color: #999;">929-935, IJMIMA Complex, Mindspace, Behind Infiniti Mall, Malad west, Mumbai 4000 64</p></td>
</tr>
</tbody>
</table>
</div>';

mail($to,$subject,$message,$headers);*/

$headers2 = "From: CustomShape.in <".$lead_owner.">\r\n";
$headers2 .= "Reply-To: ".$lead_owner."\r\n";
$headers2 .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers2 .= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers2 .= "MIME-Version: 1.0\r\n";
$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers2 .= "X-Priority: 3\r\n";
$headers2 .= "X-Mailer: PHP". phpversion() ."\r\n" ;
$to2 = $email1;
$subject2 = 'Your Order of '.$product_name.' is Confirmed';
$message2 = '<div style="width:700px;margin:10px auto;padding:15px 10px;border: 1px solid #ccc;border-radius: 3px;background: #f8f8f8;">
<table width="100%">
<tbody>
<tr>
<td align="left" >
<img src="https://www.customshape.in/skin/frontend/smartwave/porto/images/custom-shape-logo.png" alt="CustomShape.in Logo">
<p><b>Sales Executive Email:</b><br>'.$lead_owner.'
</td>
<td align="right" style="line-height: 1.5;" width="250px">
<h2>Order Confirmation</h2>
<p><b>Order #</b>'.$last_id.'<br>
<b>Order Date: </b>'.$fulldate.'<br>
<b>Company: </b>'.$company_name.'</p>
</td>
</tr>
</tbody>
</table><br><br><br>
<table width="100%">
<tbody>
<tr>
<td>
<p style="font-size: 25px; margin: 0;">Hello '.$full_name.', </p>
<p style="font-size: large; line-height: 1.5;">Thank you for your order. Below is your complete order details. We’ll send you a confirmation once we dispatch your order. Reply to this email for any queries.</p>
</td>
</tr>
</tbody>
</table><br>
<table cellpadding = "5" rules= "all" width= "100%" style="border: 1px solid #999;">
<tbody>
<tr bgcolor = "#a1d8ff">
<th>Product Name</th>
<th>Unit Price</th>
<th>Quantity</th>
<th>GST%</th>
<th>Amount</th>
</tr>
<tr>
<td>'.$product_name.'</td>
<td>Rs. '.$price.'</td>
<td>'.$quantity.'</td>
<td>'.$gst_percent.'%</td>
<td>Rs. '.$amount.'</td>
</tr>
</tbody>
</table><br><br>
<table width="100%" >
<tbody>
<tr>
<td align="left" width="50%">
<p><b>Contacted Person: </b>'.$full_name.'</p>
<p><b>Contact No: </b>'.$mobile.'</p>
</td>
<td align="left" width="50%">
<p><b>Shipping Method: </b>'.$shipping_method.'<br></p>
<p><b>Billing Address: </b>'.$bill_address.'<br></p>
</td>
</tr>
</tbody>
</table>
<table width="100%">
<tbody>
<tr>
<td align="center"><p style="margin-top: 30px; color: #999;">904, 9th floor, DLH Park, Sundar Nagar, SV Road, Near MTNL Office, Malad west, MUMBAI 400064</p></td>
</tr>
</tbody>
</table>
</div>';
mail($to2,$subject2,$message2,$headers2);

$url= "thankyou.php?id=".$last_id;
echo "<script>window.open('$url','_self')</script>";
}
else
{
echo "<script type='text/javascript'>alert('Error Submitting Order');</script>";
}
}	
?>