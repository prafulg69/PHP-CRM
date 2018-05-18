<?php
include('session.php'); 
?>
<!DOCTYPE HTML>
<html>
<head>
<title>CustomShape.in Order Table</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
       
    } else {
		document.getElementById("loading-text").style.display='inline-block';
        document.getElementById("loading-text").innerHTML = "Loading...";		
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
			    document.getElementById("loading-text").innerHTML = "";
				document.getElementById("loading-text").style.display='none';
            }
        };
        xmlhttp.open("GET","ajaxorderloading.php?q="+str,true);
        xmlhttp.send();
		
    }
}
</script>
<script>
function saveTrackid() {
	var id = document.forms["trackForm"]["orderid"].value;
	var trackno = document.forms["trackForm"]["trackno"].value;
	var courier = document.forms["trackForm"]["courier"].value;
	var companyname = document.forms["trackForm"]["companyname"].value;
	var customeremail = document.forms["trackForm"]["customeremail"].value;
	var salesrepemail = document.forms["trackForm"]["salesrepemail"].value;
	var shipaddress = document.forms["trackForm"]["shipaddress"].value;
	var customername = document.forms["trackForm"]["customername"].value;
	var message = document.forms["trackForm"]["message"].value;
    if (trackno == "" || courier == "" || message == "") {
        document.getElementById("response").innerHTML = "Missing Track ID or Courier or Message";
        return false;
    } else { 
	document.getElementById("response").innerHTML = "Saving Track ID...";
        var http = new XMLHttpRequest();
    http.open("POST", "ajaxsavetrackid.php", true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var params = "id=" + id + "&trackno=" + trackno + "&customeremail=" + customeremail + "&salesrepemail=" + salesrepemail + "&shipaddress=" + shipaddress +"&courier=" + courier + "&customername=" + customername + "&message=" + message + "&companyname=" + companyname;
    http.send(params);
    http.onload = function() {
		document.getElementById("response").innerHTML = http.responseText;
    }
    }
}
</script>
<script>
function saveOrderUpdate() {
	var ouid = document.forms["orderUpdateForm"]["orderupdateid"].value;
	var oumessage = document.forms["orderUpdateForm"]["order-update"].value;
	var ousalesrepemail = document.forms["orderUpdateForm"]["ousalesrepemail"].value;
    if (oumessage == "") {
        document.getElementById("response2").innerHTML = "Missing Order Update !";
        return false;
    }
	else { 
	document.getElementById("response2").innerHTML = "Saving Order Update...";
        var http = new XMLHttpRequest();
    http.open("POST", "ajaxsaveorderupdate.php", true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var params = "id=" + ouid + "&oumessage=" + oumessage + "&ousalesrepemail=" + ousalesrepemail;
    http.send(params);
    http.onload = function() {
		document.getElementById("response2").innerHTML = http.responseText;
		document.getElementById("order-update").value = "";
    }
	}
}
</script>

<script>
function pickUpUpdate() {
	var pickuporderid = document.forms["pickUpForm"]["pickuporderid"].value;
	var pickupmessage = document.forms["pickUpForm"]["pickupmessage"].value;
	var pickupcustomeremail = document.forms["pickUpForm"]["pickupcustomeremail"].value;
	var pickupsalesrepemail = document.forms["pickUpForm"]["pickupsalesrepemail"].value;
	var pickupperson = document.forms["pickUpForm"]["pickupperson"].value;
	var pickupcustomername = document.forms["pickUpForm"]["pickupcustomername"].value;
    if (pickupperson == "" || pickupmessage == "") {
        document.getElementById("response3").innerHTML = "Missing Pickup Person Name or Message";
        return false;
    }
	else { 
	document.getElementById("response3").innerHTML = "Saving Self Pickup Update...";
        var http = new XMLHttpRequest();
    http.open("POST", "ajaxsaveselfpickup.php", true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var params = "id=" + pickuporderid + "&pumessage=" + pickupmessage + "&pusalesrepemail=" + pickupsalesrepemail + "&pucustomeremail=" + pickupcustomeremail + "&puperson=" + pickupperson + "&pucustomername=" + pickupcustomername;
    http.send(params);
    http.onload = function() {
		document.getElementById("response3").innerHTML = http.responseText;
    }
	}
}
</script>

<script>
function selfDropUpdate() {
	var selfdroporderid = document.forms["selfDropForm"]["selfdroporderid"].value;
	var selfdropmessage = document.forms["selfDropForm"]["selfdropmessage"].value;
	var selfdropcustomeremail = document.forms["selfDropForm"]["selfdropcustomeremail"].value;
	var selfdropsalesrepemail = document.forms["selfDropForm"]["selfdropsalesrepemail"].value;
	var selfdropperson = document.forms["selfDropForm"]["selfdropperson"].value;
	var selfdropcustomername = document.forms["selfDropForm"]["selfdropcustomername"].value;
    if (selfdropperson == "" || selfdropmessage == "") {
        document.getElementById("response4").innerHTML = "Missing Dropped by Person Name or Message";
        return false;
    }
	else { 
	document.getElementById("response4").innerHTML = "Saving Self Drop Update...";
        var http = new XMLHttpRequest();
    http.open("POST", "ajaxsaveselfdrop.php", true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var params = "id=" + selfdroporderid + "&sdmessage=" + selfdropmessage + "&sdsalesrepemail=" + selfdropsalesrepemail + "&sdcustomeremail=" + selfdropcustomeremail + "&sdperson=" + selfdropperson + "&sdcustomername=" + selfdropcustomername;
    http.send(params);
    http.onload = function() {
		document.getElementById("response4").innerHTML = http.responseText;
    }
	}
}
</script>
</head>
<body>
<?php include('header.php'); ?>
<div class="container">
<div class="two-col-left" style="width: 47%;">
<p id="loading-text"></p>
<table>
    <tr class="header">
        <td>Order<br>ID</td>
		<td>Sales Person</td>
		<td>Company Name and Product(s)</td>
		<td>Order Date</td> 
        <!--<td>Delivery Date</td> -->
        <td>Delivery</td> 		
		<td></td>
        
    </tr>
	<?php
		include 'db_config.php';
		
		$i = 0;
		$person_name= $_GET['person'];
		$search_type= $_GET['searchtype'];
		$order_id= $_GET['id'];
		$company= $_GET['company_name'];
		$customer= $_GET['customer_name'];
		$customer_type= $_GET['customer_type'];
		$product= $_GET['product'];
		$status= $_GET['status'];
		$capacity= $_GET['capacity'];
		$cust_id = $_GET['custid'];
		if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
          $startrow = 0;
        } else {
          $startrow = (int)$_GET['startrow'];
        }
		
		if($person_name== "all"){
			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		}
		elseif($search_type== "idsearch"){
         if($access_level == "sales")	{
            $results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE orders.Order_ID =  '$order_id' AND orders.Sales_Rep_Email = '$login_session' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100"); 			 
		 }	else{		
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE orders.Order_ID =  '$order_id' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		 }
		}
		elseif($search_type== "companysearch"){	
          if($access_level == "sales")	{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(customers.customer_companyname) LIKE  lower('%$company%') AND orders.Sales_Rep_Email = '$login_session' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100"); 
		  }	else{	
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(customers.customer_companyname) LIKE  lower('%$company%') ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		  }
		}
		elseif($search_type== "customersearch"){
         if($access_level == "sales")	{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(customers.customer_name) LIKE  lower('%$customer%') AND orders.Sales_Rep_Email = '$login_session' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		 }else{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(customers.customer_name) LIKE  lower('%$customer%') ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		 }
		}
		elseif($search_type== "customertypesearch"){
         if($access_level == "sales")	{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(customers.customer_type) LIKE  lower('%$customer_type%') AND orders.Sales_Rep_Email = '$login_session' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100"); 
		 }else{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(customers.customer_type) LIKE  lower('%$customer_type%') ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		 }
		}
		elseif($search_type== "statussearch"){
         if($access_level == "sales")	{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(orders.Order_Status) =  lower('$status') AND orders.Sales_Rep_Email = '$login_session' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100"); 
		 }else{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(orders.Order_Status) =  lower('$status') ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		 }
		}
		elseif($search_type== "productsearch"){	
         if($access_level == "sales")	{ 
		    $results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(orders.Product_Name1) LIKE  lower('%$product%') AND orders.Sales_Rep_Email = '$login_session' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		 }	else{	
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(orders.Product_Name1) LIKE  lower('%$product%') ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		 }
		}
		elseif($search_type== "capacitysearch"){	
         if($access_level == "sales")	{ 
		    $results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(orders.Product_Capacity1) =  lower('$capacity') AND orders.Sales_Rep_Email = '$login_session' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		 }	else{	
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(orders.Product_Capacity1) =  lower('$capacity') ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		 }
		}
		elseif($search_type== "customeridsearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE customers.customer_id = '$cust_id' AND orders.Sales_Rep_Email = '$login_session' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");				   		   			
		} else	{								
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE customers.customer_id = '$cust_id' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");			   			
		}						
		}
		else{			
	     $results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(orders.Sales_Rep_Email) =  '$person_name' ORDER BY orders.Order_Date DESC LIMIT $startrow, 100");
		}
		$results2 = $db->query("SELECT FOUND_ROWS() AS count");
		while($row = $results->fetch_assoc())
		{
			while($row2 = $results2->fetch_assoc()){
				$count = $row2['count'];
			}
			$i = $i+1;
			$delivery_received = $row["Delivery_Received"];
			$order_status = $row["Order_Status"];
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
			}
            $url= "http://track.aftership.com/".$row["Courier"]."/".$row["Track_No"];
			$delvi_date = new DateTime($row["Delivery_Date"]);
            $order_date = new DateTime($row["Order_Date"]);			
            /*if($order_status == "open"){			
			$del_date = strtotime($delvi_date->format('d-m-Y'));
			date_default_timezone_set('Asia/Kolkata'); 
	        $today = strtotime(date('d-m-Y'));
			$diff=$del_date-$today;
			$days = 0;
			$days=floor($diff/(60*60*24));	
			}	*/			
            if($i === 1)
          { $last_order_id= $row["Order_ID"];  }
        		
?>

    <tr <?php if($order_status == "cancel"){ echo 'style="background: #EF9A9A;"'; } elseif($order_status == "completed") { echo 'style="background: #CCFF90;"'; } ?>>
	    
	    <td><b><?php echo $row["Order_ID"]; if($delivery_received == 1) { echo'<img src="images/check.png" title="Customer marked as received with feedback('.$row["Feedback"].')"'; } ?></b></td>
		<td><?php echo substr($row["Sales_Rep_Email"], 0, strpos($row["Sales_Rep_Email"], '@'));?></td> 
        <td><b><?php echo $row["customer_companyname"]; ?></b><br><?php echo $row["Product_Name1"]; if($productname2 != ""){ echo "&ensp;<span class='lead_count'>+".$a." more</span>"; }?></td>
		<td class="date"><?php echo $order_date->format('d-M-y h:i A') ?></td>                      
		<td><?php if(trim($row["Track_No"]) == "Self_Pickup") { echo "Pickup by ".$row["Courier"]; } elseif(trim($row["Track_No"]) == "Self_Drop") { echo "Dropped by ".$row["Courier"]; } else { ?><a href="<?php echo $url; ?>" title="Click to Track" target="_blank"><?php echo $row["Track_No"]; } ?></a></td>
		<td><form><button name="users" value="<?php echo $row["Order_ID"] ?>" type="button" onclick="showUser(this.value)"><i class="fas fa-eye"></i></button></form></td> 
    	
    </tr>

	<?php 
	}
	//now this is the link..
