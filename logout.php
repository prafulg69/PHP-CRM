<?php
   session_start();
   include("db_config.php");
   include('session.php');
   
   if(session_destroy()) {
	   date_default_timezone_set('Asia/Kolkata');
			$onlydate= date("d-M-y");
			$onlyhours= date("h:i A");
			 $fulldate= date("Y-m-d H:i:s");
			 $today = date('Y-m-d');
			$results = $db->query("UPDATE Users SET logout_time = '$fulldate' WHERE email = '$login_session'");
			
			$results2 = $db->query("SELECT login_time from Users WHERE email = '$login_session' AND access_level = 'sales'");
			while($row2 = $results2->fetch_assoc())
		{
   $dteStart = new DateTime(); 
   $dteEnd   = new DateTime($row2["login_time"]);
   $dteDiff  = $dteStart->diff($dteEnd); 
   $interval = $dteDiff->format("%H:%I:%S");						
	
        $grandtotal = 0;
		$count = 0;
		$results3 = $db->query("SELECT orders.Grand_Total, DATE_FORMAT(orders.Order_Date, '%Y-%m-%d') FROM customers INNER JOIN orders ON customers.customer_id=orders.customer_id WHERE customers.customer_owner = '$login_session' AND DATE(orders.Order_Date) = '$today' ");
			while($row3 = $results3->fetch_assoc())
		{
			$count   = $count+1;
			$grandtotal = intval($row3["Grand_Total"])+$grandtotal;
		}
		    $to = $login_session ;
			//$to = "shujaat@startup-buzz.com" ;
            $subject = "Today's Login Summary";			
           $headers = "From: CustomShape CRM <noreply@customshape.in>\r\n";
		   $headers .= "CC: rohan.karbelkar@customshape.in \r\n";
		   $headers .= "BCC: shujaat@startup-buzz.com \r\n";
$headers .= "Reply-To: noreply@customshape.in\r\n";
$headers .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers.= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;	
 $message = '<div style="font-size: 14px; display: flex;"><div align="center" style="border:1px solid #ccc;padding:0 10px;text-align:left; background: #f5f5f5;"><p><b>Today\'s Login Summary of '.substr($login_session, 0, strpos($login_session, '@')).'</b></p><p>Date: '.$onlydate.'</p><p>Login Time: '.$dteEnd->format('h:i A').'</p><p>Logout Time: '.$onlyhours.'</p><p>Logged in Hours: '.$interval.'</p><p>No. of Orders: '.$count.'</p><p>Total Sales: Rs. '.$grandtotal.'</p></div></div>';
			mail($to,$subject,$message,$headers);
		   // echo $message;
			
		}
		
            echo "<script>window.open('Login.php','_self')</script>";
  }
?>