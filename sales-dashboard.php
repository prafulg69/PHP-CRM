<?php
   include('session.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Dashboard</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

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
 include 'session.php'; 
 $i= 0;	
$days = 7;	  
 $result = $db->query("SELECT orders.Order_ID FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE lower(orders.Product_Capacity1) = lower('$cap') AND customers.customer_owner = '$login_session' AND orders.Order_Date >= ( CURDATE() - INTERVAL $days DAY )");     
 while($row = $result->fetch_assoc()) {     
 //$b = intval($row["Grand_Total"])+$b; 
$i = $i+1 ; 
 }		  
 echo $i ; 
 } 
 ?>
</head>

<body style="background: #f9f9f9;">
<?php include('header.php'); ?>
<div class="container">

<h1 class="title-text">Dashboard</h1>
<div class="dashboard-box white-bg">
<h3 class="subtitle-text">Today's Stats</span></h3>
<table>
  <tr class="header">
    <th>Date</th>
    <th>Login Time</th>
	<th>Logged in Hours</th>
	<th>No. of Orders</th>
	<th>Total Sales</th>
  </tr>
<?php
             $onlydate= date("d-M-y");
			 $onlyhours= date("h:i A");
			 $fulldate= date("Y-m-d H:i:s");
			 $today = date('Y-m-d'); 
             $results = $db->query("SELECT login_time from Users WHERE email = '$login_session'"); 
			 while($row = $results->fetch_assoc())
		{
   $dteStart = new DateTime(); 
   $dteEnd   = new DateTime($row["login_time"]);
   $dteDiff  = $dteStart->diff($dteEnd); 
   $interval = $dteDiff->format("%H:%I:%S");						
	
        $grandtotal = 0;
		$count = 0;
		$results2 = $db->query("SELECT orders.Grand_Total, DATE_FORMAT(orders.Order_Date, '%Y-%m-%d') FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE customers.customer_owner = '$login_session' AND DATE(orders.Order_Date) = '$today' ");
			while($row2 = $results2->fetch_assoc())
		{
			$count   = $count+1;
			$grandtotal = intval($row2["Grand_Total"])+$grandtotal;
		}
 $message = '<tr><td>'.$onlydate.'</td><td>'.$dteEnd->format('h:i A').'</td><td>'.$interval.'</td><td>'.$count.'</td><td>Rs. '.$grandtotal.'</td></tr>';
		   echo $message;
			
		}?>
		</table><br><a href="logout.php" title="Log Out" class="red-button-2">Log Out</a><br>
		
		<?php  if ($grandtotal < 25000) {  $stars = 1; displayStars($stars); }  elseif ($grandtotal > 25000 && $grandtotal < 100000) {  $stars = 2; displayStars($stars); } elseif ($grandtotal > 100000 && $grandtotal < 200000) {  $stars = 3; displayStars($stars); } elseif ($grandtotal > 200000 && $grandtotal < 500000) {  $stars = 4; displayStars($stars); } elseif ($grandtotal > 500000) {  $stars = 5; displayStars($stars); }
		
		function displayStars($i){
			$starprint = "<p class='trophy-icon'>";
			
			for($j=1	; $j <=$i; $j++){
			$starprint .= "<i class='fas fa-star'></i>"; 
			}
			$starprint .= "</p>";
			echo $starprint;
		} 
		?>
		<p class="trophy-text">Your Today's Performance</p>
		
</div>

<div class="dashboard-box white-bg">
<h3 class="subtitle-text">No. of Orders Capacity wise&ensp;<span>(Last 7 days)</span></h3><div id="piechart" style="width: 540px; height: 320px;"></div>
</div>

<div class="dashboard-box white-bg">
<h3 class="subtitle-text">Scheduled Follow ups&ensp;<span>(from now to next 5 days)</span></h3>
<table>
    <tr class="header">
		<td>Company</td>
		<td>Client Name</td>
        <td>Contact No</td>    
		<td>Follow-up</td>						
		<td></td> 
    </tr>	
 <?php
		include 'db_config.php';
		$a = 0;
		date_default_timezone_set('Asia/Kolkata');
$results = $db->query("SELECT customers.*, leads.*,DATE_FORMAT(leads.followupon, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id = leads.customer_id WHERE  leads.followup = 'true' AND customers.customer_owner = '$login_session' AND leads.followupon >= DATE(NOW()) AND leads.followupon <= DATE(NOW() + INTERVAL 5 DAY) ORDER BY UNIX_TIMESTAMP(leads.followupon) ASC"); 	
while($row = $results->fetch_assoc()){	
    $a = $a+1;
    $action_date = new DateTime($row["followupon"]); 	?>
    <tr>
	    <td><?php echo $row["customer_companyname"]?></td>
		<td><?php echo $row["customer_name"]?></td>
        <td><?php echo $row["customer_contactno1"]?></td>    
		<td class="date"><?php echo $action_date->format('h:i A d-M-y') ?></td>						
		<td><a href="editlead.php?url=&custid=<?php echo $row["customer_id"] ?>&id=<?php echo $row["lead_id"] ?>&action=edit">Show</a></td> 
	</tr><?php	
	} ?>
