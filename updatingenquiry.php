<?php
if(isset($_POST['submit']))
{

$customer_name=trim(addslashes($_POST['customer_name']));
$company_name=trim(addslashes($_POST['company_name']));
$emailid=trim(addslashes($_POST['email']));
$phonenumber=trim(addslashes($_POST['contact']));
$enquiry=trim(addslashes($_POST['description']));
$source= trim(addslashes($_POST['enquiry_source']));
$enq_id= trim(addslashes($_POST['enq_id']));
$url1 = trim(addslashes($_POST['url']));
$url2 = "https://crm2308.customshape.in".$url1;

include 'db_config.php';

$results = $db->query("UPDATE `enquiries` SET `full_name` = '$customer_name', `company` = '$company_name', `email` = '$emailid', `mobile` = '$phonenumber', `looking_for` = '$enquiry', `campaign` = '$source' WHERE `enq_id` = '$enq_id'");

if($results)
{
echo "<script>alert('Enquiry Updated')</script>";
echo "<script>window.open('$url2','_self')</script>";
}
else{
echo "<script>alert('Error updating inquiry! Contact IT Team')</script>";	
}

}
?>
