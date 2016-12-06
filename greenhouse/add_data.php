<?php
    // Connect to MySQL
    include("dbconnect.php");

    // Prepare the SQL statement
    $SQL = "INSERT INTO temperature (sensor ,celsius) VALUES ('".$_GET["serial"]."', '".$_GET["temperature"]."')";    

    // Execute SQL statement
    mysqli_query($dbh,$SQL);

    // Go to the review_data.php (optional)
    header("Location: review_data.php");
?>