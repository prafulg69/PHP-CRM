<?php
include 'db_config.php';

$q = $_GET["q"];
$results= $db->query("SELECT * FROM `orders` WHERE Company_Name = '$q'");

		while($row = $results->fetch_assoc())
// Array with names
		{
echo $row['Customer_Name']."^".$row['Mobile']."^".$row['Telephone']."^".$row['Customer_Email']."^".$row['Secondary_Email']."^".$row['Shipping_Address']."^".$row['Ship_City']."^".$row['Ship_Zip']."^".$row['Billing_Address']."^".$row['GST_No']."^".$row['Order_Description']."^".$row['Branding_Type']."^".$row['Packaging']."^".$row['Payment_Term']."^".$row['Logo_Name'];
		}
?>