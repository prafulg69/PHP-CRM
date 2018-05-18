<?php
//Database credentials
$dbHost = 'localhost';
$dbUsername = 'ishwark5_crm2usr';
$dbPassword = '&U$#F@$&2R';
$dbName = 'ishwark5_customshapecrm';
//Connect with the database

  
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}
?>
