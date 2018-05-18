<?php   include('session.php');  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Samples Table</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
</head>
<body>
<?php include('header.php'); ?>
<div class="container">
<h3 class="subtitle-text" style="margin: 0;">Samples&ensp;Sent&ensp;Record</h3>
<table>
    <tr class="header">
	    <td>Sales Person</td>
		<td>Company</td>
        <td>Contact info</td>
        <!--<td>Capacity</td>-->								
		<td>Item(s) sent</td>
		<td>Quantity</td>
		<td>Returnable</td>
		<td>Status</td>
		<td>Order Date</td>
		<td>Days</td>
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
		if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {          
		$startrow = 0;        
		} else {          
		$startrow = (int)$_GET['startrow'];       
		}		
		if($person_name== "all"){	          
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, sample_orders.*, DATE_FORMAT(sample_orders.Order_Date, '%d %m %Y') FROM customers INNER JOIN sample_orders ON customers.customer_id=sample_orders.customer_id ORDER BY UNIX_TIMESTAMP(sample_orders.Order_Date) DESC LIMIT $startrow, 100");
		}
		elseif($search_type== "notreceivedsearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, sample_orders.*, DATE_FORMAT(sample_orders.Order_Date, '%d %m %Y') FROM customers INNER JOIN sample_orders ON customers.customer_id=sample_orders.customer_id WHERE lower(sample_orders.Returnable_Basis)='yes' AND lower(sample_orders.Order_Status)='open' AND lower(sample_orders.Sales_Rep_Email) = lower('$login_session') ORDER BY UNIX_TIMESTAMP(sample_orders.Order_Date) ASC LIMIT $startrow, 100");			   		   		  
		} 
		else	{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, sample_orders.*, DATE_FORMAT(sample_orders.Order_Date, '%d %m %Y') FROM customers INNER JOIN sample_orders ON customers.customer_id=sample_orders.customer_id WHERE lower(sample_orders.Returnable_Basis)='yes' AND lower(sample_orders.Order_Status)='open' ORDER BY UNIX_TIMESTAMP(sample_orders.Order_Date) ASC LIMIT $startrow, 100");		   		  
			}
		}
		elseif($search_type== "allnotreceived"){           		  		   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, sample_orders.*, DATE_FORMAT(sample_orders.Order_Date, '%d %m %Y') FROM customers INNER JOIN sample_orders ON customers.customer_id=sample_orders.customer_id WHERE lower(sample_orders.Returnable_Basis)='yes' AND lower(sample_orders.Order_Status)='open' ORDER BY UNIX_TIMESTAMP(sample_orders.Order_Date) ASC LIMIT $startrow, 100");			   		   		  
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
		elseif($search_type== "customeridsearch"){           		  
		if($access_level == "sales")	{			   		    
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, sample_orders.*, DATE_FORMAT(sample_orders.Order_Date, '%d %m %Y') FROM customers INNER JOIN sample_orders ON customers.customer_id=sample_orders.customer_id WHERE  AND lower(sample_orders.Sales_Rep_Email) = lower('$login_session') AND customers.customer_id = '$cust_id' ORDER BY UNIX_TIMESTAMP(sample_orders.Order_Date) ASC LIMIT $startrow, 100");				   		   			
		} else	{								
		$results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, sample_orders.*, DATE_FORMAT(sample_orders.Order_Date, '%d %m %Y') FROM customers INNER JOIN sample_orders ON customers.customer_id=sample_orders.customer_id WHERE customers.customer_id = '$cust_id' ORDER BY UNIX_TIMESTAMP(sample_orders.Order_Date) ASC LIMIT $startrow, 100");			   			
		}						
		}
		else{			
	    $results = $db->query("SELECT SQL_CALC_FOUND_ROWS customers.*, sample_orders.*, DATE_FORMAT(sample_orders.Order_Date, '%d %m %Y') FROM customers INNER JOIN sample_orders ON customers.customer_id=sample_orders.customer_id WHERE lower(sample_orders.Sales_Rep_Email) =  lower('$person_name') ORDER BY UNIX_TIMESTAMP(sample_orders.Order_Date) DESC LIMIT $startrow, 100");
		}
		
		$results2 = $db->query("SELECT FOUND_ROWS() AS count");
		while($row = $results->fetch_assoc())
		{
			while($row2 = $results2->fetch_assoc()){				
			$count = $row2['count'];			
            }
			$orderdate = new DateTime($row["Order_Date"]); 		
    $del_date = strtotime($orderdate->format('d-m-Y'));
	$today = strtotime(date('d-m-Y'));
	$diff=$today-$del_date;
	$days = 0;
	$days=floor($diff/(60*60*24));
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
            
?>

    <tr>
	    <td><?php echo substr($row["Sales_Rep_Email"], 0, strpos($row["Sales_Rep_Email"], '@')) ?></td>
		<td><?php echo $row["customer_companyname"]?></td>
        <td><?php echo $row["customer_name"]?><br><?php echo $row["customer_contactno1"]?></td> 
		<td><?php echo $row["Product_Name1"]; if($productname2 != ""){ echo "&ensp;<span class='lead_count'>+".$a." more</span>"; }?></td>					
		<td><?php echo $row["Quantity1"]?></td>
        <td><?php echo $row["Returnable_Basis"]?></td>	
		<td><?php echo $row["Order_Status"]?></td>	
		<td class="date"><?php echo $orderdate->format('d-M-y H:i') ?></td>		
        <td <?php if($days > 15 && $row["Returnable_Basis"] == "Yes" && $row["Order_Status"] == "open") { echo "style='color: #F44336;font-weight: 600;'"; }?>><?php echo $days; ?> Days ago</td> 
        <td class="tbl-dropdown"><a href="editsampleorder.php?id=<?php echo $row["Order_ID"]?>&custid=<?php echo $row["customer_id"]?>" title="Edit Order or Change Status">SHOW</a></td>    
     		
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