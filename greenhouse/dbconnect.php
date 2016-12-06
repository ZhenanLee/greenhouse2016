<?php
$MyUsername = "root";  // enter your username for mysql
$MyPassword = "";  // enter your password for mysql
$MyHostname = "localhost";      // this is usually "localhost" unless your database resides on a different server
$Mydb = "test";

$dbh = mysqli_connect($MyHostname , $MyUsername, $MyPassword, $Mydb);
?>