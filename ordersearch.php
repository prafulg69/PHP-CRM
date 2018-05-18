<?php
   include('session.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>IOT Orders Search</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
</head>

<body>
<?php include('header.php'); ?>
<div class="container">

<!-- Orders Search Div -->
<div class="col-form-3" id="goal">
<h1 class="title-text">Orders Search</h1>
<div class="col-form-4">
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
<div class="col-form-4">
Search by Customer Type:
<form action="ordertable.php?search=searchtype&customer_type=customer_type" method="GET">
<input type="text" name="searchtype" value="customertypesearch" hidden="true">
<select name="customer_type"  >
<option selected="selected" value="Reseller">Reseller</option>
<option value="Direct">Direct</option>
</select>
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4">
Search by Product Ordered:
<form action="ordertable.php?search=searchtype&product=product" method="GET">
<input type="text" name="searchtype" value="productsearch" hidden="true">
<input class="box-input" type="text" value="" name="product" placeholder="Product Name" required >
<input class="red-button-2" type="submit" value="Search" >
</form>
</div>
<div class="col-form-4">
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
</div>
</body>
</html>