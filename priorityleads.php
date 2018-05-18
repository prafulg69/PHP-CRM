<?php   include('session.php');  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>My Priority Leads</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
</head>
<body>
<?php include('header.php'); ?>
<div class="container">
<table>
    <tr class="header">
		<td>Company</td>
        <td>Customer Info</td>    
		<td>Quantity</td>					
		<td>Value</td>
		<td>Interested in</td>
        <td>Lead Status</td>
		<td>Date Created</td>		
		<td>Last Action Date</td>		
		<td>Options</td>
        
    </tr>
	<?php        	   	   
	include 'db_config.php';		   	   
	//fetch products from the database	
		if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {          
		$startrow = 0;        
		} else {          
		$startrow = (int)$_GET['startrow'];       
		}		
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM leads WHERE priority_level > 0 AND lead_owner =  '$login_session' ORDER BY priority_level DESC LIMIT $startrow, 100");
		
		$results2 = $db->query("SELECT FOUND_ROWS() AS count");
		while($row = $results->fetch_assoc())
		{
			while($row2 = $results2->fetch_assoc()){				
			$count = $row2['count'];			}
			$date = new DateTime($row["full_date"]);  
            $action_date = new DateTime($row["last_action_date"]); 	            						
			$customer_type = $row["customer_type"];
            $lead_closed = $row["lead_closed"];
            $priority_level = $row["priority_level"];			
?>

    <tr <?php if($priority_level == 1){ echo 'style="background: #FFF59D;"'; } elseif($priority_level == 2) { echo 'style="background: #EF9A9A;"';}?>>
	 
		<td><?php if($customer_type == "Reseller"){ ?><img style="vertical-align: middle;" src="images/R-icon.png" title="Reseller">&nbsp;<?php } elseif($customer_type == "Direct"){ ?><img style="vertical-align: middle;" src="images/D-icon.png" title="Direct">&nbsp;<?php } echo $row["company_name"]?></td> 
        <td class="options"><?php echo $row["full_name"]?><br><?php echo $row["mobile"]?><br><?php echo $row["email1"]?></td> 
		<td><?php echo $row["required_qty"]?></td>					
		<td><?php echo $row["order_value"]?></td>
        <td><?php echo $row["interested_in"]?></td>							
		<td><?php echo $row["lead_status"]?></td>
        <td class="date"><?php echo $date->format('d-M-y H:i') ?></td>  		
		<td class="date"><p title="<?php echo $row["lead_remark"]?>"><?php echo $action_date->format('d-M-y H:i') ?></p></td>     
        <td class="tbl-dropdown"><form action="editlead.php" method="GET">
	    <input type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden="true" name="url">
	    <input type="text" value="<?php echo $row["lead_id"]?>" hidden="true" name="id">
		<select name="action" onchange="this.form.submit()"><option value=""></option><option value="priority">Set Priority</option><option value="send_quote">Send Quote</option><option value="edit">View / Edit</option><option value="convert">Convert Lead</option></select></form></td>    
     		
    </tr>

	<?php	
	}	
	if($count>100){ 
	$url=$_SERVER['REQUEST_URI'];
	$parameter="startrow";
	function change_url_parameter($url,$parameter,$parameterValue){    
	$url=parse_url($url);    
	parse_str($url["query"],$parameters);    
	unset($parameters[$parameter]);    
	$parameters[$parameter]=$parameterValue;    
	return  $url["path"]."?".http_build_query($parameters);
	}
	echo '<button class="nav-btn"><a href="'.change_url_parameter($url,$parameter,$startrow+100).'">Next 100</a></button>';$prev = $startrow - 100;
	if ($prev >= 0)	echo '<button class="nav-btn"><a href="'.change_url_parameter($url,$parameter,$startrow-100).'">Previous 100</a></button>';
	}
	?>
    <p>Total Records Found: <?php echo $count; ?></p>
</table>
<h3 class="footer">By Shujaat Shaikh</h3>
</div>
</body>
</html>