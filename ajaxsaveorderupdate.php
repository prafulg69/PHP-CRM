<?php
$id = trim(addslashes($_POST['id']));
$ousalesrepemail = trim(addslashes($_POST['ousalesrepemail']));
date_default_timezone_set('Asia/Kolkata'); 
$fulldate= date("h:i A d-M-y");
$oumessage = trim(addslashes($_POST['oumessage']));
$url = "http://crm2308.customshape.in/ordertable.php?searchtype=idsearch&id=".$id;
include 'db_config.php';

include('session.php'); 

$results1 = $db->query("SELECT Order_Log FROM orders WHERE Order_ID = '$id'");
while($row1 = $results1->fetch_assoc()){
	$order_log = $row1["Order_Log"];
}
$oumessage = "<p><b>".$login_session."</b><br>".$oumessage."<span>".$fulldate."</span></p>".$order_log;


$results2 = $db->query("UPDATE orders SET Order_Log = '$oumessage' WHERE Order_ID = '$id'");

			if($results2){
			
            $headers2 = "From: CustomShape.in <noreply@customshape.in>\r\n";
			//$headers2 .= "CC: order@iotenterprise.in \r\n";
$headers2 .= "Reply-To: noreply@customshape.in\r\n";
$headers2 .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers2.= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers2 .= "MIME-Version: 1.0\r\n";
$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers2 .= "X-Priority: 3\r\n";
$headers2 .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            $to2 = $ousalesrepemail;
            $subject2 = 'New Update on Order #'.$id;
            $message2 = '<q>'.trim(addslashes($_POST['oumessage'])).'</q><p>. This is the new update on your Order ID'.$id.', <a href="'.$url.'">Show Order</a></p>';
			
            mail($to2,$subject2,$message2,$headers2);
				  
			echo "<b>".$login_session."</b><br>".trim($_POST['oumessage'])."<span>".$fulldate."</span>";
					  
           }
		   else{
			   echo "Error Saving Order Update";
		   }

?>

