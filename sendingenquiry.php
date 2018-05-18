<?php
if(isset($_POST['submit']))
{
$customer_name=trim(addslashes($_POST['customer_name']));
$company_name=trim(addslashes($_POST['company_name']));
$emailid=trim(addslashes($_POST['email']));
$phonenumber=trim(addslashes($_POST['contact']));
$link=trim(addslashes($_POST['link']));
$location=trim(addslashes($_POST['location']));
$enquiry=trim(addslashes($_POST['description']));
date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i:s");
$source= trim(addslashes($_POST['enquiry_source']));
$assign_to= trim(addslashes($_POST['assign_to']));


$to = $assign_to.', shujaat@startup-buzz.com';
$headers = "From: CustomShape CRM <noreply@customshape.in>\r\n";
$headers .= "Reply-To: noreply@customshape.in\r\n";
$headers .= "Return-Path: CustomShape.in <hello@customshape.in>\r\n"; 
$headers .= "Organization: Brandworks Technologies Pvt. Ltd.\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
$subject = $source;
$message = "Name: ".$customer_name."\n\nContact no.: ".$phonenumber."\n\nEmail ID: ".$emailid."\n\nCompany Name: ".$company_name."\n\nLocation: ".$location."\n\nRequirement: ".$enquiry."\n\nProduct Link: ".$link;

mail($to,$subject,$message,$headers);

include 'db_config.php';
$results = $db->query("INSERT INTO `enquiries` (
`company` ,
`full_name` ,
`mobile` ,
`email` ,
`looking_for` ,
`full_date` ,
`campaign` ,
`assigned_to`,
`trash`
)
VALUES ('$company_name', '$customer_name', '$phonenumber', '$emailid',  '$enquiry', '$fulldate', '$source', '$assign_to', '0' );");

if($results)
{
echo "<script>alert('Enquiry Saved and Sent!')</script>";
echo "<script>window.open('https://crm2308.customshape.in/addnewinquiry.php','_self')</script>";
}
else{
	echo "<script>alert('Error Saving Inquiry !')</script>";
}

}
?>
