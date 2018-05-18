<?php
   include('session.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Enquiries Table</title>
<meta name="robots" content="NOINDEX,NOFOLLOW" />
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
</head>
<body>
<?php include('header.php'); ?>
<div class="container">
<h3 class="subtitle-text" style="margin: 0;">Inquiries&ensp;Table</h3>
<table>
    <tr class="header">
        <th>Enq ID</th>
        <th>Company</th>
		<th>Name</th>
		<th>Contact</th>
        <th>Enquiry</th>
        <th>Source</th>
		<th>Date</th>
		<?php if($access_level == "sales_head")	{ ?>	
	    <th>Assigned to</th><?php } ?>
		<th>Options</th>
    </tr>
	<?php
	    include 'db_config.php';
		$campaign_name= $_GET['campaign'];
		$search_type= $_GET['searchtype'];
		$selected_date= $_GET['selecteddate'];
		$customer= $_GET['customer'];
		$company= $_GET['company'];		
		$contact= $_GET['contact'];	
        $email= $_GET['email'];			
		$word= $_GET['word'];
		$enq_id= $_GET['id'];
		
		//check if the starting row variable was passed in the URL or not
if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}
//this part goes after the checking of the $_GET var

		if($campaign_name== "all"){	
         if($access_level == "sales")	{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE assigned_to='$login_session' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");
		 }	else{	
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *, DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");
		 }
		}
		elseif($search_type== "datesearch"){
         if($access_level == "sales")	{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE DATE(full_date) =  lower('".$_GET['selecteddate']."') AND assigned_to='$login_session' AND trash = '0'ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");
		 }else{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE DATE(full_date) =  lower('".$_GET['selecteddate']."') AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");
		 }
		}
		elseif($search_type== "customersearch"){
         if($access_level == "sales")	{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE lower(full_name) LIKE  lower('%$customer%') AND assigned_to='$login_session' AND trash = '0'ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");
		 }	else{		
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE lower(full_name) LIKE  lower('%$customer%') AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");
		 }
		}
		elseif($search_type== "companysearch"){
         if($access_level == "sales")	{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE lower(company) LIKE  lower('%$company%') AND assigned_to='$login_session' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100"); 
		 } else{			
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE lower(company) LIKE  lower('%$company%') AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");
		 }
		}		
		elseif($search_type== "contactsearch"){
         if($access_level == "sales")	{			
		  $results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE mobile LIKE  '%$contact%' AND assigned_to='$login_session' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");	
		 }else{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE mobile LIKE  '%$contact%' AND trash = '0'  ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");	 
		 }		  
		}
        elseif($search_type== "emailsearch"){
         if($access_level == "sales")	{			
		  $results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE email =  '$email' AND assigned_to='$login_session' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");	
		 }else{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE email =  '$email' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");	 
		 }		  
		}		
		elseif($search_type== "wordsearch"){
          if($access_level == "sales")	{
            $results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE looking_for LIKE  '%$word%' AND assigned_to='$login_session' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");			  
		  }else{			
		    $results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE looking_for LIKE  '%$word%' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");	
		  }		   
		}
		elseif($search_type== "enqidsearch"){
          if($access_level == "sales")	{
            $results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE enq_id = '$enq_id' AND assigned_to='$login_session' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");			  
		  }else{			
		    $results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE enq_id = '$enq_id' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");	
		  }		   
		}
		elseif($search_type== "assignsearch"){
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS *,DATE_FORMAT(full_date, '%d %m %Y') FROM enquiries WHERE assigned_to='$login_session' AND lead_created = '0' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");	
		}
		else{
         if($access_level == "sales")	{
			$results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM enquiries WHERE lower(campaign) =  '$campaign_name' AND assigned_to='$login_session' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100"); 
		 }	else{		
	    $results = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM enquiries WHERE lower(campaign) =  '$campaign_name' AND trash = '0' ORDER BY UNIX_TIMESTAMP(full_date) DESC LIMIT $startrow, 100");
		 }
		}
		 $results2 = $db->query("SELECT FOUND_ROWS() AS count");
		while($row = $results->fetch_assoc())
		{
			while($row2 = $results2->fetch_assoc()){
				$count = $row2['count'];
			}
			$date = new DateTime($row["full_date"]);		
            $lead_created = $row["lead_created"];			
            //$delete_status = $row["delete_status"];			
?>
    <tr>
	 
	    
	    <td><?php echo $row["enq_id"]?></td>
        <td><?php echo $row["company"]?></td>
		<td><?php echo $row["full_name"]?></td>
        <td><?php echo $row["mobile"]?></td>
        <td><?php echo $row["looking_for"]?><br><b>Email: </b><?php echo $row["email"]?></td>
        <td class="tbl-dropdown"><?php echo $row["campaign"]?></td>  
        <td class="date"><?php echo $date->format('d-M-y H:i') ?></td>  
        <?php if($access_level == "sales_head")	{ ?>	
	    <td><?php echo substr($row["assigned_to"], 0, strpos($row["assigned_to"], '@')) ?></td><?php } ?>		
        <td class="tbl-dropdown"><?php if($lead_created == "0"){
		?><form action="addcustomer.php" method="GET">
		<input type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden="true" name="url">
	    <input type="text" value="<?php echo $row["enq_id"]?>" hidden="true" name="id">
		<select name="campaign" id="myselect" onchange="this.form.submit()">
		<option selected="selected" value=""></option>
		<option value="create_lead">Create Lead</option>
		<option value="edit_enquiry">Update</option>
		<option value="trash_enquiry">Trash</option>
		<?php if($access_level == "sales_head"){?> <option value="assign_enquiry">Assign</option> <?php } ?>
		</select></form><?php }
		elseif($lead_created == "1"){
			?>Lead Created by <?php $enqid= $row["enq_id"]; $result = $db->query("SELECT leads.lead_id, customers.customer_owner FROM customers INNER JOIN leads ON customers.customer_id=leads.customer_id  WHERE enq_id =  $enqid");
			while($row = $result->fetch_assoc()){
			echo '<a href="editlead.php?id='.$row["lead_id"].'&action=edit">'.substr($row["customer_owner"], 0, strpos($row["customer_owner"], '@')).'</a>';
		}} ?></td> 
     		
    </tr>
	<?php	
	}
	//now this is the link..
if($count>100){ 
$url=$_SERVER['REQUEST_URI'];
$parameter="startrow";

function change_url_parameter($url,$parameter,$parameterValue)
{
    $url=parse_url($url);
    parse_str($url["query"],$parameters);
    unset($parameters[$parameter]);
    $parameters[$parameter]=$parameterValue;
    return  $url["path"]."?".http_build_query($parameters);
}
echo '<a class="red-button-2" href="'.change_url_parameter($url,$parameter,$startrow+100).'">Next 100</a>&ensp;';
$prev = $startrow - 100;

//only print a "Previous" link if a "Next" was clicked
if ($prev >= 0)
	echo '<a class="red-button-2" href="'.change_url_parameter($url,$parameter,$startrow-100).'">Previous 100</a>';
}
	?>
    <p class="count-text">Total Records Found: <?php echo $count; ?></p>
</table>
</div>
</body>
</html>