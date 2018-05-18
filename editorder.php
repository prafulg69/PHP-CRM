<?php
  include('session.php');
?>
<html>
<head>
<title>CustomShape.in Edit Order#<?php echo $_GET['id']; ?> </title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
</head>

<body>
<?php include('header.php'); ?>
<div class="container"><p id="loading-text"></p>
<?php
        include 'db_config.php';
		
        $order_id= $_GET['id'];
        $cust_id= $_GET['custid'];			
		$results= $db->query("SELECT customers.*, orders.*, DATE_FORMAT(orders.Delivery_Date, '%d %m %Y') FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id where orders.Order_ID= '$order_id'");
		while($row = $results->fetch_assoc())
		{
			$delivery_date = new DateTime($row["Delivery_Date"]);
  ?>
<form name="myForm" class="lead-form" onsubmit="return validate(this);" action="editorder.php" method="POST" enctype="multipart/form-data">
<input type="text" value="<?php echo $order_id; ?>" name="order_id" hidden="true">
<input type="text" value="<?php echo $cust_id; ?>" name="cust_id" hidden="true">
<h1 class="title-text">Revise Order #<?php echo $order_id; ?>&ensp;&ensp;<a href="editorderformmultiproducts.php?id=<?php echo $order_id; ?>&custid=<?php echo $cust_id; ?>" style="font-size: 18px;font-weight: 500;text-decoration:  underline;">(Revise in Multiple Products Order Form)</a></h1>
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
<input type="text" value="<?php echo trim($row["Product_Name1"])?>" name="product_name" class="required">
</div>
<div class="col-form-13 fl-right">
<label class="required-label">Specification / Capacity*</label>
<input list="capacities" type="text" value="<?php echo trim($row["Product_Capacity1"])?>" name="product_capacity" class="required">
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
<input type="text" value="<?php echo trim($row["Price_per_pc1"])?>" name="price" class="required" id="price" onkeyup="revertAmount()">
</div>
<div class="four-col">
<label class="required-label">Quantity *</label>
<input type="text" value="<?php echo trim($row["Quantity1"])?>" name="quantity" class="required" id="quantity" onkeyup="revertAmount()">
</div>
<div class="four-col">
<label class="required-label">GST *</label>
<select name="gst_percent" id="gst_percent" onchange="return calculateAmount(this.value)">
<?php $gst_per = trim($row['GST_Percentage1']); ?>
<option value="0" <?php if($gst_per=="0") echo 'selected="selected"'; ?>>NA</option>
<option value="28" <?php if($gst_per=="28") echo 'selected="selected"'; ?>>28%</option>
<option value="18" <?php if($gst_per=="18") echo 'selected="selected"'; ?>>18%</option>
<option value="12" <?php if($gst_per=="12") echo 'selected="selected"'; ?>>12%</option>
<option value="6" <?php if($gst_per=="6") echo 'selected="selected"'; ?>>6%</option>
<option value="3" <?php if($gst_per=="3") echo 'selected="selected"'; ?>>3%</option>
</select>
</div>
<div class="four-col">
<label class="required-label">Amount*</label>
<input type="text" value="<?php echo trim($row["Total_Amount1"])?>" name="totalamount" id="totalamount" class="required" readonly>
</div>
</div>
<label>Product Code</label>
<input type="text" value="<?php echo trim($row["Product_Code1"])?>" name="product_code"  >
<label>Order Description</label>
<textarea name="order_description" rows="5" id="order_description"><?php echo trim($row["Order_Description"])?></textarea>
<label>Shipping Method</label>
<?php $shipping_method = trim($row['Shipping_Method']); ?>
<div>
<input type="radio" name="shipping_method" value="self_pickup" onclick="hideShow(this.value);" <?php if($shipping_method=="self_pickup") echo 'checked="true"'; ?> required> Self Pick-up&ensp;&ensp;&ensp;
<input type="radio" name="shipping_method" value="self_drop" onclick="hideShow(this.value);" <?php if($shipping_method=="self_drop") echo 'checked="true"'; ?> required> Self Drop&ensp;&ensp;&ensp;
<input type="radio" name="shipping_method" value="courier_ship" onclick="hideShow(this.value);" <?php if($shipping_method=="courier_ship") echo 'checked="true"'; ?> required> Courier&ensp;&ensp;&ensp;
<input type="radio" name="shipping_method" value="courier_thirdparty" onclick="hideShow(this.value);" <?php if($shipping_method=="courier_thirdparty") echo 'checked="true"'; ?> required> Third Party
<textarea name="thirdparty_address" rows="4" id="thirdparty_address" placeholder= "Third Party Shipping Address" <?php if($shipping_method !="courier_thirdparty") echo 'style="display: none;"'; ?>><?php echo trim($row["ThirdParty_Address"])?></textarea>
</div>
<label class="required-label">Branding Type*</label>
<?php $brandingtype = $row['Branding_Type']; ?>
<select name="branding_type" id="branding_type">
<option value="No Branding" <?php if($branding_type=="No Branding") echo 'selected="selected"'; ?>>No Branding</option>
<option value="Screen Printing" <?php if($branding_type=="Screen Printing") echo 'selected="selected"'; ?>>Screen Printing</option>
<option value="Digital Printing" <?php if($branding_type=="Digital Printing") echo 'selected="selected"'; ?>>Digital Printing</option>
<option value="Engraving" <?php if($branding_type=="Engraving") echo 'selected="selected"'; ?>>Engraving</option>
<option value="Embossing" <?php if($branding_type=="Embossing") echo 'selected="selected"'; ?>>Embossing</option>
<option value="Pad Printing" <?php if($branding_type=="Pad Printing") echo 'selected="selected"'; ?>>Pad Printing</option>
<option value="Other" <?php if($branding_type=="Other") echo 'selected="selected"'; ?>>Other</option>
</select>
<label class="required-label">Packaging*</label>
<?php $package = $row['Packaging']; ?>
<select name="packaging" id="packaging">
<option value="Black Box" <?php if($packaging=="Black Box") echo 'selected="selected"'; ?>>Black Box</option>
<option value="Black Box with Printing" <?php if($packaging=="Black Box with Printing") echo 'selected="selected"'; ?>>Black Box with Printing</option>
<option value="Box Packing" <?php if($packaging=="Box Packing") echo 'selected="selected"'; ?>>Box Packing</option>
<option value="Poly Bag" <?php if($packaging=="Poly Bag") echo 'selected="selected"'; ?>>Poly Bag</option>
<option value="Paper Box" <?php if($packaging=="Paper Box") echo 'selected="selected"'; ?>>Paper Box</option>
<option value="Plastic Box" <?php if($packaging=="Plastic Box") echo 'selected="selected"'; ?>>Plastic Box</option>
<option value="Plastic Box with Printing" <?php if($packaging=="Plastic Box with Printing") echo 'selected="selected"'; ?>>Plastic Box with Printing</option>
<option value="Metal Box" <?php if($packaging=="Metal Box") echo 'selected="selected"'; ?>>Metal Box</option>
<option value="Metal Box with Printing" <?php if($packaging=="Metal Box with Printing") echo 'selected="selected"'; ?>>Metal Box with Printing</option>
<option value="No Packaging" <?php if($packaging=="No Packaging") echo 'selected="selected"'; ?>>No Packaging</option>
<option value="Other" <?php if($packaging=="Other") echo 'selected="selected"'; ?>>Other</option>
</select>
<label class="required-label">Payment Term*</label>
<select name="payment_term" id="payment_term">
<?php $paymentterm = $row['Payment_Term']; ?>
<option value="50% Advance and balance on the delivery" <?php if($paymentterm=="50% Advance and balance on the delivery") echo 'selected="selected"'; ?>>50% Advance and balance on the delivery</option>
<option value="100% on the delivery" <?php if($paymentterm=="100% on the delivery") echo 'selected="selected"'; ?>>100% on the delivery</option>
<option value="100% Advance" <?php if($paymentterm=="100% Advance") echo 'selected="selected"'; ?>>100% Advance</option>
<option value="15 Days after delivery" <?php if($paymentterm=="15 Days after delivery") echo 'selected="selected"'; ?>>15 Days after delivery</option>
<option value="30 Days after delivery" <?php if($paymentterm=="30 Days after delivery") echo 'selected="selected"'; ?>>30 Days after delivery</option>
<option value="Other" <?php if($paymentterm=="Other") echo 'selected="selected"'; ?>>Other</option>
</select>
<div>
<div class="two-col-left">
<label>Logo Name</label>
<input type="text" value="<?php echo trim($row["Logo_Name"])?>" name="logo_name" id="logo_name">
</div>
<div class="two-col-right">
<label class="required-label">Delivery Date*</label>
<input type="date" name="deliverydate" value="<?php echo $delivery_date->format('Y-m-d') ?>" >
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
<div style="margin-top: 20px;">
<label class="required-label">Order Revision Update*</label>
<textarea name="order_revision_update" rows="3" placeholder="What's the change in the order?" class="required"></textarea>
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
	if (confirm("Confirm Order Revision ?")) return true;
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
	echo '<p>Revising Your Order...</p><br>';
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
$order_revision_update=trim(addslashes($_POST['order_revision_update']));
date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i:s");
$order_id= trim(addslashes($_POST['order_id']));
$cust_id= trim(addslashes($_POST['cust_id']));
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
	
	$results = $db->query("UPDATE `orders` SET  `Sales_Rep_Email` = '$lead_owner', `Product_Name1` = '$product_name', `Product_Capacity1` = '$product_capacity', `Product_Code1` = '$product_code', `Price_per_pc1` = '$price', `Quantity1` = '$quantity', `Total_Amount1` = '$amount', `Grand_Total` = '$amount', `GST_Percentage1` = '$gst_percent',  `Order_Description` = '$order_description', `Branding_Type` = '$branding_type', `Packaging` = '$packaging', `Payment_Term` = '$payment_term', `Delivery_Date` = '$deliverydate', `Logo_Name` = '$logo_name', `Artwork1` = '$pic', `Artwork_Comment1` = '$art_comment1', `Artwork2` = '$pic2', `Artwork_Comment2` = '$art_comment2', `Artwork3` = '$pic3', `Artwork_Comment3` = '$art_comment3', `Shipping_Method` = '$shipping_method', `ThirdParty_Address` = '$thirdparty_address' WHERE `orders`.`Order_ID` = '$order_id';");
	
    //echo "Last inserted ID is: " . $last_id;
     
	
	if($results)
{ 
 
echo '<p>Sending Order Mails...</p><br>';

$headers = "From: CustomShape CRM <noreply@customshape.in>\r\n";
$headers .= "CC: order@iotenterprise.in \r\n";
$headers .= "Reply-To: noreply@customshape.in\r\n";
$headers .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers.= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
$to = $lead_owner;
$subject = 'Order #'.$order_id.' is Revised of '.$company_name;
/*$message = '<div style="width:800px;margin:10px auto;padding:15px 10px;border: 1px solid #ccc;border-radius: 3px;background: #f8f8f8;">
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
</div>';*/
$message = $order_revision_update.'&ensp;<a href="https://crm2308.customshape.in/ordertable.php?searchtype=idsearch&id='.$order_id.'">Show Order</a>';
mail($to,$subject,$message,$headers);

$headers2 = "From: CustomShape CRM <".$lead_owner.">\r\n";
//$headers .= "CC: order@iotenterprise.in \r\n";
$headers2 .= "Reply-To: ".$lead_owner."\r\n";
$headers2 .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers2.= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers2 .= "MIME-Version: 1.0\r\n";
$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers2 .= "X-Priority: 3\r\n";
$headers2 .= "X-Mailer: PHP". phpversion() ."\r\n" ;
$to2 = $email1;
$subject2 = 'Your Order#'.$order_id.' of '.$product_name.' is Revised';
$message2 = '<div style="width:800px;margin:10px auto;padding:15px 10px;border: 1px solid #ccc;border-radius: 3px;background: #f8f8f8;">
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
</table>
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

$url= "thankyou.php?id=".$order_id;
echo "<script>window.open('$url','_self')</script>";
}
else
{
echo "<script type='text/javascript'>alert('Error Submitting Order');</script>";
}
}	
?>