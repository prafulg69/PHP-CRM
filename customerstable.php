<?php   include('session.php');  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Customers Table</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">

</head>
<body>
<?php include('header.php'); ?>
<div class="container">
<h3 class="subtitle-text" style="margin: 0;">Customers&ensp;Table</h3>
<table>
    <tr class="header">
	<?php if($access_level == "sales_head")	{ ?>	
	    <td>Sales Person</td><?php } ?>
		<td>Company</td>
		<td>Customer Name</td>
        <td>Contact Info</td>
        <td>City</td>						
		<td>No. of Leads</td>
		<td>No. of Orders</td>
		<td>Revenue Generated</td>		
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
		$searchmethod = $_GET['search_method'];
		if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {          
		$startrow = 0;        
		} else {          
		$startrow = (int)$_GET['startrow'];       
		}		
		if($person_name== "all"){	          
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers  ORDER BY no_of_orders DESC LIMIT $startrow, 100");
		}
		elseif($search_type== "customersearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers  WHERE lower(customer_name) LIKE  lower('%$customer%') AND customer_owner = '$login_session' ORDER BY no_of_orders DESC LIMIT $startrow, 100");			   		   		  
		} else	{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers  WHERE lower(customer_name) LIKE  lower('%$customer%')  ORDER BY no_of_orders DESC LIMIT $startrow, 100");		   			
			}
		}
		elseif($search_type== "companysearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers  WHERE lower(customer_companyname) LIKE  lower('%$company%') AND customer_owner = '$login_session' ORDER BY no_of_orders DESC LIMIT $startrow, 100");			   		   			
		} else	{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers WHERE lower(customer_companyname) LIKE  lower('%$company%')  ORDER BY no_of_orders DESC LIMIT $startrow, 100");		   			
			}
		}						
		elseif($search_type== "contactsearch"){	          		  
		if($access_level == "sales")	{             		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers  WHERE (customer_contactno1 = '$contact' OR customers.customer_contactno2 = '$contact') AND customer_owner = '$login_session' ORDER BY no_of_orders DESC LIMIT $startrow, 100");			  				  			
		}	 else	{            			
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers  WHERE customer_contactno1 = '$contact' OR customer_contactno2 = '$contact'  ORDER BY no_of_orders DESC LIMIT $startrow, 100");				  		  			
		}		  				
		}
        elseif($search_type== "emailsearch"){	          		  
		if($access_level == "sales")	{             		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers  WHERE (customer_email1 = '$email' OR customer_email2 = '$email') AND customer_owner = '$login_session' ORDER BY no_of_orders DESC LIMIT $startrow, 100");			  				  			
		}	 else	{            			
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers WHERE (customer_email1 = '$email' OR customer_email2 = '$email')  ORDER BY no_of_orders DESC LIMIT $startrow, 100");				  		  			
		}		  				
		}		
		
		else{			
	    $results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM customers WHERE lower(customer_owner) =  '$person_name' ORDER BY no_of_orders DESC LIMIT $startrow, 100");
		}
		$results2 = $db->query("SELECT FOUND_ROWS() AS count");
		while($row = $results->fetch_assoc())
		{
			while($row2 = $results2->fetch_assoc()){				
			$count = $row2['count'];			
			}          						
			$customer_type = $row["customer_type"];			
?>

    <tr>
	    <?php if($access_level == "sales_head")	{ ?>
	    <td><?php echo substr($row["customer_owner"], 0, strpos($row["customer_owner"], '@')) ?></td><?php } ?>
		<!--<td><?php //if($customer_type == "Reseller"){ ?><img style="vertical-align: middle;" src="images/R-icon.png" title="Reseller">&nbsp;<?php // } elseif($customer_type == "Direct"){ ?><img style="vertical-align: middle;" src="images/D-icon.png" title="Direct">&nbsp;<?php // } echo $row["company_name"]?></td>--> 
		<td><?php echo $row["customer_companyname"]?></td>
        <td class="options"><?php echo $row["customer_name"]?></td> 
		<td><?php echo $row["customer_contactno1"]?><br><?php echo $row["customer_email1"]?></td>	
		<td><?php echo $row["customer_shipcity"]?></td>						
		<td><?php echo $row["no_of_leads"]?></td>
        <td><?php echo $row["no_of_orders"]?></td>		
        <td class="tbl-dropdown">Rs. <?php echo $row["total_revenue"]?></td>  		
        <td><form action="customerinfo.php" method="GET">
	    <input type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden="true" name="url">
		<input type="text" value="<?php echo $row["customer_id"]?>" hidden="true" name="custid">
		<!--<select name="action" onchange="this.form.submit()"><option value=""></option><option value="show_customer">Show</option></select>-->
		<button type="submit">Show</button></form></td>    
     		
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
</div>
</body>
</html>