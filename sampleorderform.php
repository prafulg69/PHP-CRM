<?php
  include('session.php');
?>
<html>
<head>
<title>IOT Enterprise Sample Order Form</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
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
        $cust_id= $_GET['custid'];		
		$results= $db->query("SELECT * FROM `customers` where customer_id='$cust_id'");
		while($row = $results->fetch_assoc())
		{
  ?>
<form name="myForm" class="lead-form" onsubmit="return validate(this);" action="sampleorderform.php" method="POST" enctype="multipart/form-data">
<input type="text" value="<?php echo $cust_id; ?>" name="cust_id" hidden="true">
<h1 class="title-text">Send Sample(s) to <?php echo trim($row["customer_companyname"])?></h1>
<div class="cover">

<!--<a id="hide1" href="#hide1" class="hide drop-anchor">+ Multiple Product Details</a>
<a id="show1" href="#show1" class="show drop-anchor">- Multiple Product Details</a>-->
<table class="producttable">
<tr class="header">
<td>No.</td>
<td>Product Name</td>
<td>Capacity</td>
<td>Product Code</td>
<td>Unit Price</td>
<td>Quantity</td>
<td>GST%</td>
<td>Amount</td>
</tr>
<tr>
<td class="required-label">
<b>1.*<b>
</td>
<td>
<input type="text" value="" name="product_name1" class="required">
</td>
<td>
<input list="capacities" type="text" value="" name="product_capacity1" class="required">
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
</td>
<td>
<input type="text" value="" name="product_code1">
</td>
<td>
<input type="text" value="" name="price1" class="required" id="price1" onkeyup="revertAmount(1)">
</td>
<td>
<input type="text" value="" name="quantity1" class="required" id="quantity1" onkeyup="revertAmount(1)">
</td>
<td>
<select name="gst_percent1" id="gst_percent1" onchange="return calculateAmount(1, gst_percent1.value, price1.value, quantity1.value)">
<option value="0">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount1" id="totalamount1" class="required" readonly>
</td>
</tr>

<tr>
<td>
<b>2.<b>
</td>
<td>
<input type="text" value="" name="product_name2">
</td>
<td>
<input list="capacities" type="text" value="" name="product_capacity2" >
</td>
<td>
<input type="text" value="" name="product_code2" >
</td>
<td>
<input type="text" value="" name="price2" id="price2" onkeyup="revertAmount(2)">
</td>
<td>
<input type="text" value="" name="quantity2" id="quantity2" onkeyup="revertAmount(2)">
</td>
<td>
<select name="gst_percent2" id="gst_percent2" onchange="return calculateAmount(2, gst_percent2.value, price2.value, quantity2.value)">
<option value="0">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount2" id="totalamount2" readonly>
</td>
</tr>

<tr>
<td>
<b>3.<b>
</td>
<td>
<input type="text" value="" name="product_name3">
</td>
<td>
<input list="capacities" type="text" value="" name="product_capacity3">
</td>
<td>
<input type="text" value="" name="product_code3">
</td>
<td>
<input type="text" value="" name="price3" id="price3" onkeyup="revertAmount(3)">
</td>
<td>
<input type="text" value="" name="quantity3" id="quantity3" onkeyup="revertAmount(3)">
</td>
<td>
<select name="gst_percent3" id="gst_percent3" onchange="return calculateAmount(3, gst_percent3.value, price3.value, quantity3.value)">
<option value="0">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount3" id="totalamount3" readonly>
</td>
</tr>

<tr>
<td>
<b>4.<b>
</td>
<td>
<input type="text" value="" name="product_name4">
</td>
<td>
<input list="capacities" type="text" value="" name="product_capacity4">
</td>
<td>
<input type="text" value="" name="product_code4" id="product_code4">
</td>
<td>
<input type="text" value="" name="price4" id="price4" onkeyup="revertAmount(4)">
</td>
<td>
<input type="text" value="" name="quantity4" id="quantity4" onkeyup="revertAmount(4)">
</td>
<td>
<select name="gst_percent4" id="gst_percent4" onchange="return calculateAmount(4, gst_percent4.value, price4.value, quantity4.value)">
<option value="0">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount4" id="totalamount4" readonly>
</td>
</tr>

<tr>
<td>
<b>5.<b>
</td>
<td>
<input type="text" value="" name="product_name5" >
</td>
<td>
<input list="capacities" type="text" value="" name="product_capacity5">
</td>
<td>
<input type="text" value="" name="product_code5" >
</td>
<td>
<input type="text" value="" name="price5" id="price5" onkeyup="revertAmount(5)">
</td>
<td>
<input type="text" value="" name="quantity5" id="quantity5" onkeyup="revertAmount(5)">
</td>
<td>
<select name="gst_percent5" id="gst_percent5" onchange="return calculateAmount(5, gst_percent5.value, price5.value, quantity5.value)">
<option value="0">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount5" id="totalamount5" readonly>
</td>
</tr>
</table>

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
<input type="text" value="<?php echo trim($row["customer_gstno"])?>" name="gst_no" readonly>
<label>Shipping Address</label>
<textarea name="ship_address" rows="4" id="ship_address" class="required" readonly><?php echo trim($row["customer_shipaddress"])?></textarea>
<div>
<div class="two-col-left">
<label>Shipping City</label>
<input type="text" value="<?php echo trim($row["customer_shipcity"])?>" name="ship_city" id="ship_city" readonly>
</div>
<div class="two-col-right">
<label>Zip Code</label>
<input type="text" value="<?php echo trim($row["customer_shipzip"])?>" name="ship_zip" id="ship_zip"  readonly>
</div>
</div>
<label>Billing Address</label>
<textarea name="bill_address" rows="4" id="bill_address" readonly><?php echo trim($row["customer_billaddress"])?></textarea>
</div>

<div class="col-form-2">
<h3 class="subtitle-text">Sample Order Details</h3>
<label>Description</label>
<textarea name="order_description" rows="5" id="order_description"></textarea>
<label>Shipping Method</label>
<div>
<input type="radio" name="shipping_method" value="self_pickup" onclick="hideShow(this.value);" required> Self Pick-up&ensp;&ensp;&ensp;
<input type="radio" name="shipping_method" value="self_drop" onclick="hideShow(this.value);" required> Self Drop&ensp;&ensp;&ensp;
<input type="radio" name="shipping_method" value="courier_ship" onclick="hideShow(this.value);" required> Courier&ensp;&ensp;&ensp;
<input type="radio" name="shipping_method" value="courier_thirdparty" onclick="hideShow(this.value);" required> Third Party
<textarea name="thirdparty_address" rows="4" id="thirdparty_address" placeholder= "Third Party Shipping Address" style="display: none;"></textarea>
</div>
<label>Returnable Basis</label>
<div>
<input type="radio" name="returnable_basis" value="Yes" required> Yes&ensp;&ensp;&ensp;
<input type="radio" name="returnable_basis" value="No" required> No
</div>
</div>
</div>
<button class="full-width-btn" type="submit" name="submit">SUBMIT SAMPLE ORDER</button>
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
	var price1 = document.forms["myForm"]["price1"].value;
    var quantity1 = document.forms["myForm"]["quantity1"].value;
  

    for (var i=0, iLen=elements.length; i<iLen; i++) {
      el = elements[i];

      if (reClass.test(el.className) && reValue.test(el.value)) {
        // Required field has no value or only whitespace
        // Advise user to fix
        alert('Please fix ' + el.name);
        return false;
      }
	  
    }
	if (price1 == null || price1 == "" || isNaN(price1)) {
        alert("Price must be only numbers");
        return false;
    } 
	else if (quantity1 == null || quantity1 == "" || isNaN(quantity1)) {
        alert("Quantity must be only numbers");
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
function calculateAmount(no,gst, price, quantity) {
var a= parseFloat(price)*parseFloat(quantity);
var b= parseFloat(a)+(parseFloat(a)*parseFloat(gst)/100);
document.getElementById("totalamount"+no).value = b; 
}
</script>

<script type="text/javascript">
function revertAmount(no){
	document.getElementById("totalamount"+no).value = "";
}
</script>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
	echo '<p>Submitting Your Order...</p><br>';
$cust_id= trim(addslashes($_POST['cust_id']));
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
$gst_no=trim(addslashes($_POST['gst_no']));
$product_name1= trim(addslashes($_POST['product_name1']));
$product_name2= trim(addslashes($_POST['product_name2']));
$product_name3= trim(addslashes($_POST['product_name3']));
$product_name4= trim(addslashes($_POST['product_name4']));
$product_name5= trim(addslashes($_POST['product_name5']));
///
$product_capacity1= trim(addslashes($_POST['product_capacity1']));
$product_capacity2= trim(addslashes($_POST['product_capacity2']));
$product_capacity3= trim(addslashes($_POST['product_capacity3']));
$product_capacity4= trim(addslashes($_POST['product_capacity4']));
$product_capacity5= trim(addslashes($_POST['product_capacity5']));
//
$product_code1= trim(addslashes($_POST['product_code1']));
$product_code2= trim(addslashes($_POST['product_code2']));
$product_code3= trim(addslashes($_POST['product_code3']));
$product_code4= trim(addslashes($_POST['product_code4']));
$product_code5= trim(addslashes($_POST['product_code5']));
//
$price1= trim(addslashes($_POST['price1']));
$price2= trim(addslashes($_POST['price2']));
$price3= trim(addslashes($_POST['price3']));
$price4= trim(addslashes($_POST['price4']));
$price5= trim(addslashes($_POST['price5']));
//
$quantity1=trim(addslashes($_POST['quantity1']));
$quantity2=trim(addslashes($_POST['quantity2']));
$quantity3=trim(addslashes($_POST['quantity3']));
$quantity4=trim(addslashes($_POST['quantity4']));
$quantity5=trim(addslashes($_POST['quantity5']));
//
$amount1=trim($_POST['totalamount1']);
$amount2=trim($_POST['totalamount2']);
$amount3=trim($_POST['totalamount3']);
$amount4=trim($_POST['totalamount4']);
$amount5=trim($_POST['totalamount5']);
//
$gst_percent1=trim(addslashes($_POST['gst_percent1']));
$gst_percent2=trim(addslashes($_POST['gst_percent2']));
$gst_percent3=trim(addslashes($_POST['gst_percent3']));
$gst_percent4=trim(addslashes($_POST['gst_percent4']));
$gst_percent5=trim(addslashes($_POST['gst_percent5']));
//
$grandtotal= $amount1+$amount2+$amount3+$amount4+$amount5;
$order_description=trim(addslashes($_POST['order_description']));
$returnable_basis=trim(addslashes($_POST['returnable_basis']));
$shipping_method=trim(addslashes($_POST['shipping_method']));
$thirdparty_address=trim(addslashes($_POST['thirdparty_address']));
date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i:s");


	
	$results = $db->query("INSERT INTO `sample_orders` (`customer_id`, `Sales_Rep_Email`, `Product_Name1`, `Product_Capacity1`, `Product_Code1`,`Price_per_pc1`, `Quantity1`, `Total_Amount1`, `GST_Percentage1`, `Product_Name2`, `Product_Capacity2`, `Product_Code2`,`Price_per_pc2`, `Quantity2`, `Total_Amount2`, `GST_Percentage2`, `Product_Name3`, `Product_Capacity3`, `Product_Code3`,`Price_per_pc3`, `Quantity3`, `Total_Amount3`, `GST_Percentage3`, `Product_Name4`, `Product_Capacity4`, `Product_Code4`,`Price_per_pc4`, `Quantity4`, `Total_Amount4`, `GST_Percentage4`, `Product_Name5`, `Product_Capacity5`, `Product_Code5`,`Price_per_pc5`, `Quantity5`, `Total_Amount5`, `GST_Percentage5`, `Grand_Total`,  `Order_Description`, `Returnable_Basis`,  `Order_Date`, `Shipping_Method`, `ThirdParty_Address`) VALUES (
	'$cust_id',
	'$lead_owner',
	'$product_name1',
	'$product_capacity1',
	'$product_code1',
	'$price1',
	'$quantity1',
	'$amount1',
	'$gst_percent1',
	'$product_name2',
	'$product_capacity2',
	'$product_code2',
	'$price2',
	'$quantity2',
	'$amount2',
	'$gst_percent2',
	'$product_name3',
	'$product_capacity3',
	'$product_code3',
	'$price3',
	'$quantity3',
	'$amount3',
	'$gst_percent3',
	'$product_name4',
	'$product_capacity4',
	'$product_code4',
	'$price4',
	'$quantity4',
	'$amount4',
	'$gst_percent4',
	'$product_name5',
	'$product_capacity5',
	'$product_code5',
	'$price5',
	'$quantity5',
	'$amount5',
	'$gst_percent5',
	'$grandtotal',	
	'$order_description',
	'$returnable_basis',
	'$fulldate',
	'$shipping_method',
	'$thirdparty_address');");
	$last_id = $db->insert_id;
	
    //echo "Last inserted ID is: " . $last_id;
     
	
	if($results)
{ 

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
<td>'.$product_name1.'</td>
<td>'.$product_code1.'</td>
<td>Rs. '.$price1.'</td>
<td>'.$quantity1.'</td>
<td>'.$gst_percent1.'%</td>
<td>Rs. '.$amount1.'</td>
</tr>
<tr>
<td>'.$product_name2.'</td>
<td>'.$product_code2.'</td>
<td>Rs. '.$price2.'</td>
<td>'.$quantity2.'</td>
<td>'.$gst_percent2.'%</td>
<td>Rs. '.$amount2.'</td>
</tr>
<tr>
<td>'.$product_name3.'</td>
<td>'.$product_code3.'</td>
<td>Rs. '.$price3.'</td>
<td>'.$quantity3.'</td>
<td>'.$gst_percent3.'%</td>
<td>Rs. '.$amount3.'</td>
</tr>
<tr>
<td>'.$product_name4.'</td>
<td>'.$product_code4.'</td>
<td>Rs. '.$price4.'</td>
<td>'.$quantity4.'</td>
<td>'.$gst_percent4.'%</td>
<td>Rs. '.$amount4.'</td>
</tr>
<tr>
<td>'.$product_name5.'</td>
<td>'.$product_code5.'</td>
<td>Rs. '.$price5.'</td>
<td>'.$quantity5.'</td>
<td>'.$gst_percent5.'%</td>
<td>Rs. '.$amount5.'</td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td>Total</td>
<td>Rs. '.$grandtotal.'</td>
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
$subject2 = 'Your sample request is approved';
$message2 = '<div style="width:700px;margin:10px auto;padding:15px 10px;border: 1px solid #ccc;border-radius: 3px;background: #f8f8f8;">
<table width="100%">
<tbody>
<tr>
<td align="left" >
<img src="https://www.customshape.in/skin/frontend/smartwave/porto/images/custom-shape-logo.png" alt="CustomShape.in Logo">
<p><b>Sales Executive Email:</b><br>'.$lead_owner.'
</td>
<td align="right" style="line-height: 1.5;" width="250px">
<h2>Sample Confirmation</h2>
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
<p style="font-size: large; line-height: 1.5;">Thank you for your sample request. Below is your sample details. We’ll send you a confirmation once we dispatch your items. Reply to this email for any queries.</p>
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
<td>'.$product_name1.'</td>
<td>Rs. '.$price1.'</td>
<td>'.$quantity1.'</td>
<td>'.$gst_percent1.'%</td>
<td>Rs. '.$amount1.'</td>
</tr>
<tr>
<td>'.$product_name2.'</td>
<td>Rs. '.$price2.'</td>
<td>'.$quantity2.'</td>
<td>'.$gst_percent2.'%</td>
<td>Rs. '.$amount2.'</td>
</tr>
<tr>
<td>'.$product_name3.'</td>
<td>Rs. '.$price3.'</td>
<td>'.$quantity3.'</td>
<td>'.$gst_percent3.'%</td>
<td>Rs. '.$amount3.'</td>
</tr>
<tr>
<td>'.$product_name4.'</td>
<td>Rs. '.$price4.'</td>
<td>'.$quantity4.'</td>
<td>'.$gst_percent4.'%</td>
<td>Rs. '.$amount4.'</td>
</tr>
<tr>
<td>'.$product_name5.'</td>
<td>Rs. '.$price5.'</td>
<td>'.$quantity5.'</td>
<td>'.$gst_percent5.'%</td>
<td>Rs. '.$amount5.'</td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td>Total</td>
<td>Rs. '.$grandtotal.'</td>
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
<p><b>Shipping Method: </b>'.$shipping_method.'</p>
<p><b>Returnable Basis: </b>'.$returnable_basis.'</p>
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

$url= "thankyou.php?id=".$last_id."&custid=".$cust_id."&type=sample";
echo "<script>window.open('$url','_self')</script>";
}
else
{
echo "<script type='text/javascript'>alert('Error Submitting Order');</script>";
}
}	
?>