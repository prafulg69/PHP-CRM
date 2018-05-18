<?php
$id = trim(addslashes($_POST['id']));
$sdmessage = trim(addslashes($_POST['sdmessage']));
$sdsalesrepemail = trim(addslashes($_POST['sdsalesrepemail']));
$sdcustomeremail = trim(addslashes($_POST['sdcustomeremail']));
$sdcustomername = trim(addslashes($_POST['sdcustomername']));
$sdperson = trim(addslashes($_POST['sdperson']));
//link for customer to mark order as completed
//$url = "https://promousb.in/orders/confirmdelivery.php?id=".$id;
date_default_timezone_set('Asia/Kolkata'); 
$fulldate= date("d-M-Y");

include 'db_config.php';
$results = $db->query("UPDATE orders SET Track_No = 'Self_Drop', Courier = '$sdperson' WHERE Order_ID = '$id'");

			if($results){
			$headers2 = "From: CustomShape.in <".$sdsalesrepemail." >\r\n";
            $headers2 .= "Reply-To: ".$sdsalesrepemail."\r\n";
$headers2 .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers2.= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers2 .= "MIME-Version: 1.0\r\n";
$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers2 .= "X-Priority: 3\r\n";
$headers2 .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            $to2 = $sdcustomeremail;
            $subject2 = 'Your Order #'.$id.' is to be dropped by '.$sdperson;
            $message2 = '<div style="width:600px;margin:10px auto;padding:15px 10px;border: 1px solid #ccc;border-radius: 3px;background: #f8f8f8;">
<table width="100%">
<tbody>
<tr>
<td align="left" >
<img src="https://www.customshape.in/skin/frontend/smartwave/porto/images/custom-shape-logo.png" alt="CustomShape.in Logo">
</td>
<td align="right" >
<h2>Self Pickup Confirmation</h2>
<p><b>Order #'.$id.'</b><br>
<b>Date: </b>'.$fulldate.'</p>
</td>
</tr>
</tbody>
</table>
<table width="100%">
<tbody>
<tr>
<td>
<p style="font-size: large; line-height: 1.5;">Hello '.$sdcustomername.',</p>
<p style="font-size: medium; line-height: 1.5;">We thought you\'d like to know that your items is to be dropped by '.$sdperson.'. You can confirm the delivery by clicking on the below button and can also leave an optional feedback.</p>
</td>
</tr><br>
<tr>
<td align="center"><q style="border: 1px solid #d6d65a;background: #ffff74;padding: 10px;border-radius: 5px;">'.$sdmessage.'</q></td>
</tr>
<tr>
<td><p style="text-align: center; color: #999; margin-top: 50px;">904, 9th floor, DLH Park, Sundar Nagar, SV Road, Near MTNL Office, Malad west, MUMBAI 400064</p></td>
</tr>
</tbody>
</table>
</div>';
			
            mail($to2,$subject2,$message2,$headers2);
			
			   echo "Self Drop Saved";
           }
		   else{
			   echo "Error Saving Self Drop";
		   }

?>

