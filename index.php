<?php
   include('session.php');
   
   if($access_level == "sales"){
	  header("location:sales-dashboard.php");
   } elseif($access_level == "sales_head"){
	   header("location:saleshead-dashboard.php");
   }
   elseif($access_level == "production"){
	   header("location:production-dashboard.php");
   }
?>