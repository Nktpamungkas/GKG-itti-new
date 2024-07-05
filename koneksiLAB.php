<?php
$host="10.0.6.145\SQLEXPRESS";
//$host="DIT\MSSQLSERVER08";
$username="sa";
$password="123";
$db_name="TICKET";
//--
set_time_limit(600);
$connInfo = array( "Database"=>$db_name, "UID"=>$username, "PWD"=>$password);
$conn1     = sqlsrv_connect( $host, $connInfo);
?>