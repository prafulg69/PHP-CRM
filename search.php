<?php
   include('session.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Search Inquiries, Leads, Orders</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
</head>

<body>
<?php include('header.php'); ?>
<div class="container">
<!-- Enquiry Search Div -->
<?php if($access_level !="production"){ ?>
<div class="col-form-3" id="enquiry-search">
<h1 class="title-text">Enquiry Search</h1>
<div class="col-form-4 height110">
Search by Source:
<form action="test.php?campaign=campaign" method="GET">
<select name="campaign"  >
<option selected="selected" value="all">All Inquiries</option>
<?php
  include 'db_config.php';
  $result= $db->query("SELECT DISTINCT(campaign) FROM `enquiries` ORDER BY campaign ASC");
  while($rows = $result->fetch_assoc()) {?>
 <option value="<?php echo trim($rows["campaign"])?>"><?php echo trim($rows["campaign"])?></option>
<?php	} ?>
</select>
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110">
Search by Date:
<form action="test.php?date=selecteddate&search=searchtype" method="GET">
<input type="text" name="searchtype" value="datesearch" hidden="true">
<input type="date" name="selecteddate" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?>" >
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110">
Search Inquiry which contain words :
<form action="test.php?search=searchtype&word=word" method="GET">
<input type="text" name="searchtype" value="wordsearch" hidden="true">
<input class="box-input" type="text" value="" name="word" placeholder="Words" required >
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110">
<form action="test.php?search=searchtype&customer=customer" method="GET">
<input type="text" name="searchtype" value="customersearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="customer" placeholder="Customer Name" required >
<input type="submit" value="Search" >
</form>
<form action="test.php?search=searchtype&company=company" method="GET" style="margin-top:3px;">
<input type="text" name="searchtype" value="companysearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="company" placeholder="Company Name" required>
<input type="submit" value="Search" >
</form>
<form action="test.php?search=searchtype&contact=contact" method="GET" style="margin-top:3px;">
<input type="text" name="searchtype" value="contactsearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="contact" placeholder="Contact No" required>
<input type="submit" value="Search" >
</form>
<form action="test.php?search=searchtype&email=email" method="GET" style="margin-top:3px;">
<input type="text" name="searchtype" value="emailsearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="email" placeholder="Email" required>
<input type="submit" value="Search" >
</form>
</div>
</div>
<!-- Enquiry Search Div -->

<!-- Customers Search Div -->
<div class="col-form-3" id="customer-search">
<h1 class="title-text">Customer Search</h1>

<?php if($access_level =="sales_head"){ ?>
<div class="col-form-4 height110">
Search by Customer Owner:
<form action="customerstable.php?person=person" method="GET">
<select name="person"  >
<option selected="selected" value="all">All Customers</option>
<?php
  include 'db_config.php';
  $result= $db->query("SELECT * FROM `Users` WHERE access_level = 'sales' OR access_level = 'sales_head' ORDER BY name ASC");
  while($rows = $result->fetch_assoc()) {?>
 <option value="<?php echo trim($rows["email"])?>"><?php echo trim($rows["name"])?></option>
<?php	} ?>
</select>
<input class="red-button-2" type="submit" value="Search">
</form>
</div><?php } ?>
<div class="col-form-4 height110" >
Search by Company Name:
<form action="customerstable.php?search=searchtype&company=company" method="GET">
<input type="text" name="searchtype" value="companysearch" hidden="true">
<input class="box-input" type="text" value="" name="company" required>
<input class="red-button-2"  type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110" >
Search by Customer Name:
<form action="customerstable.php?search=searchtype&customer=customer" method="GET">
<input type="text" name="searchtype" value="customersearch" hidden="true">
<input class="box-input" type="text" value="" name="customer" required >
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110">
Search by Contact Details:
<form action="customerstable.php?search=searchtype&contact=contact" method="GET" style="margin-top:3px;">
<input type="text" name="searchtype" value="contactsearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="contact" placeholder="Contact No" required>
<input type="submit" value="Search" >
</form>
<form action="customerstable.php?search=searchtype&email=email" method="GET" style="margin-top:3px;">
<input type="text" name="searchtype" value="emailsearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="email" placeholder="Email" required>
<input type="submit" value="Search" >
</form>
</div>
</div>
<!-- Customers Search Div -->

<!-- Leads Search Div -->
<div class="col-form-3" id="lead-search">
<h1 class="title-text">Leads Search</h1>
<div class="scrolling-col" >

<?php if($access_level =="sales_head"){ ?>
<div class="col-form-4 height110" style="flex: 0 0 21%;">
Search by Lead Owner:
<form action="leadstable.php?person=person" method="GET">
<select name="person"  >
<option selected="selected" value="all">All Leads</option>
<?php
  include 'db_config.php';
  $result= $db->query("SELECT * FROM `Users` WHERE access_level = 'sales' OR access_level = 'sales_head' ORDER BY name ASC");
  while($rows = $result->fetch_assoc()) {?>
 <option value="<?php echo trim($rows["email"])?>"><?php echo trim($rows["name"])?></option>
<?php	} ?>
</select>
<input class="red-button-2" type="submit" value="Search">
</form>
</div><?php } ?>
<div class="col-form-4 height110" style="flex: 0 0 21%;">
Search by Lead Status:
<form action="leadstable.php?search=searchtype&lead_status=lead_status" method="GET">
<input type="text" name="searchtype" value="leadstatussearch" hidden="true">
<select name="lead_status">
<option value="contacted" selected>Contacted</option>
<option value="contact_in_future">Contact in Future</option>
<option value="no_answer">Not Answered</option>
<option value="lost">Lost Lead</option>
<option value="dead_lead">Dead Lead</option>
<option value="converted">Converted Lead</option>
</select>
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110" style="flex: 0 0 21%;">
Search by Date:
<form action="leadstable.php?date=selecteddate&search=searchtype" method="GET">
<input type="text" name="searchtype" value="datesearch" hidden="true">
<input type="date" name="selecteddate" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?>" >
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110" style="flex: 0 0 21%;">
Search Leads which contains words:
<form action="leadstable.php?search=searchtype&word=word" method="GET">
<input type="text" name="searchtype" value="wordsearch" hidden="true">
<input class="box-input" type="text" value="" name="word" placeholder="Words" required >
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110" style="flex: 0 0 21%;">
<form action="leadstable.php?search=searchtype&customer=customer" method="GET">
<input type="text" name="searchtype" value="customersearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="customer" placeholder="Customer Name" required >
<input type="submit" value="Search" >
</form>
<form action="leadstable.php?search=searchtype&company=company" method="GET" style="margin-top:3px;">
<input type="text" name="searchtype" value="companysearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="company" placeholder="Company Name" required>
<input type="submit" value="Search" >
</form>
<form action="leadstable.php?search=searchtype&contact=contact" method="GET" style="margin-top:3px;">
<input type="text" name="searchtype" value="contactsearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="contact" placeholder="Contact No" required>
<input type="submit" value="Search" >
</form>
<form action="leadstable.php?search=searchtype&email=email" method="GET" style="margin-top:3px;">
<input type="text" name="searchtype" value="emailsearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="email" placeholder="Email" required>
<input type="submit" value="Search" >
</form>
</div>
</div>
</div>
<!-- Leads Search Div -->
<?php } ?>
<!-- Orders Search Div -->
<div class="col-form-3" id="goal">
<h1 class="title-text">Orders Search</h1>
<?php if($access_level !="sales"){  ?>
<div class="col-form-4 height110">
Search by Sales Representative:
<form action="ordertable.php?person=person" method="GET">
<select name="person"  >
<option selected="selected" value="all">All Orders</option>
<?php
  include 'db_config.php';
  $result= $db->query("SELECT * FROM `Users` WHERE access_level = 'sales' OR access_level = 'sales_head' ORDER BY name ASC");
  while($rows = $result->fetch_assoc()) {?>
 <option value="<?php echo trim($rows["email"])?>"><?php echo trim($rows["name"])?></option>
<?php	} ?>
</select>
<input class="red-button-2" type="submit" value="Search">
</form>
</div>
<?php } ?>
<!--<div class="col-form-4 height110">
Search by Customer Type:
<form action="ordertable.php?search=searchtype&customer_type=customer_type" method="GET">
<input type="text" name="searchtype" value="customertypesearch" hidden="true">
<select name="customer_type"  >
<option selected="selected" value="Reseller">Reseller</option>
<option value="Direct">Direct</option>
</select>
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>-->
<div class="col-form-4 height110">
Search by Product Capacity:
<form action="ordertable.php?search=searchtype&capacity=capacity" method="GET">
<input type="text" name="searchtype" value="capacitysearch" hidden="true">
<select name="capacity"  >
<?php
  include 'db_config.php';
  $result= $db->query("SELECT DISTINCT(`Product_Capacity1`) FROM `orders` ORDER BY `Product_Capacity1` DESC");
  while($rows = $result->fetch_assoc()) {?>
 <option value="<?php echo trim($rows["Product_Capacity1"])?>"><?php echo trim($rows["Product_Capacity1"])?></option>
<?php	} ?>
</select>
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110">
Search by Product Ordered:
<form action="ordertable.php?search=searchtype&product=product" method="GET">
<input type="text" name="searchtype" value="productsearch" hidden="true">
<input class="box-input" type="text" value="" name="product" placeholder="Product Name" required >
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4 height110">
Search Orders by :
<form action="ordertable.php?search=searchtype&id=id" method="GET">
<input type="text" name="searchtype" value="idsearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="id" placeholder="Order ID" required >
<input type="submit" value="Search" >
</form>
<form action="ordertable.php?search=searchtype&company_name=company_name" method="GET" style="margin-top:4px;">
<input type="text" name="searchtype" value="companysearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="company_name" placeholder="Company Name" required>
<input type="submit" value="Search" >
</form>
<form action="ordertable.php?search=searchtype&company_name=company_name" method="GET" style="margin-top:4px;">
<input type="text" name="searchtype" value="customersearch" hidden="true">
<input style="width: 65%;" type="text" value="" name="customer_name" placeholder="Customer Name" required>
<input type="submit" value="Search" >
</form>
</div>
</div>
<!-- Orders Search Div -->

<h3 class="footer">By Shujaat Shaikh</h3>
</div>
</body>
</html>