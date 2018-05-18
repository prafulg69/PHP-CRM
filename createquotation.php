<?php include('session.php');  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Create and Send Quotation</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
<meta charset="UTF-8">
</head>
<body>
<?php include('header.php'); ?>
<div class="container">
<?php
        $lead_id = $_GET['leadid']; 
		$cust_id = $_GET['cust_id']; 
		$url = $_GET['url']; 
        include 'db_config.php';
		$results= $db->query("SELECT * FROM `customers` where customer_id = '$cust_id'");
		while($row = $results->fetch_assoc())
		{ 	  
  ?>
  <div class="quotation-table cover">
  <form name="myForm"  onsubmit="return validate(this);" action="createquotation.php" method="POST" >
  <div class="quote-col">
  <div class="col-form">
  <h1 class="title-text">Send Quotation to <?php echo $row["customer_companyname"]?></h1>
  <label>Client Name : <?php echo $row["customer_name"]?></label><br>
  <label>Email ID : <?php echo $row["customer_email1"]?></label><br>
  <input type="text" value="" name="subject" placeholder="Email Subject" class="required" >
  <input type="text" value="" name="ccemails" placeholder="Optional CC Recipients (Add comma seperated emails)" >
  </div>

  <div class="col-form fl-right">
  <label><b>Text to be attached with the Email :</b></label>
<textarea class="required" name="comments" rows="7" placeholder="Additional Comments" style="width: -webkit-fill-available;">* The data loading service is complimentary with the pendrives.&#10;* Above prices are inclusive of branding, packaging & shipping charges only.&#10;* Payment 50% advance for order process and balance after delivery within 3-5 working days.&#10;* Delivery Time will be 4-5 working days from the date of Order Confirmation.</textarea>
</div>
  </div>
  <input type="text" value="<?php echo $row["customer_name"]?>" name="fullname" hidden="true">
  <input type="text" value="<?php echo $row["customer_companyname"]?>" name="companyname" hidden="true">
  <input type="text" value="<?php echo $row["customer_email1"]?>" name="clientemail" class="required" hidden="true" >
  <input type="text" value="<?php echo $login_session; ?>" name="senderemail" hidden="true">
  <input type="text" value="<?php echo $url; ?>" name="url" hidden="true">
<?php } ?>
<table>
<tr class="header">
<td>No.</td>
<td>Product Name</td>
<td>Quantity</td>
<td>Unit Price</td>
<td>GST %</td>
<td>Amount</td>
<td>Price Includes</td>
<td>Delivery Timeline</td>
</tr>
<tr>
<td class="required-label">
<b>1.*<b>
</td>
<td class="productname-cell">
<input type="text" value="" name="product_name1" class="required">
</td>
<td class="date">
<input type="text" value="" name="quantity1" id="quantity1" class="required" onkeyup="revertAmount(1)">
</td>
<td class="date">
<input type="text" value="" name="price1" id="price1" class="required" onkeyup="revertAmount(1)">
</td>
<td>
<select name="gst_percent1" onchange="return calculateAmount(1, gst_percent1.value, price1.value, quantity1.value)">
<option value="">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount1" id="totalamount1" class="required">
</td>
<td>
<input type="text" value="" name="includes1" class="required">
</td>
<td>
<input type="text" value="" name="delivery_time1" class="required">
</td>
</tr>

<tr>
<td>
<b>2.<b>
</td>
<td class="productname-cell">
<input type="text" value="" name="product_name2" >
</td>
<td class="date">
<input type="text" value="" name="quantity2" onkeyup="revertAmount(2)">
</td>
<td class="date">
<input type="text" value="" name="price2" onkeyup="revertAmount(2)">
</td>
<td>
<select name="gst_percent2" onchange="return calculateAmount(2, gst_percent2.value, price2.value, quantity2.value)">
<option value="">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount2" id="totalamount2">
</td>
<td>
<input type="text" value="" name="includes2" >
</td>
<td>
<input type="text" value="" name="delivery_time2" >
</td>
</tr>

