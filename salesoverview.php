<html>
<head>
<title>Sales Overview</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>    
<script type="text/javascript">      
google.charts.load('current', {'packages':['corechart']});      
google.charts.setOnLoadCallback(drawChart);      
function drawChart() {        
var data = google.visualization.arrayToDataTable([          
['Capacity', 'No. of Orders'],          
['4GB',    <?php $capacity="4gb"; getCapacityAmount($capacity); ?>],          
['8GB',  <?php $capacity="8gb"; getCapacityAmount($capacity); ?>],
['16GB',  <?php $capacity="16gb"; getCapacityAmount($capacity); ?>],
['32GB',  <?php $capacity="32gb"; getCapacityAmount($capacity); ?>],
['64GB',  <?php $capacity="64gb"; getCapacityAmount($capacity); ?>]]);        
var chart = new google.visualization.PieChart(document.getElementById('piechart'));       
var options = {          
is3D: true,        
};        
chart.draw(data, options);      
}   
 </script>		  		  
 <?php		 

function getCapacityAmount($cap){			 
 include 'db_config.php';	  
 $i= 0;	
$days = $_GET['days'];	  
 $result = $db->query("SELECT Order_ID FROM `orders` WHERE lower(Product_Capacity1) = lower('$cap') AND Order_Date >= ( CURDATE() - INTERVAL $days DAY )");     
 while($row = $result->fetch_assoc()) {     
 //$b = intval($row["Grand_Total"])+$b; 
$i = $i+1 ; 
 }		  
 echo $i ; 
 } 
 ?>
</head>
<body>
<?php include('header.php'); ?>
<div class="container">
<div>
<div class="col-form-9">
<h1 class="title-text">Sales Overview <span>(Last <?php echo $_GET['days']; ?> days)</span></h1>
</div>
<div class="col-form-10">
<form action="salesoverview.php" method="GET"><select name="days" onchange="this.form.submit()"><option value="7">Last 7 Days</option><option value="15">Last 15 Days</option><option value="30">Last 30 Days</option><option value="60">Last 60 Days</option><option value="90">Last 90 Days</option></select></form>
</div>
</div>
<div class="col-form-12">
<h3 class="subtitle-text">Person wise Sale</h3>
<table>
  <tr class="header">
    <th>Sales Person</th>
    <th>Sale Amount</th>
	<th>No. of Orders</th>
  </tr>
  <?php
  include 'db_config.php';
  $result= $db->query("SELECT * FROM `Users` WHERE (access_level = 'sales' OR access_level = 'sales_head') AND status = 'active' ORDER BY name ASC");
  while($rows = $result->fetch_assoc()) {?>
  <tr>
    <td><?php echo trim($rows["name"])?></td>
    <td class="count">Rs. <?php $campaign= trim($rows["email"]); getCount($campaign); ?></td>
	<td class="count"><?php getOrders($campaign); ?></td>
  </tr>
<?php	} ?>
 
  <tr>
    <td>Total Sales</td>
    <td class="count">Rs. <?php getAllCount(); ?></td>
	<td class="count"><?php getAllOrders(); ?></td>
  </tr>
</table>
</div>
<div class="col-form-6">
<h3 class="subtitle-text">No. of Orders Capacity wise</h3><div id="piechart" style="width: 700px; height: 400px;"></div>
</div>
</div>
</body>
</html>
<?php
		//fetch products from the database
function getAllCount()
{
    include 'db_config.php';
	  $a= 0;
     $days = $_GET['days'];	
     $result = $db->query("SELECT Grand_Total FROM `orders` WHERE Order_Date >= ( CURDATE() - INTERVAL $days DAY )"); 
    while($row = $result->fetch_assoc()) { 
    $a = intval($row["Grand_Total"])+$a;
    }
  echo $a ;
}
function getCount($campaign_name)
{
    include 'db_config.php';
		  $b= 0;
		  $days = $_GET['days'];	
     $result = $db->query("SELECT Grand_Total FROM `orders` WHERE lower(`Sales_Rep_Email`) = lower('$campaign_name') AND Order_Date >= ( CURDATE() - INTERVAL $days DAY )"); 
    while($row = $result->fetch_assoc()) { 
    $b = intval($row["Grand_Total"])+$b;
    }
  echo $b ;
}
function getAllOrders()
{
    include 'db_config.php';
	  $i = 0;
     $days = $_GET['days'];	
     $result = $db->query("SELECT Order_ID FROM `orders` WHERE Order_Date >= ( CURDATE() - INTERVAL $days DAY )"); 
    while($row = $result->fetch_assoc()) { 
	$i = $i+1;
    }
  echo $i;
}
function getOrders($name)
{
    include 'db_config.php';
	  $j = 0;
     $days = $_GET['days'];	
     $result = $db->query("SELECT Order_ID FROM `orders` WHERE lower(`Sales_Rep_Email`) = lower('$name') AND Order_Date >= ( CURDATE() - INTERVAL $days DAY )"); 
    while($row = $result->fetch_assoc()) { 
	$j = $j+1;
    }
  echo $j;
}
?>