<?php
if(isset($_POST['submit']))
{

$lead_id= $_POST['lead_id'];
$priority_level = $_POST['priority_level'];
$url = "https://crm3692.promousb.in".$_POST['url'];

include 'db_config.php';
$results = $db->query("UPDATE `leads` SET `priority_level` = '$priority_level' WHERE `lead_id` = '$lead_id'");

if($results)
{
echo "<script>alert('Priority Level Set for this Lead')</script>";
echo "<script>window.open('$url','_self')</script>";
}
else{
echo "<script>alert('Error Setting Priority! Contact IT Team')</script>";	
}
}
?>
