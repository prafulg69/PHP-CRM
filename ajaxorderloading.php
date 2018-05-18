<?php
include('session.php'); 
$q = intval($_GET['q']);
include 'db_config.php';

$results = $db->query("SELECT customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE orders.Order_ID = $q");


while($row = $results->fetch_assoc()) {
	$delivery_date = new DateTime($row["Delivery_Date"]);
	$ord_date = new DateTime($row["Order_Date"]);
	$order_status = $row["Order_Status"];
	$productname2 = trim($row["Product_Name2"]);
	$productname3 = trim($row["Product_Name3"]);
	$productname4 = trim($row["Product_Name4"]);
	$productname5 = trim($row["Product_Name5"]);
	$shipping_method = 	trim($row["Shipping_Method"]);
	$thirdparty_address = trim($row["ThirdParty_Address"]);
	$option= $row["Courier"];
	if($order_status == "cancel"){ echo '<label class="trackid-label">Order Cancelled !</label>'; } 
	elseif($order_status == "completed"){ echo '<label class="trackid-label">Order Completed !</label>'; } 
	else{
    if($access_level !="production"){ 
    echo '<a href="editorder.php?id='.$row['Order_ID'].'&custid='.$row['customer_id'].'" title="Revise This Order"><i class="icon-button fas fa-pencil-alt"></i></a>
	      <a href="cancelorder.php?id='.$row['Order_ID'].'" title="Cancel This Order"><i class="icon-button fas fa-times"></i></a>'; }
	if($access_level =="production"){ 
	echo '<a href="completeorder.php?id='.$row['Order_ID'].'&custid='.$row['customer_id'].'&amount='.$row['Grand_Total'].'" title="Mark As Order Completed"><i class="icon-button fas fa-check"></i></a>'; }
	}
	echo '<table>
	<tbody>
	<tr class="header">
	<th>Product</th>
	<th>Capacity</th>
	<th>Code</th>
	<th>Qty</th>
	<th>Unit Price</th>
	<th>GST</th>
	<th>Amount</th>
	</tr>
	<tr>
	<td>'.$row["Product_Name1"].'</td>
	<td>'.$row["Product_Capacity1"].'</td>
	<td>'.$row["Product_Code1"].'</td>
	<td>'.$row["Quantity1"].'</td>
	<td>Rs. '.$row["Price_per_pc1"].'</td>
	<td>'.$row["GST_Percentage1"].'%</td>
	<td>Rs. '.$row["Total_Amount1"].'</td>
	</tr>';
	if($productname2 != "") {
	echo '<tr>
	<td>'.$row["Product_Name2"].'</td>
	<td>'.$row["Product_Capacity2"].'</td>
	<td>'.$row["Product_Code2"].'</td>
	<td>'.$row["Quantity2"].'</td>
	<td>Rs. '.$row["Price_per_pc2"].'</td>
	<td>'.$row["GST_Percentage2"].'%</td>
	<td>Rs. '.$row["Total_Amount2"].'</td>
	</tr>'; }
	if($productname3 != "") {
	echo '<tr>
	<td>'.$row["Product_Name3"].'</td>
	<td>'.$row["Product_Capacity3"].'</td>
	<td>'.$row["Product_Code3"].'</td>
	<td>'.$row["Quantity3"].'</td>
	<td>Rs. '.$row["Price_per_pc3"].'</td>
	<td>'.$row["GST_Percentage3"].'%</td>
	<td>Rs. '.$row["Total_Amount3"].'</td>
	</tr>';}
	if($productname4 != "") {
	echo '<tr>
	<td>'.$row["Product_Name4"].'</td>
	<td>'.$row["Product_Capacity4"].'</td>
	<td>'.$row["Product_Code4"].'</td>
	<td>'.$row["Quantity4"].'</td>
	<td>Rs. '.$row["Price_per_pc4"].'</td>
	<td>'.$row["GST_Percentage4"].'%</td>
	<td>Rs. '.$row["Total_Amount4"].'</td>
	</tr>'; }
	if($productname5 != "") {
	echo '<tr>
	<td>'.$row["Product_Name5"].'</td>
	<td>'.$row["Product_Capacity5"].'</td>
	<td>'.$row["Product_Code5"].'</td>
	<td>'.$row["Quantity5"].'</td>
	<td>Rs. '.$row["Price_per_pc5"].'</td>
	<td>'.$row["GST_Percentage5"].'%</td>
	<td>Rs. '.$row["Total_Amount5"].'</td>
	</tr>'; }
	echo '</tbody>
	</table>
	<div class="col-form-11">
	<p>Grand Total : <em>Rs. '.$row["Grand_Total"].'</em></p>
<p>Order ID :  <em>'.$row["Order_ID"].'</em></p>
<p>Sales Person : <em>'.substr($row["Sales_Rep_Email"], 0, strpos($row["Sales_Rep_Email"], '@')).'</em></p>
<p>Order Description : <em>'.$row["Order_Description"].'</em></p>
<p>Branding : <em>'.$row["Branding_Type"].'</em></p>
<p>Packaging : <em>'.$row["Packaging"].'</em></p>
<p>Payment Term : <em>'.$row["Payment_Term"].'</em></p>
<p>Logo Name : <em>'.$row["Logo_Name"].'</em></p>
<p>Order Date : <em>'.$ord_date->format('d-M-Y').'</em></p>
<p>Delivery Date : <em>'.$delivery_date->format('d-M-Y').'</em></p>
<p>Shipping Method : <em>'.$shipping_method.'</em></p>
<p>Tracking No : <em>'.$row["Track_No"].'</em></p>
<p>Courier : <em>'.$row["Courier"].'</em></p>';
if($access_level == "production"){
  if($shipping_method == "courier_ship" || $shipping_method == "courier_thirdparty"){
echo '<form class="track-form" name="trackForm" onsubmit="saveTrackid(); return false;">
<h3 class="subtitle-text">Courier Dispatch</h3>
<label class="trackid-label">Tracking No :</label>
<input type="text" value="'.$row["customer_name"].'" hidden="true" name="customername" >
<input type="text" value="'.$row["customer_companyname"].'" hidden="true" name="companyname" >
<input type="text" value="'.$row["customer_email1"].'" hidden="true" name="customeremail" >
<input type="text" value="'.$row["Sales_Rep_Email"].'" hidden="true" name="salesrepemail" >
'.(($thirdparty_address != '')?'<input type="text" value="'.$thirdparty_address.'" hidden="true" name="shipaddress" >':'<input type="text" value="'.$row["customer_shipaddress"].'" hidden="true" name="shipaddress" >').'
<input type="text" value="'.$row["Order_ID"].'" hidden="true" name="orderid" >
<input class="trackid-text" type="text" value="'.$row["Track_No"].'" name="trackno">
<label class="trackid-label">Courier Service :</label>
<select class="trackid-select" name="courier">
<option value=""></option>
<option value="bluedart" '.(($option=='bluedart')?'selected="selected"':"").'>Blue Dart</option>
<option value="shreetirupati" '.(($option=='shreetirupati')?'selected="selected"':"").'>Tirupati</option>
</select>
<label class="trackid-label">Message for Customer :</label>
<textarea name="message" rows="3" class="trackid-text"></textarea>
<button class="red-button-2" type="submit">Send to Customer</button>
<label id="response" class="required-label"></label>
  </form>'; }  elseif($shipping_method == "self_pickup"){ 
echo '<form class="track-form" name="pickUpForm" onsubmit="pickUpUpdate(); return false;">
<h3 class="subtitle-text">Self Pickup</h3>
<input type="text" value="'.$row["Order_ID"].'" hidden="true" name="pickuporderid" >
<input type="text" value="'.$row["customer_email1"].'" hidden="true" name="pickupcustomeremail" >
<input type="text" value="'.$row["Sales_Rep_Email"].'" hidden="true" name="pickupsalesrepemail" >
<input type="text" value="'.$row["customer_name"].'" hidden="true" name="pickupcustomername" >
<label class="trackid-label">Picked up by :</label>
<input type="text" value="'.$row["Courier"].'" class="trackid-text" name="pickupperson" placeholder="Person Name">
<label class="trackid-label">Message for Customer :</label>
<textarea name="pickupmessage" rows="3" class="trackid-text"></textarea>
<button class="red-button-2" type="submit">Send to Customer</button>
<label id="response3" class="required-label"></label>
  </form>'; } elseif($shipping_method == "self_drop"){ 
echo '<form class="track-form" name="selfDropForm" onsubmit="selfDropUpdate(); return false;">
<h3 class="subtitle-text">Self Drop</h3>
<input type="text" value="'.$row["Order_ID"].'" hidden="true" name="selfdroporderid" >
<input type="text" value="'.$row["customer_email1"].'" hidden="true" name="selfdropcustomeremail" >
<input type="text" value="'.$row["Sales_Rep_Email"].'" hidden="true" name="selfdropsalesrepemail" >
<input type="text" value="'.$row["customer_name"].'" hidden="true" name="selfdropcustomername" >
<label class="trackid-label">Dropped by :</label>
<input type="text" value="'.$row["Courier"].'" class="trackid-text" name="selfdropperson" placeholder="Person Name">
<label class="trackid-label">Message for Customer :</label>
<textarea name="selfdropmessage" rows="3" class="trackid-text"></textarea>
<button class="red-button-2" type="submit">Send to Customer</button>
<label id="response4" class="required-label"></label>
</form>'; } }
echo '</div>

<div class="col-form-11" style="float: right; margin-right: 0;">
<p>Customer Type : <em>'.$row["customer_type"].'</em></p>
<p>Company Name : <em>'.$row["customer_companyname"].'</em></p>
<p>Customer Name : <em>'.$row["customer_name"].'</em></p>
<p>GST No : <em>'.$row["customer_gstno"].'</em></p>
<p>Contact No : <em>'.$row["customer_contactno1"].'</em></p>
<p>Telephone : <em>'.$row["customer_contactno2"].'</em></p>
<p>Email : <em>'.$row["customer_email1"].'</em></p>
<p>Email 2 : <em>'.$row["customer_email2"].'</em></p>';
if($shipping_method == "courier_ship"){
echo '<p>Shipping Address : <em>'.$row["customer_shipaddress"].'</em></p>
<p>Shipping City : <em>'.$row["customer_shipcity"].'</em></p>
<p>Shipping Pin Code : <em>'.$row["customer_shipzip"].'</em></p>';
} elseif($shipping_method == "courier_thirdparty") {
echo '<p>Shipping Address : <em>'.$thirdparty_address.'</em></p>';
}
echo '<p>Billing Address : <em>'.$row["customer_billaddress"].'</em></p>';
$pic1 = $row["Artwork1"];
$pic2 = $row["Artwork2"];
$pic3 = $row["Artwork3"];
if(trim($pic1) != ""){
	$link1= "https://crm2308.customshape.in/artworks/".rawurlencode($pic1);
	echo '<p>Artwork 1 : <a href='.$link1.'><button>Download ('.$row["Artwork_Comment1"].')</button></a></p>';
} 
if(trim($pic2) != ""){
	$link2= "https://crm2308.customshape.in/artworks/".rawurlencode($pic2);
	echo '<p>Artwork 2 : <a href='.$link2.'><button>Download ('.$row["Artwork_Comment2"].')</button></a></p>';
}
if(trim($pic3) != ""){
	$link3= "https://crm2308.customshape.in/artworks/".rawurlencode($pic3);
	echo '<p>Artwork 3 : <a href='.$link3.'><button>Download ('.$row["Artwork_Comment3"].')</button></a></p>';
}
echo '<div class="order-log">
'.$row["Order_Log"].'
<p id="response2"></p>
</div>

<form style="margin-top: 0;" class="track-form" name="orderUpdateForm" onsubmit="saveOrderUpdate(); return false;">
<input type="text" value="'.$row["Order_ID"].'" hidden="true" name="orderupdateid" >
<input type="text" value="'.$row["Sales_Rep_Email"].'" hidden="true" name="ousalesrepemail" >
<label class="trackid-label">Enter Order Update :</label>
<textarea name="order-update" rows="3" class="trackid-text"></textarea>
<button class="red-button-2" type="submit">Submit</button>
<label id="response2" class="required-label"></label>
</form>
</div>';  
}

?>

