<html>
<head>
<title>Leads Overview</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">

</head>
<body>
<?php include('header.php'); ?>
<div class="container">
<div>
<div class="col-form-9">
<h1 class="title-text">Leads Overview <span>(Last <?php echo $_GET['days']; ?> days)</span></h1>
</div>
<div class="col-form-10 fl-right">
<form action="leadsoverview.php" method="GET"><select name="days" onchange="this.form.submit()"><option value="7">Last 7 Days</option><option value="15">Last 15 Days</option><option value="30">Last 30 Days</option><option value="60">Last 60 Days</option><option value="90">Last 90 Days</option></select></form>
</div>
</div>
<table>
  <tr class="header">
    <th>Lead Owner</th>
    <th>No. of Leads</th>
	<th>Converted</th>
	<th>LCR</th>
	<th>Lost</th>
	<th>Dead</th>
	<th>Contact in Future</th>
  </tr>
   <?php
  include 'db_config.php';
  $result1= $db->query("SELECT * FROM `Users` WHERE (access_level = 'sales' OR access_level = 'sales_head') AND status = 'active' ORDER BY name ASC");
  while($row1 = $result1->fetch_assoc()) {
   $lead_owner = trim($row1["email"]); ?>
  <tr>
    <td><?php echo $lead_owner; ?></td>
    <td class="count"><?php getOwnerLeads($lead_owner); ?></td>
	<td class="count"><?php $status="converted"; getNoOfLeads($lead_owner, $status); ?></td>
	<td class="count"><?php getLcr($lead_owner); ?>%</td>
	<td class="count"><?php $status="lost"; getNoOfLeads($lead_owner, $status); ?></td>
	<td class="count"><?php $status="dead_lead"; getNoOfLeads($lead_owner, $status); ?></td>
	<td class="count"><?php $status="no_answer"; getNoOfLeads($lead_owner, $status); ?></td>
  </tr>
  <?php	}  ?>
 
  <tr>
    <td>Total Leads</td>
	<td class="count"><?php $lead_own="all"; getOwnerLeads($lead_own); ?></td>
	<td class="count"><?php $lead_own="all"; $status="converted"; getNoOfLeads($lead_own, $status); ?></td>
	<td class="count"><?php $lead_own="all"; getLcr($lead_own); ?>%</td>
	<td class="count"><?php $lead_own="all"; $status="lost"; getNoOfLeads($lead_own, $status); ?></td>
	<td class="count"><?php $lead_own="all"; $status="dead_lead"; getNoOfLeads($lead_own, $status); ?></td>
	<td class="count"><?php $lead_own="all"; $status="no_answer"; getNoOfLeads($lead_own, $status); ?></td>
  </tr>
</table>
</div>
</body>
</html>
<?php
		//fetch products from the database
function getNoOfLeads($lead_own, $stat)
{
    include 'db_config.php';
	  $a= 0;
     $days = $_GET['days'];	
	 if($lead_own == "all"){
      $result = $db->query("SELECT lead_id FROM `leads` WHERE lead_status = '$stat' AND full_date >= ( CURDATE() - INTERVAL $days DAY )"); 
	 } else{
		$result = $db->query("SELECT lead_id FROM `leads` WHERE lead_owner = '$lead_own' AND lead_status = '$stat' AND full_date >= ( CURDATE() - INTERVAL $days DAY )");  
	 }
    while($row = $result->fetch_assoc()) { 
    $a = $a+1;
    }
  echo $a ;
}

function getLcr($lead_ownerr)
{
    include 'db_config.php';
	  $b= 0;
     $days = $_GET['days'];	
	 if($lead_ownerr == "all"){
     $result = $db->query("SELECT lead_id FROM `leads` WHERE lead_status = 'converted' AND full_date >= ( CURDATE() - INTERVAL $days DAY )"); 
	 $result2 = $db->query("SELECT lead_id FROM `leads` WHERE full_date >= ( CURDATE() - INTERVAL $days DAY )");
	  while($row = $result->fetch_assoc()) { 
       $b = $b+1;
      }
	  while($row2 = $result2->fetch_assoc()) { 
       $d = $d+1;
      }
	  $lcr = ($b/$d)*100;
	  echo number_format((float)$lcr, 2, '.', ''); 
	 } else{
	 $result = $db->query("SELECT lead_id FROM `leads` WHERE lead_status = 'converted' AND lead_owner = '$lead_ownerr' AND full_date >= ( CURDATE() - INTERVAL $days DAY )"); 
	 $result2 = $db->query("SELECT lead_id FROM `leads` WHERE lead_owner = '$lead_ownerr' AND full_date >= ( CURDATE() - INTERVAL $days DAY )");
	  while($row = $result->fetch_assoc()) { 
       $b = $b+1;
      }
	  while($row2 = $result2->fetch_assoc()) { 
       $d = $d+1;
      }
	  $lcr = ($b/$d)*100;
	  echo number_format((float)$lcr, 2, '.', ''); 
	 }
   
}

function getOwnerLeads($lead_owne)
{
    include 'db_config.php';
	  $c= 0;
     $days = $_GET['days'];	
	 if($lead_owne == "all"){
     $result = $db->query("SELECT lead_id FROM `leads` WHERE full_date >= ( CURDATE() - INTERVAL $days DAY )"); 
	 } else{
	 $result = $db->query("SELECT lead_id FROM `leads` WHERE lead_owner = '$lead_owne' AND full_date >= ( CURDATE() - INTERVAL $days DAY )");  
	 }
    while($row = $result->fetch_assoc()) { 
    $c = $c+1;
    }
  echo $c ;
}


?>