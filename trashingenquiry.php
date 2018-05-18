<?php
if(isset($_POST['submit']))
{

$enq_id= trim(addslashes($_POST['enq_id']));
$url = trim(addslashes($_POST['url']));
$url2 = "http://crm2308.customshape.in".$url;

include 'db_config.php';
$results = $db->query("UPDATE `enquiries` SET `trash` = '1' WHERE `enq_id` = '$enq_id'");

if($results)
{
echo "<script>alert('Enquiry Trashed')</script>";
echo "<script>window.open('$url2','_self')</script>";
} 
else{
echo "<script>alert('Error Trashing Enquiry ! Contact IT Support')</script>";
}
}
?>
