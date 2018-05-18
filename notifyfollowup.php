<?php

include 'db_config.php';
date_default_timezone_set('Asia/Kolkata');
$currentDate = date('Y-m-d H');
echo $currentDate;
$results = $db->query("Select *,DATE_FORMAT(followupon, '%Y-%m-%d %H') from leads where DATE_FORMAT(followupon, '%Y-%m-%d %H') = '$currentDate'");
//$results = $db->query("Select * from leads where lead_id=47");
echo "running query";
while($row = $results->fetch_assoc())

		{
			//$date = new DateTime($row["followupon"]);
			//echo $date->format('Y-m-d H');
			echo $row["lead_id"];
			echo $row["full_name"];
			echo $row["company_name"];
		}

?>