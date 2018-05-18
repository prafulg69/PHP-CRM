<?php
   include('session.php');
   if($access_level =="sales_head"){ 
?>
<header class="navbar">  
<div class="container-fluid">   
 <div class="navbar-collapse collapse">  
 <ul class="nav">      
 <li class="active"><a href="saleshead-dashboard.php">Dashboard</a></li> 
 <li class="active"><a href="search.php">Search</a></li> 
 <div class="dropdown">             
 <button class="dropbtn">Inquiries</button>  
 <div class="dropdown-content">				
 <a href="addnewinquiry.php">Add New Inquiry</a>   
 <a href="test.php?campaign=all">All Inquiries</a> 	
 <a href="test.php?searchtype=datesearch&selecteddate=<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d');?>">Today's Inquiries&ensp;<span class="lead_count" title="<?php getUntouchedInquiry($login_session, $access_level); ?> Untouched Inquiries"><?php getUntouchedInquiry($login_session, $access_level); ?></span></a>
 </div>   
 </div>
 <div class="dropdown">             
 <button class="dropbtn">Customers</button>  
 <div class="dropdown-content">				
 <a href="newcustomer.php">Add New Customer</a> 
 <a href="customerstable.php?person=<?php echo $login_session; ?>">My Customers</a>
 <a href="customerstable.php?person=all">All Customers</a>   
 </div>   
 </div>  
 <div class="dropdown">    
 <button class="dropbtn">Leads</button>  
 <div class="dropdown-content" style="width: 400px;">
<div class="megamenu-col">
 <a href="leadstable.php?person=<?php echo $login_session; ?>" class="level-1">My Leads</a> 
 <ul>
 <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=contacted&search_method=menudrop">Contacted Leads</a></li> 
  <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=contact_in_future&search_method=menudrop">Contact in Future Leads</a></li> 
  <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=no_answer&search_method=menudrop">Not Answered Leads</span></a></li> 
  <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=lost&search_method=menudrop">Lost Leads</a></li> 
  <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=dead_lead&search_method=menudrop">Dead Leads</a></li> 
 </ul>
 </div> 
 <div class="megamenu-col">
 <a href="leadstable.php?person=all" class="level-1">All Leads</a> 
 <ul>
 
  <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=contacted">Contacted Leads</a></li> 
  <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=contact_in_future">Contact in Future Leads</a></li> 
  <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=no_answer">Not Answered Leads</a></li> 
  <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=lost">Lost Leads</a></li> 
  <li><a href="leadstable.php?searchtype=leadstatussearch&lead_status=dead_lead">Dead Leads</a></li> 
 </ul>
 
 </div> 
 
</div> 
 </div>	
 <div class="dropdown">    
 <button class="dropbtn">Orders</button> 
 <div class="dropdown-content">	
 <a href="ordertable.php?searchtype=statussearch&status=open">Open Orders</a> 
 <a href="ordertable.php?searchtype=statussearch&status=completed">Completed Orders</a>
 <a href="ordertable.php?searchtype=statussearch&status=cancel">Cancelled Orders</a>   
 <a href="ordertable.php?person=all">All Orders</a>
 <a href="ordertable.php?person=<?php echo $login_session; ?>">My Orders</a> 
 </div>     				
 </div> 
  <div class="dropdown">    
 <button class="dropbtn">Samples</button> 
 <div class="dropdown-content">	
 <a href="samplestable.php?searchtype=notreceivedsearch">Not Received But My</a> 
 <a href="samplestable.php?searchtype=allnotreceived">Not Received But All</a>
 <a href="samplestable.php?person=<?php echo $login_session; ?>">Samples Sent By Me</a>   
 <a href="samplestable.php?person=all">All Sent Samples</a>
 </div>     				
 </div>
 <div class="dropdown">    
 <button class="dropbtn">Task</button> 
 <div class="dropdown-content">	
 <a href="#">Create Task</a>
 <a href="#">Task Given</a> 
 <a href="#">Task Received</a>
 </div>     				
 </div>
<div class="dropdown">    
 <button class="dropbtn">Performance</button> 
 <div class="dropdown-content">	
 <a href="salesoverview.php?days=7">Sales Overview</a> 
 <a href="leadsoverview.php?days=7">Leads Overview</a>  
 </div>     				
</div>  
 <div class="dropdown fl-right">             
 <button class="dropbtn">Hello, <?php echo $login_name; ?></button>  
 <div class="dropdown-content" style="right:0;">
 <a href="createuser.php">Create New User</a>  
 <a href="priorityleads.php">My Priority Leads</a>  
 <a href="logout.php">Log Out</a>   
 </div>   
 </div>   	
 </ul> 				
 </div>  	
 </div>		
 </header>
   <?php } else if($access_level =="sales"){ ?>
 <header class="navbar">  
<div class="container-fluid">   
 <div class="navbar-collapse collapse">  
 <ul class="nav">      
 <li class="active"><a href="sales-dashboard.php">Dashboard</a></li> 
 <li class="active"><a href="search.php">Search</a></li> 
 <div class="dropdown">             
 <button class="dropbtn">Inquiries</button>  
 <div class="dropdown-content">				
 <a href="test.php?campaign=all">All Inquiries</a> 	
 <a href="test.php?searchtype=assignsearch">Untouched Inquiries&ensp;<span class="lead_count" title="<?php getUntouchedInquiry($login_session, $access_level); ?> Untouched Inquiries"><?php getUntouchedInquiry($login_session, $access_level); ?></span></a>
 </div>  
 </div> 
<div class="dropdown">             
 <button class="dropbtn">Customers</button>  
 <div class="dropdown-content">				
 <a href="newcustomer.php">Add New Customer</a>  
 <a href="customerstable.php?person=<?php echo $login_session; ?>">My Customers</a> 
 </div>   
 </div> 
 <div class="dropdown">    
 <button class="dropbtn">Leads</button>  
 <div class="dropdown-content">	
 <!--<a href="newlead.php?id=1&campaign=create_lead">Add New Lead</a> -->
 <a href="leadstable.php?searchtype=leadstatussearch&lead_status=contacted">Contacted Leads</a>
 <a href="leadstable.php?searchtype=leadstatussearch&lead_status=contact_in_future">Contact in Future Leads</a>
 <a href="leadstable.php?searchtype=leadstatussearch&lead_status=no_answer">Not Answered Leads</a>
 <a href="leadstable.php?searchtype=leadstatussearch&lead_status=lost">Lost Leads</a>
 <a href="leadstable.php?searchtype=leadstatussearch&lead_status=dead_lead">Dead Leads</a>
  <a href="leadstable.php?person=<?php echo $login_session; ?>">All Leads</a>
 </div>     
 </div>	
 <div class="dropdown">    
 <button class="dropbtn">Orders</button> 
 <div class="dropdown-content">	
 <a href="ordertable.php?searchtype=statussearch&status=open">Open Orders</a> 
 <a href="ordertable.php?searchtype=statussearch&status=completed">Completed Orders</a>
 <a href="ordertable.php?searchtype=statussearch&status=cancel">Cancelled Orders</a>   
 <a href="ordertable.php?person=<?php echo $login_session; ?>">All Orders</a>  
 </div>     				
 </div> 
 <div class="dropdown">    
 <button class="dropbtn">Samples</button> 
 <div class="dropdown-content">	
 <a href="samplestable.php?searchtype=notreceivedsearch">Not Received Samples</a>
 <a href="samplestable.php?person=<?php echo $login_session; ?>">All Sent Samples</a>   
 </div>     				
 </div> 
 <div class="dropdown fl-right">             
 <button class="dropbtn">Hello, <?php echo $login_name; ?></button>  
 <div class="dropdown-content" style="right:0;">
 <a href="priorityleads.php">My Priority Leads</a>   
 <a href="logout.php">Log Out</a>   
 </div>   
 </div>   	
 </ul> 				
 </div>  	
 </div>		
 </header>
   <?php }  else if($access_level =="production"){ ?>
 <header class="navbar">  
<div class="container-fluid">   
 <div class="navbar-collapse collapse">  
 <ul class="nav">      
 <li class="active"><a href="production-dashboard.php">Dashboard</a></li> 
 <li class="active"><a href="search.php">Search Order</a></li>  
 <div class="dropdown">    
 <button class="dropbtn">Orders</button> 
 <div class="dropdown-content">	
 <a href="ordertable.php?searchtype=statussearch&status=open">Open Orders</a> 
 <a href="ordertable.php?searchtype=statussearch&status=completed">Completed Orders</a>
 <a href="ordertable.php?searchtype=statussearch&status=cancel">Cancelled Orders</a>   
 <a href="ordertable.php?person=all">All Orders</a>   
 </div>     				
 </div> 
 <div class="dropdown">    
 <button class="dropbtn">Samples</button> 
 <div class="dropdown-content">	
 <a href="samplestable.php?searchtype=allnotreceived">Not Received Samples</a>
 <a href="samplestable.php?person=all">All Sent Samples</a>   
 </div>     				
 </div> 
<div class="dropdown">    
 <button class="dropbtn">Leads</button>  
 <div class="dropdown-content">	
 <!--<a href="newlead.php?id=1&campaign=create_lead">Add New Lead</a> -->
 <a href="leadstable.php?searchtype=leadstatussearch&lead_status=contacted">Contacted Leads</a>
  <a href="leadstable.php?searchtype=leadstatussearch&lead_status=contact_in_future">Contact in Future Leads</a>
  <a href="leadstable.php?searchtype=leadstatussearch&lead_status=no_answer">Not Answered Leads</a>
  <a href="leadstable.php?searchtype=leadstatussearch&lead_status=lost">Lost Leads</a>
  <a href="leadstable.php?searchtype=leadstatussearch&lead_status=dead_lead">Dead Leads</a>
  <a href="leadstable.php?person=all">All Leads</a> 
 </div>     
 </div>	 
 <div class="dropdown fl-right">             
 <button class="dropbtn">Hello, <?php echo $login_name; ?></button>  
 <div class="dropdown-content" style="right:0;">
 <a href="priorityordertable.php">Priority Orders</a> 
 <a href="logout.php">Log Out</a>   
 </div>   
 </div>   	
 </ul> 				
 </div>  	
 </div>		
 </header>
   <?php }
	
	function getUntouchedInquiry($loggedin_user,$loggedin_access){
	include 'db_config.php';
   	$b = 0;
	date_default_timezone_set('Asia/Kolkata'); 
	$today = date('Y-m-d');
	if($loggedin_access == "sales_head"){
    $result = $db->query("SELECT enq_id, DATE_FORMAT(full_date, '%Y-%m-%d') FROM enquiries WHERE lead_created = '0'  AND DATE(full_date) = '$today' AND trash = '0' "); 
	} elseif($loggedin_access == "sales"){
	$result = $db->query("SELECT enq_id FROM enquiries WHERE lead_created = '0' AND assigned_to = '$loggedin_user' AND trash = '0' "); 	
	}
    while($row = $result->fetch_assoc()) { 
    $b = $b+1;
    }
    echo $b ; }
	
   ?>