<?php
   include('db_config.php');
   $inactive = 32400; 
   ini_set('session.gc_maxlifetime', $inactive);
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select * from Users where email = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['email'];
   $login_name = $row['name'];
   $access_level = $row['access_level'];

   if(!isset($_SESSION['login_user'])){
      header("location:Login.php");
   }
?>