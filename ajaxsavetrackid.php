<?php
$id = trim(addslashes($_POST['id']));
$track_no = trim(addslashes($_POST['trackno']));
$customer_email = trim(addslashes($_POST['customeremail']));
$salesrep_email = trim(addslashes($_POST['salesrepemail']));
$shipaddress = trim(addslashes($_POST['shipaddress']));
$customer_name = trim(addslashes($_POST['customername']));
$courier = trim(addslashes($_POST['courier']));
$message = trim(addslashes($_POST['message']));
$companyname = trim(addslashes($_POST['companyname']));
$url= "http://track.aftership.com/".$courier."/".$track_no;
//link for customer to mark order as completed
//$url2 = "https://promousb.in/orders/confirmdelivery.php?id=".$id;
date_default_timezone_set('Asia/Kolkata'); 
$fulldate= date("d-M-Y");

include 'db_config.php';
$results = $db->query("UPDATE orders SET Track_No = '$track_no', Courier = '$courier' WHERE Order_ID = '$id'");

			if($results){
			$headers2 = "From: CustomShape.in <".$salesrep_email.">\r\n";
$headers2 .= "Reply-To: ".$salesrep_email."\r\n";
$headers2 .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers2.= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers2 .= "MIME-Version: 1.0\r\n";
$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers2 .= "X-Priority: 3\r\n";
$headers2 .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            $to2 = $customer_email;
            $subject2 = 'Your Order #'.$id.' has been dispatched!';
            $message2 = '<div style="width:600px;margin:10px auto;padding:15px 10px;border: 1px solid #ccc;border-radius: 3px;background: #f8f8f8;">
<table width="100%">
<tbody>
<tr>
<td align="left" >
<img src="https://www.customshape.in/skin/frontend/smartwave/porto/images/custom-shape-logo.png" alt="CustomShape.in Logo">
<p><b>Date: </b>'.$fulldate.'</p>
</td>
<td align="right" style="line-height: 1.5;" width="250px">
<h2>Dispatched to: </h2>
'.$shipaddress.'
</td>
</tr>
</tbody>
</table>
<table width="100%">
<tbody>
<tr>
<td><br>
<p style="font-size: large; line-height: 1.5;">Hello '.$customer_name.', we thought you\'d like to know that we\'ve dispatched your item(s) through '.$courier.' and your Tracking ID is '.$track_no.'. Your order is on the way.</p>
</td>
</tr>
<tr>
<td align="center"><a href="'.$url.'" style="text-decoration: none; background: #8BC34A; color: #fff; padding: 10px 20px; border-radius: 3px; font-size: 16px; font-weight: 600; margin: 20px; display: inline-block;">Track Shipment</a>
</td>
</tr>
<tr>
<td align="center"><q style="border: 1px solid #d6d65a;background: #ffff74;padding: 10px;border-radius: 5px;">'.$message.'</q></td>
</tr>
<tr>
<td><p style="text-align: center; color: #999; margin-top: 50px;">904, 9th floor, DLH Park, Sundar Nagar, SV Road, Near MTNL Office, Malad west, MUMBAI 400064</p></td>
</tr>
</tbody>
</table>
</div>';
			
            mail($to2,$subject2,$message2,$headers2);
			
			   echo "Track ID Saved and Sent";
           }
		   else{
			   echo "Error Saving Track ID";
		   }

?>