</table>
<?php if($a == 0){ echo "<label class='emptyvalue-label'>No Scheduled Follow ups for Next 5 Days</label>";} ?>
</div>

<div class="dashboard-box white-bg">
<h3 class="subtitle-text">Not Answered Leads</h3>
<table>
    <tr class="header">
		<td>Company</td>
		<td>Client Name</td>
        <td>Contact No</td>    
		<td>Last Update</td>						
		<td></td> 
    </tr>	
 <?php
		include 'db_config.php';
		$a = 0;
$results = $db->query("SELECT  customers.*, leads.*,DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id = leads.customer_id WHERE  leads.lead_status = 'no_answer' AND customers.customer_owner = '$login_session' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC"); 	
while($row = $results->fetch_assoc()){	
    $a = $a+1;
    $action_date = new DateTime($row["last_action_date"]); 	?>
    <tr>
	    <td><?php echo $row["customer_companyname"]?></td>
		<td><?php echo $row["customer_name"]?></td>
        <td><?php echo $row["customer_contactno1"]?></td>    
		<td class="date"><?php echo $action_date->format('h:i A d-M-y') ?></td>						
		<td><a href="editlead.php?url=&custid=<?php echo $row["customer_id"] ?>&id=<?php echo $row["lead_id"] ?>&action=edit">Show</a></td> 
	</tr><?php	
	} ?>
</table>
<?php if($a == 0){ echo "<label class='emptyvalue-label'>Great ! We got all leads answered</label>";} ?>
</div>



<!--<div class="dashboard-box">
<h3 class="subtitle-text">Recent Leads&ensp;<span>(Your Last 10 Leads)</span></h3>
<table>
    <tr class="header">
		<td>Company</td>
		<td>Client Name</td>
        <td>Contact No</td> 
        <td>Status</td>			
		<td>Created on</td>						
		<td></td> 
    </tr>	
 <?php
		/*include 'db_config.php';
		$a = 0;
		date_default_timezone_set('Asia/Kolkata');
$results = $db->query("SELECT *,DATE_FORMAT(full_date, '%d %m %Y') FROM leads WHERE lead_owner = '$login_session' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT 10"); 	
while($row = $results->fetch_assoc()){	
    $a = $a+1;
    $create_date = new DateTime($row["full_date"]); 	*/?>
    <tr>
	    <td><?php //echo $row["company_name"]?></td>
		<td><?php //echo $row["full_name"]?></td>
        <td><?php // echo $row["mobile"]?></td>  
        <td><?php // echo $row["lead_status"]?></td>		
		<td class="date"><?php //echo $create_date->format('h:i A d-M-y') ?></td>						
		<td><a href="editlead.php?url=&id=<?php // echo $row["lead_id"] ?>&action=edit">Show</a></td> 
	</tr><?php	
	//} ?>
</table>
<?php // if($a == 0){ echo "<label class='trackid-label'>No Recent Leads</label>";} ?>
</div>-->

<div class="dashboard-box white-bg">
<h3 class="subtitle-text">Inactive Leads</span></h3>
<table>
    <tr class="header">
		<td>Company</td>
		<td>Client Name</td>
        <td>Contact No</td>	
		<td>Last Update</td>						
		<td></td> 
    </tr>	
 <?php
		include 'db_config.php';
		$a = 0;
		date_default_timezone_set('Asia/Kolkata');
$results = $db->query("SELECT customers.*, leads.*,DATE_FORMAT(leads.last_action_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id = leads.customer_id WHERE customers.customer_owner  = '$login_session' AND leads.lead_status = 'contacted' AND leads.last_action_date <= DATE_SUB(SYSDATE(), INTERVAL 7 DAY) ORDER BY UNIX_TIMESTAMP(leads.last_action_date) ASC"); 	
while($row = $results->fetch_assoc()){	
    $a = $a+1;
    $last_date = new DateTime($row["last_action_date"]); 		
    $del_date = strtotime($last_date->format('d-m-Y'));
	$today = strtotime(date('d-m-Y'));
	$diff=$today-$del_date;
	$days = 0;
	$days=floor($diff/(60*60*24));		?>
    <tr>
	    <td><?php echo $row["customer_companyname"]?></td>
		<td><?php echo $row["customer_name"]?></td>
        <td><?php echo $row["customer_contactno1"]?></td>
		<td class="date"><?php echo $last_date->format('d-M-y') ?></td>						
		<td><a href="editlead.php?url=&custid=<?php echo $row["customer_id"] ?>&id=<?php echo $row["lead_id"] ?>&action=edit"><?php echo $days; ?> days ago</a></td> 
	</tr><?php	
	} ?>
</table>
<?php if($a == 0){ echo "<label class='emptyvalue-label'>Good Going ! Nothing here...</label>";} ?>
</div>
</div>
</body>
</html>