if($count>100){ 
$url=$_SERVER['REQUEST_URI'];
$parameter="startrow";

function change_url_parameter($url,$parameter,$parameterValue)
{
    $url=parse_url($url);
    parse_str($url["query"],$parameters);
    unset($parameters[$parameter]);
    $parameters[$parameter]=$parameterValue;
    return  $url["path"]."?".http_build_query($parameters);
}
echo '<a class="red-button-2" href="'.change_url_parameter($url,$parameter,$startrow+100).'">Next 100</a>';
$prev = $startrow - 100;

//only print a "Previous" link if a "Next" was clicked
if ($prev >= 0)
	echo '<a class="red-button-2" href="'.change_url_parameter($url,$parameter,$startrow-100).'">Previous 100</a>';
}
	
	?>
    <p class="count-text">Total Records Found: <?php echo $count; ?></p>
</table>
</div>

<div class="two-col-right-2" id="txtHint" >

<?php
$order_id=$_GET['id'];

if(isset($_GET['id']) && !empty($_GET['id'])){
 if($access_level == "sales")	{ 	
$results= $db->query("SELECT customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE orders.Sales_Rep_Email = '$login_session' AND orders.Order_ID='".$_GET['id']."'");
 } else{
	$results= $db->query("SELECT customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE orders.Order_ID='".$_GET['id']."'"); 
 }
} else{
	if($access_level == "sales")	{ 	
$results= $db->query("SELECT customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE orders.Sales_Rep_Email = '$login_session' AND orders.Order_ID='$last_order_id'");
 }else{
$results= $db->query("SELECT customers.*, orders.* FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE orders.Order_ID='$last_order_id'");
}
}
while($row = $results->fetch_assoc()){
	$delivery_date = new DateTime($row["Delivery_Date"]);
	$ord_date = new DateTime($row["Order_Date"]);
	$order_status = $row["Order_Status"];
	$productname2 = trim($row["Product_Name2"]);
	$productname3 = trim($row["Product_Name3"]);
	$productname4 = trim($row["Product_Name4"]);
	$productname5 = trim($row["Product_Name5"]);
	$shipping_method = 	trim($row["Shipping_Method"]);
	$thirdparty_address = trim($row["ThirdParty_Address"]);
	if($order_status == "cancel"){ echo '<label class="trackid-label">Order Cancelled !</label>'; } 
	elseif($order_status == "completed"){ echo '<label class="trackid-label">Order Completed !</label>'; } 
	else{
    if($access_level !="production"){ 
    echo '<a href="editorder.php?id='.$row['Order_ID'].'&custid='.$row['customer_id'].'" title="Revise This Order"><i class="icon-button fas fa-pencil-alt"></i></a>
	      <a href="cancelorder.php?id='.$row['Order_ID'].'" title="Cancel This Order"><i class="icon-button fas fa-times"></i></a>'; }
	if($access_level =="production"){ 
	echo'<a href="completeorder.php?id='.$row['Order_ID'].'&custid='.$row['customer_id'].'&amount='.$row['Grand_Total'].'" title="Mark As Order Completed"><i class="icon-button fas fa-check"></i></a>'; }
    /*echo'<a href="completeorder.php?id='.$row['Order_ID'].'" title="Mark As Order Completed"><i class="icon-button fas fa-check"></i></a>
	     <a href="addtopriority.php?id='.$row['Order_ID'].'" title="Set Order Priority"><i class="icon-button fas fa-star"></i></a>'; }*/
	} ?>
	<table>
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
	<td><?php echo $row["Product_Name1"] ?></td>
	<td><?php echo $row["Product_Capacity1"] ?></td>
	<td><?php echo $row["Product_Code1"] ?></td>
	<td><?php echo $row["Quantity1"] ?></td>
	<td>Rs. <?php echo $row["Price_per_pc1"] ?></td>
	<td><?php echo $row["GST_Percentage1"] ?>%</td>
	<td>Rs. <?php echo $row["Total_Amount1"] ?></td>
	</tr>
	<?php if($productname2 != "") {?>
	<tr>
	<td><?php echo $row["Product_Name2"] ?></td>
	<td><?php echo $row["Product_Capacity2"] ?></td>
	<td><?php echo $row["Product_Code2"] ?></td>
	<td><?php echo $row["Quantity2"] ?></td>
	<td>Rs. <?php echo $row["Price_per_pc2"] ?></td>
	<td><?php echo $row["GST_Percentage2"] ?>%</td>
	<td>Rs. <?php echo $row["Total_Amount2"] ?></td>
	</tr><?php } ?>
	<?php if($productname3 != "") {?>
	<tr>
	<td><?php echo $row["Product_Name3"] ?></td>
	<td><?php echo $row["Product_Capacity3"] ?></td>
	<td><?php echo $row["Product_Code3"] ?></td>
	<td><?php echo $row["Quantity3"] ?></td>
	<td>Rs. <?php echo $row["Price_per_pc3"] ?></td>
	<td><?php echo $row["GST_Percentage3"] ?>%</td>
	<td>Rs. <?php echo $row["Total_Amount3"] ?></td>
	</tr><?php } ?>
	<?php if($productname4 != "") {?>
	<tr>
	<td><?php echo $row["Product_Name4"] ?></td>
	<td><?php echo $row["Product_Capacity4"] ?></td>
	<td><?php echo $row["Product_Code4"] ?></td>
	<td><?php echo $row["Quantity4"] ?></td>
	<td>Rs. <?php echo $row["Price_per_pc4"] ?></td>
	<td><?php echo $row["GST_Percentage4"] ?>%</td>
	<td>Rs. <?php echo $row["Total_Amount4"] ?></td>
	</tr><?php } ?>
	<?php if($productname5 != "") {?>
	<tr>
	<td><?php echo $row["Product_Name5"] ?></td>
	<td><?php echo $row["Product_Capacity5"] ?></td>
	<td><?php echo $row["Product_Code5"] ?></td>
	<td><?php echo $row["Quantity5"] ?></td>
	<td>Rs. <?php echo $row["Price_per_pc5"] ?></td>
	<td><?php echo $row["GST_Percentage5"] ?>%</td>
	<td>Rs. <?php echo $row["Total_Amount5"] ?></td>
	</tr><?php } ?>
	</tbody>
	</table>
	<div class="col-form-11">
<p>Grand Total : <em>Rs. <?php echo $row["Grand_Total"] ?></em></p>
<p>Order ID :  <em><?php echo $row["Order_ID"] ?></em></p>
<p>Sales Person : <em><?php echo substr($row["Sales_Rep_Email"], 0, strpos($row["Sales_Rep_Email"], '@')) ?></em></p>
<p>Order Description : <em><?php echo $row["Order_Description"] ?></em></p>
<p>Branding : <em><?php echo $row["Branding_Type"] ?></em></p>
<p>Packaging : <em><?php echo $row["Packaging"] ?></em></p>
<p>Payment Term : <em><?php echo $row["Payment_Term"] ?></em></p>
<p>Logo Name : <em><?php echo $row["Logo_Name"] ?></em></p>
<p>Order Date : <em><?php echo $ord_date->format('d-M-Y') ?></em></p>
<p>Delivery Date : <em><?php echo $delivery_date->format('d-M-Y') ?></em></p>
<p>Shipping Method : <em><?php echo $row["Shipping_Method"] ?></em></p>
<p>Tracking No : <em><?php echo $row["Track_No"] ?></em></p>
<p>Courier : <em><?php echo $row["Courier"] ?></em></p>
<?php if($access_level == "production"){
if($shipping_method == "courier_ship" || $shipping_method == "courier_thirdparty"){ ?>
<!-- Courier Dispatch Form -->
<form class="track-form" name="trackForm" onsubmit="saveTrackid(); return false;">
<h3 class="subtitle-text">Courier Dispatch</h3>
<label class="trackid-label">Tracking No :</label>
<input type="text" value="<?php echo $row["customer_name"]?>" hidden="true" name="customername" >
<input type="text" value="<?php echo $row["customer_companyname"]?>" hidden="true" name="companyname" >
<input type="text" value="<?php echo $row["customer_email1"]?>" hidden="true" name="customeremail" >
<input type="text" value="<?php echo $row["Sales_Rep_Email"]?>" hidden="true" name="salesrepemail" >
<?php  if($thirdparty_address != "") { ?>
<input type="text" value="<?php echo $thirdparty_address; ?>" hidden="true" name="shipaddress" >
<?php } else { ?>
<input type="text" value="<?php echo $row["customer_shipaddress"]?>" hidden="true" name="shipaddress"  <?php } ?>
<input type="text" value="<?php echo $row["Order_ID"]?>" hidden="true" name="orderid" >
<input class="trackid-text" type="text" value="<?php echo $row["Track_No"]?>" name="trackno">
<label class="trackid-label">Courier Service :</label>
<select class="trackid-select" name="courier">
<?php $option= $row["Courier"]; ?>
<option value=""></option>
<option value="shreetirupati" <?php if($option=="shreetirupati") echo 'selected="selected"'; ?>>Tirupati</option>
<option value="bluedart" <?php if($option=="bluedart") echo 'selected="selected"'; ?>>Blue Dart</option>
</select>
<label class="trackid-label">Message for Customer :</label>
<textarea name="message" rows="3" class="trackid-text"></textarea>
<button class="red-button-2" type="submit">Send to Customer</button>
<label id="response" class="required-label"></label>
</form>
<!-- Courier Dispatch Form -->
<?php } elseif($shipping_method == "self_pickup"){ ?>
<!-- Self Pickup Form -->
<form class="track-form" name="pickUpForm" onsubmit="pickUpUpdate(); return false;">
<h3 class="subtitle-text">Self Pickup</h3>
<input type="text" value="<?php echo $row["Order_ID"]?>" hidden="true" name="pickuporderid" >
<input type="text" value="<?php echo $row["customer_email1"]?>" hidden="true" name="pickupcustomeremail" >
<input type="text" value="<?php echo $row["Sales_Rep_Email"]?>" hidden="true" name="pickupsalesrepemail" >
<input type="text" value="<?php echo $row["customer_name"]?>" hidden="true" name="pickupcustomername" >
<label class="trackid-label">Picked up by :</label>
<input type="text" value="<?php echo $row["Courier"]?>" class="trackid-text" name="pickupperson" placeholder="Person Name">
<label class="trackid-label">Message for Customer :</label>
<textarea name="pickupmessage" rows="3" class="trackid-text"></textarea>
<button class="red-button-2" type="submit">Send to Customer</button>
<label id="response3" class="required-label"></label>
</form>
<!-- Self Pickup Form -->
<?php } elseif($shipping_method == "self_drop"){ ?>
<!-- Self Drop Form -->
<form class="track-form" name="selfDropForm" onsubmit="selfDropUpdate(); return false;">
<h3 class="subtitle-text">Self Drop</h3>
<input type="text" value="<?php echo $row["Order_ID"]?>" hidden="true" name="selfdroporderid" >
<input type="text" value="<?php echo $row["customer_email1"]?>" hidden="true" name="selfdropcustomeremail" >
<input type="text" value="<?php echo $row["Sales_Rep_Email"]?>" hidden="true" name="selfdropsalesrepemail" >
<input type="text" value="<?php echo $row["customer_name"]?>" hidden="true" name="selfdropcustomername" >
<label class="trackid-label">Dropped by :</label>
<input type="text" value="<?php echo $row["Courier"]?>" class="trackid-text" name="selfdropperson" placeholder="Person Name">
<label class="trackid-label">Message for Customer :</label>
<textarea name="selfdropmessage" rows="3" class="trackid-text"></textarea>
<button class="red-button-2" type="submit">Send to Customer</button>
<label id="response4" class="required-label"></label>
</form><?php } } ?>
</div>

<div class="col-form-11" style="float: right; margin-right: 0;">
<p>Customer Type : <em><?php echo $row["customer_type"] ?></em></p>
<p>Company Name : <em><?php echo $row["customer_companyname"] ?></em></p>
<p>Customer Name : <em><?php echo $row["customer_name"] ?></em></p>
<p>GST No : <em><?php echo $row["customer_gstno"] ?></em></p>
<p>Contact No : <em><?php echo $row["customer_contactno1"] ?></em></p>
<p>Telephone : <em><?php echo $row["customer_contactno2"] ?></em></p>
<p>Email : <em><?php echo $row["customer_email1"] ?></em></p>
<p>Email 2 : <em><?php echo $row["customer_email2"] ?></em></p>
<?php if($shipping_method == "courier_ship"){ ?>
<p>Shipping Address : <em><?php echo $row["customer_shipaddress"] ?></em></p>
<p>Shipping City : <em><?php echo $row["customer_shipcity"] ?></em></p>
<p>Shipping Pin Code : <em><?php echo $row["customer_shipzip"] ?></em></p>
<?php } elseif($shipping_method == "courier_thirdparty") { ?>
<p>Shipping Address : <em><?php echo $thirdparty_address; ?></em></p>
<?php } ?>
<p>Billing Address : <em><?php echo $row["customer_billaddress"] ?></em></p>
<?php 
$pic1 = $row["Artwork1"];
$pic2 = $row["Artwork2"];
$pic3 = $row["Artwork3"];
if(trim($pic1) != ""){
	$link1= "https://crm2308.customshape.in/artworks/".rawurlencode($pic1);
	echo '<p>Artwork 1 : <a href='.$link1.' target="_blank"><button>Download ('.$row["Artwork_Comment1"].')</button></a></p>';
} 
if(trim($pic2) != ""){
	$link2= "https://crm2308.customshape.in/artworks/".rawurlencode($pic2);
	echo '<p>Artwork 2 : <a href='.$link2.' target="_blank"><button>Download ('.$row["Artwork_Comment2"].')</button></a></p>';
}
if(trim($pic3) != ""){
	$link3= "https://crm2308.customshape.in/artworks/".rawurlencode($pic3);
	echo '<p>Artwork 3 : <a href='.$link3.' target="_blank"><button>Download ('.$row["Artwork_Comment3"].')</button></a></p>';
} ?>
<div class="order-log">
<p id="response2"></p>
<?php echo $row["Order_Log"]; ?>
</div>

<form style="margin-top: 0;" class="track-form" name="orderUpdateForm" onsubmit="saveOrderUpdate(); return false;">
<input type="text" value="<?php echo $row["Order_ID"]?>" hidden="true" name="orderupdateid" >
<input type="text" value="<?php echo $row["Sales_Rep_Email"]?>" hidden="true" name="ousalesrepemail" >
<label class="trackid-label">Enter Order Update :</label>
<textarea name="order-update" rows="3" id="order-update" class="trackid-text"></textarea>
<button class="red-button-2" type="submit">Submit</button>
</form>
</div>

<?php } ?>
</div>
</div>

</body>
</html>