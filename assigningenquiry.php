<?php
if(isset($_POST['submit']))
{

$enq_id= trim(addslashes($_POST['enq_id']));
$assign_to= trim(addslashes($_POST['assign_to']));
$url = trim(addslashes($_POST['url']));
$url2 = "http://crm2308.customshape.in".$url;
$url3 = "http://crm2308.customshape.in/test.php?searchtype=enqidsearch&id=".$enq_id;
$to = trim(addslashes($assign_to));
$headers = "From: CustomShape CRM <noreply@customshape.in>\r\n";
$headers .= "Reply-To: noreply@customshape.in\r\n";
$headers .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers .= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
$subject = "New Inquiry Assigned";
$message = '<p>You have been assigned a new Inquiry, <a href="'.$url3.'">See Inquiry Here</a></p>';

mail($to,$subject,$message,$headers);

include 'db_config.php';
$results = $db->query("UPDATE `enquiries` SET `assigned_to` = '$assign_to' WHERE `enq_id` = '$enq_id'");

if($results)
{
echo "<script>alert('Enquiry Assigned')</script>";
echo "<script>window.open('$url2','_self')</script>";
} 
else{
echo "<script>alert('Error Assigning! Contact IT Team')</script>";
}
}
?>
