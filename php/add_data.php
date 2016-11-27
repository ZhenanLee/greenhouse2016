<?php
    // Connect to MySQL
    include("dbconnect.php");
    
    $temp = $_GET["temp"];
    $hum = $_GET["hum"];
    $mos = $_GET["mos"];

    // Insert _GET values into appropriate table columns
    $data = "INSERT INTO parameters (tVal, hVal, mVal) 
        VALUES ('" . $temp . "' , 
    		'" . $hum . "' , 
    		'" . $mos . "')"
    		 or die( mysqli_error());     

    // Execute Request to Server
    mysqli_query($connection, $data);
    mysqli_close($connection);

    // Go to the review_data.php (optional)
    //header("Location: review_data.php");
?>