<tr>
<td>
<b>3.<b>
</td>
<td class="productname-cell">
<input type="text" value="" name="product_name3" >
</td>
<td class="date">
<input type="text" value="" name="quantity3" onkeyup="revertAmount(3)">
</td>
<td class="date">
<input type="text" value="" name="price3" onkeyup="revertAmount(3)">
</td>
<td>
<select name="gst_percent3" onchange="return calculateAmount(3, gst_percent3.value, price3.value, quantity3.value)">
<option value="">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount3" id="totalamount3">
</td>
<td>
<input type="text" value="" name="includes3" >
</td>
<td>
<input type="text" value="" name="delivery_time3" >
</td>
</tr>

<tr>
<td>
<b>4.<b>
</td>
<td class="productname-cell">
<input type="text" value="" name="product_name4" >
</td>
<td class="date">
<input type="text" value="" name="quantity4" onkeyup="revertAmount(4)">
</td>
<td class="date">
<input type="text" value="" name="price4" onkeyup="revertAmount(4)">
</td>
<td>
<select name="gst_percent4" onchange="return calculateAmount(4, gst_percent4.value, price4.value, quantity4.value)">
<option value="">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount4" id="totalamount4">
</td>
<td>
<input type="text" value="" name="includes4" >
</td>
<td>
<input type="text" value="" name="delivery_time4" >
</td>
</tr>

