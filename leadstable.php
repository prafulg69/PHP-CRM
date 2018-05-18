<?php   include('session.php');  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Leads Table</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">

</head>
<body>
<?php include('header.php'); ?>
<div class="container">
<h3 class="subtitle-text" style="margin: 0;">Leads&ensp;Table - <?php echo $_GET['lead_status']; ?></h3>
<table>
    <tr class="header">
	<?php if($access_level == "sales_head")	{ ?>	
	    <td>Lead Owner</td><?php } ?>
		<td>Company</td>
        <td>Contact Info</td>
        <!--<td>Capacity</td>-->		
		<td>Quantity</td>
        <td>Budget</td>		
		<td>Expected Revenue</td>
		<td>Interested in</td>
		<td>Bottom Price</td>
		<td>Status</td>
		<td>Date Created</td>
		<td>Last Action</td>		
		<td>Options</td>
        
    </tr>
	<?php        	   	   
	include 'db_config.php';		   	   
	//fetch products from the database	
		$person_name= $_GET['person'];
		$search_type= $_GET['searchtype'];
		$customer= $_GET['customer'];
		$company= $_GET['company'];						
		$contact= $_GET['contact'];
        $email= $_GET['email'];		
		$word= $_GET['word'];
		$lead_status= $_GET['lead_status'];
		$cust_id = $_GET['custid'];
		$searchmethod = $_GET['search_method'];
		if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {          
		$startrow = 0;        
		} else {          
		$startrow = (int)$_GET['startrow'];       
		}		
		if($person_name== "all"){	          
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");
		}
		elseif($search_type== "leadstatussearch"){           		  
		if($access_level == "sales" || $searchmethod == "menudrop")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE leads.lead_status='$lead_status' AND leads.lead_owner = '$login_session' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");			   		   		  
		} 
		else	{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE leads.lead_status='$lead_status' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");		   		  
			}
		}
		elseif($search_type== "datesearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE DATE(leads.full_date) =  lower('".$_GET['selecteddate']."') AND leads.lead_owner = '$login_session' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");			   		   		  
		} 
		else	{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE DATE(leads.full_date) =  lower('".$_GET['selecteddate']."') ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");		   		  
			}
		}
		elseif($search_type== "customersearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE lower(customers.customer_name) LIKE  lower('%$customer%') AND leads.lead_owner = '$login_session' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");			   		   		  
		} else	{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE lower(customers.customer_name) LIKE  lower('%$customer%')  ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");		   			
			}
		}
		elseif($search_type== "companysearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE lower(customers.customer_companyname) LIKE  lower('%$company%') AND leads.lead_owner = '$login_session' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");			   		   			
		} else	{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE lower(customers.customer_companyname) LIKE  lower('%$company%')  ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");		   			
			}
		}						
		elseif($search_type== "contactsearch"){	          		  
		if($access_level == "sales")	{             		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE (customers.customer_contactno1 = '$contact' OR customers.customer_contactno2 = '$contact') AND leads.lead_owner = '$login_session' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");			  				  			
		}	 else	{            			
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE customers.customer_contactno1 = '$contact' OR customers.customer_contactno2 = '$contact'  ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");				  		  			
		}		  				
		}
        elseif($search_type== "emailsearch"){	          		  
		if($access_level == "sales")	{             		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE (customers.customer_email1 = '$email' OR customers.customer_email2 = '$email') AND leads.lead_owner = '$login_session' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");			  				  			
		}	 else	{            			
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE (customers.customer_email1 = '$email' OR customers.customer_email2 = '$email')  ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");				  		  			
		}		  				
		}		
		elseif($search_type== "wordsearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE leads.lead_owner = '$login_session' AND (leads.interested_in LIKE  '%$word%' OR leads.lead_description LIKE  '%$word%') ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");				   		   			
		} else	{								
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE leads.interested_in LIKE  '%$word%' OR leads.lead_description LIKE  '%$word%' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");			   			
		}						
		}
		elseif($search_type== "customeridsearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE leads.lead_owner = '$login_session' AND customers.customer_id = '$cust_id'  ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");				   		   			
		} else	{								
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.*, DATE_FORMAT(leads.full_date, '%d %m %Y') FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE customers.customer_id = '$cust_id' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");			   			
		}						
		}
		else{			
	    $results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, leads.* FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id WHERE lower(leads.lead_owner) =  '$person_name' ORDER BY UNIX_TIMESTAMP(leads.full_date) DESC LIMIT $startrow, 100");
		}
		$results2 = $db->query("SELECT FOUND_ROWS() AS count");
		while($row = $results->fetch_assoc())
		{
			while($row2 = $results2->fetch_assoc()){				
			$count = $row2['count'];			
}
			$date = new DateTime($row["full_date"]);  
            $action_date = new DateTime($row["last_action_date"]); 	            						
			$customer_type = $row["customer_type"];				
?>

    <tr>
	    <?php if($access_level == "sales_head")	{ ?>
	    <td><?php echo substr($row["lead_owner"], 0, strpos($row["lead_owner"], '@')) ?></td><?php } ?>
		<!--<td><?php //if($customer_type == "Reseller"){ ?><img style="vertical-align: middle;" src="images/R-icon.png" title="Reseller">&nbsp;<?php // } elseif($customer_type == "Direct"){ ?><img style="vertical-align: middle;" src="images/D-icon.png" title="Direct">&nbsp;<?php // } echo $row["company_name"]?></td>--> 
		<td><?php echo $row["customer_companyname"]?></td>
        <td><?php echo $row["customer_name"]?><br><?php echo $row["customer_contactno1"]?></td> 
		<!--<td><?php //echo $row["required_capacity"]?></td>	-->
		<td><?php echo $row["required_qty"]?></td>
        <td><?php echo $row["budget"]?></td>		
		<td><?php echo $row["order_value"]?></td>
        <td><?php echo $row["interested_in"]?></td>	
		<td><?php echo $row["bottom_price"]?></td>	
		<td><?php echo $row["lead_status"]?></td>		
        <td class="date"><?php echo $date->format('d-M-y H:i') ?></td> 
        <td class="date"><?php echo $action_date->format('d-M-y H:i') ?></td>  		
        <td class="tbl-dropdown"><form action="editlead.php" method="GET">
	    <input type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden="true" name="url">
		<input type="text" value="<?php echo $row["customer_id"]?>" hidden="true" name="custid">
	    <input type="text" value="<?php echo $row["lead_id"]?>" hidden="true" name="leadid">
		<select name="action" onchange="this.form.submit()"><option value=""></option><!--<option value="priority">Set Priority</option>--><option value="send_quote">Send Quote</option><option value="edit">Update Lead</option><option value="convert">Convert Lead</option></select></form></td>    
     		
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
	echo '<a class="red-button-2" href="'.change_url_parameter($url,$parameter,$startrow+100).'">Next 100</a>&ensp;';
	$prev = $startrow - 100;
	if ($prev >= 0)	echo '<a class="red-button-2" href="'.change_url_parameter($url,$parameter,$startrow-100).'">Previous 100</a>';
	}
	?>
    <p class="count-text">Total Records Found: <?php echo $count; ?></p>
</table>
<h3 class="footer">By Shujaat Shaikh</h3>
</div>
</body>
</html>