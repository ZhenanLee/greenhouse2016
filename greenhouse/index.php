<?php include('header.php');?>
<?php include('navbar.php');?>
<?php include('welcome.php');?>

<?php

echo "Today is " . date("l, Y-m-d, h:i:sa");

// Create connection
$mysqli = new mysqli('127.0.0.1', 'root', '');
// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
echo '<br>Database Connection OK</br>';


$mysqli->close();
?> 