<tr>
<td>
<b>5.<b>
</td>
<td class="productname-cell">
<input type="text" value="" name="product_name5" >
</td>
<td class="date">
<input type="text" value="" name="quantity5" onkeyup="revertAmount(5)">
</td>
<td class="date">
<input type="text" value="" name="price5" onkeyup="revertAmount(5)">
</td>
<td>
<select name="gst_percent5" onchange="return calculateAmount(5, gst_percent5.value, price5.value, quantity5.value)">
<option value="">NA</option>
<option value="28">28%</option>
<option value="18">18%</option>
<option value="12">12%</option>
<option value="6">6%</option>
<option value="3">3%</option>
</select>
</td>
<td>
<input type="text" value="" name="totalamount5" id="totalamount5">
</td>
<td>
<input type="text" value="" name="includes5" >
</td>
<td>
<input type="text" value="" name="delivery_time5" >
</td>
</tr>
</table>
<button class="full-width-btn" type="submit" name="submit">SEND QUOTATION</button>
</form>
</div>
</div>
<script type="text/javascript">
  var validate = (function() {
  var reClass = /(^|\s)required(\s|$)/;  // Field is required
  var reValue = /^\s*$/;   // Match all whitespace
  

  return function (form) {
    var elements = form.elements;
    var el;
    for (var i=0, iLen=elements.length; i<iLen; i++) {
      el = elements[i];

      if (reClass.test(el.className) && reValue.test(el.value)) {
        // Required field has no value or only whitespace
        // Advise user to fix
        alert('Please fix ' + el.name);
        return false;
      }	  
	  
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

function revertAmount(no){
	document.getElementById("totalamount"+no).value = "";
}
</script>

</script>

</body>
</html>
<?php 
 if(isset($_POST['submit'])){
	  
   $fullname=trim(addslashes($_POST['fullname']));
   $companyname=trim(addslashes($_POST['companyname']));
   $clientemail=trim(addslashes($_POST['clientemail']));
   $senderemail=trim(addslashes($_POST['senderemail']));
   $product_name1=trim(addslashes($_POST['product_name1']));
   $price1=trim(addslashes($_POST['price1']));
   $quantity1=trim(addslashes($_POST['quantity1']));
   $gst_percent1=trim(addslashes($_POST['gst_percent1']));
   $totalamount1=trim(addslashes($_POST['totalamount1']));
   $includes1=trim(addslashes($_POST['includes1']));
   $delivery_time1=trim(addslashes($_POST['delivery_time1']));
   $product_name2=trim(addslashes($_POST['product_name2']));
   $price2=trim(addslashes($_POST['price2']));
   $quantity2=trim(addslashes($_POST['quantity2']));
   $gst_percent2=trim(addslashes($_POST['gst_percent2']));
   $totalamount2=trim(addslashes($_POST['totalamount2']));
   $includes2=trim(addslashes($_POST['includes2']));
   $delivery_time2=trim(addslashes($_POST['delivery_time2']));
   $product_name3=trim(addslashes($_POST['product_name3']));
   $price3=trim(addslashes($_POST['price3']));
   $quantity3=trim(addslashes($_POST['quantity3']));
   $gst_percent3=trim(addslashes($_POST['gst_percent3']));
   $totalamount3=trim(addslashes($_POST['totalamount3']));
   $includes3=trim(addslashes($_POST['includes3']));
   $delivery_time3=trim(addslashes($_POST['delivery_time3']));
   $product_name4=trim(addslashes($_POST['product_name4']));
   $price4=trim(addslashes($_POST['price4']));
   $quantity4=trim(addslashes($_POST['quantity4']));
   $gst_percent4=trim(addslashes($_POST['gst_percent4']));
   $totalamount4=trim(addslashes($_POST['totalamount4']));
   $includes4=trim(addslashes($_POST['includes4']));
   $delivery_time4=trim(addslashes($_POST['delivery_time4']));
   $product_name5=trim(addslashes($_POST['product_name5']));
   $price5=trim(addslashes($_POST['price5']));
   $quantity5=trim(addslashes($_POST['quantity5']));
   $gst_percent5=trim(addslashes($_POST['gst_percent5']));
   $totalamount5=trim(addslashes($_POST['totalamount5']));
   $includes5=trim(addslashes($_POST['includes5']));
   $delivery_time5=trim(addslashes($_POST['delivery_time5']));
   $grandtotal = trim($totalamount1)+trim($totalamount2)+trim($totalamount3)+trim($totalamount4)+trim($totalamount5);
   $subject=trim(addslashes($_POST['subject']));
   $comments=trim(addslashes($_POST['comments']));
   $ccemails=trim(addslashes($_POST['ccemails']));
   $url=trim(addslashes($_POST['url']));
   date_default_timezone_set('Asia/Kolkata'); 
   $fulldate= date("d-M-Y");
   $headers = "From: CustomShape.in <".$senderemail.">\r\n";
$headers .= "Reply-To: ".$senderemail."\r\n";
$headers .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers .= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
   if(trim($ccemails) != ""){ $headers .= "CC: ".$ccemails."  \r\n"; }
   $to = $clientemail;
   $message = '<div style="width:800px;margin:10px auto;padding:15px 10px;border: 1px solid #ccc;border-radius: 3px;background: #f8f8f8;">
<table width="100%">
<tbody>
<tr>
<td align="left" width="40%" style="line-height: 1.5;">
<img src="https://www.customshape.in/skin/frontend/smartwave/porto/images/custom-shape-logo.png" alt="CustomShape.in Logo">
<p><b>From: </b> CustomShape.in</p>
<p><b>Email:</b> '.$senderemail.'<br><b>Address:</b> 904, 9th floor, DLH Park, Sundar Nagar, SV Road, Near MTNL Office, Malad west, MUMBAI 400064</p>
</td>
<td align="right" style="line-height: 1.5;" width="50%">
<h2>Price Quotation</h2>
<p><b>To: </b> '.$companyname.'</p>
<p><b>Contacted Person: </b>'.$fullname.'<br><b>Quote Date: </b>'.$fulldate.'</p>
</td>
</tr>
</tbody>
</table>
<table width="100%">
<tbody>
<tr>
<br>
<td>
<p style="font-size: large;">Hello '.$fullname.', Below is the detailed quotation from PromoUSB.in</p>
</td>
</tr>
</tbody>
</table>

<table width="100%" rules="cols" cellpadding="5" style="border:1px solid #999;">
<tbody>
<tr style="background: #a1d8ff; border: 1px solid #999;">
<th>Product Name</th>
<th>Quantity</th>
<th>Unit Price (Rs.)</th>
<th>GST %</th>
<th>Amount (Rs.)</th>
<th>Price Includes</th>
<th>Delivery Timeline</th>
</tr>
<tr>
<td>'.$product_name1.'</td>
<td>'.$quantity1.'</td>
<td>'.$price1.'</td>
<td>'.$gst_percent1.'</td>
<td>'.$totalamount1.'</td>
<td>'.$includes1.'</td>
<td>'.$delivery_time1.'</td>
</tr>
<tr>
<td>'.$product_name2.'</td>
<td>'.$quantity2.'</td>
<td>'.$price2.'</td>
<td>'.$gst_percent2.'</td>
<td>'.$totalamount2.'</td>
<td>'.$includes2.'</td>
<td>'.$delivery_time2.'</td>
</tr>
<tr>
<td>'.$product_name3.'</td>
<td>'.$quantity3.'</td>
<td>'.$price3.'</td>
<td>'.$gst_percent3.'</td>
<td>'.$totalamount3.'</td>
<td>'.$includes3.'</td>
<td>'.$delivery_time3.'</td>
</tr>
<tr>
<td>'.$product_name4.'</td>
<td>'.$quantity4.'</td>
<td>'.$price4.'</td>
<td>'.$gst_percent4.'</td>
<td>'.$totalamount4.'</td>
<td>'.$includes4.'</td>
<td>'.$delivery_time4.'</td>
</tr>
<tr>
<td>'.$product_name5.'</td>
<td>'.$quantity5.'</td>
<td>'.$price5.'</td>
<td>'.$gst_percent5.'</td>
<td>'.$totalamount5.'</td>
<td>'.$includes5.'</td>
<td>'.$delivery_time5.'</td>
</tr>
<tr>
<td>&nbsp;</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr style="border-top: 1px solid #999;">
<td>&nbsp;</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>Total</td>
<td>'.$grandtotal.'</td>
</tr>
</tbody>
</table><br>
<table width="100%" rules="all" cellpadding="5" style="border:1px solid #999;">
<tbody>
<tr>
<td><b>Terms & Conditions</b></td>
</tr>
<tr>
<td>'.str_replace("*","<br/>*",$comments).'</td>
</tr>
<tr>
<td><b>GST No:</b> 27AAHCB4208P1ZD</td>
</tr>
</tbody>
</table><br>
<table width="100%" rules="all" cellpadding="5" style="border:1px solid #999;">
<tbody>
<tr>
<td><b>Declaration</b></td>
<td><b>Stamp</b></td>
</tr>
<tr>
<td><q>I/we hereby certify that my/our Registration Certificate under the Maharashtra Value Added Tax Act 2002 is in force on the date on which the sale of	the goods specified in this tax invoice is made by me/us and that the transaction of sale cover by this tax invoice has been effected by me/us and it shell be accounted for in the turnover of sales while filling of return and the due tax, if any payable on the sales has been paid or be paid</q></td>
<td><img src="https://crm2308.customshape.in/images/STAMP.jpg" alt="BW Tech Stamp"></td>
</tr>
</tbody>
</table>
<table width="100%" cellpadding="20">
<tbody>
<tr>
<td><p style="text-align: center; color: #777;">Reply to this email if you have any queries. Thank You for your interest !</p></td>
</tr>
</tbody>
</table>
</div>';
   mail($to,$subject,$message,$headers);
   echo "<script type='text/javascript'>alert('Quotation Sent');</script>";
   echo "<script>window.open('$url','_self')</script>";
 }?>