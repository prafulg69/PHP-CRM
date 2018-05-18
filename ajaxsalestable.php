<?php
		//fetch products from the database
  
 
function getAllCount()
{
    include 'db_config.php';
	$todaydate= date("Y-m-d");
	  $a= 0;
   	
     $result = $db->query("SELECT Grand_Total FROM `orders`"); 
    while($row = $result->fetch_assoc()) { 
    $a = intval($row["Grand_Total"])+$a;
    }
  echo $a ;
}

function getCount($campaign_name)
{
    include 'db_config.php';
   	$todaydate= date("Y-m-d");
		  $a= 0;
     $result = $db->query("SELECT Grand_Total FROM `orders` WHERE lower(`Sales_Rep_Email`) = lower('$campaign_name')"); 
    while($row = $result->fetch_assoc()) { 
    $a = intval($row["Grand_Total"])+$a;
    }
  echo $a ;
}
			
?>