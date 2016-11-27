<?php 
    // Start MySQL Connection
    include('dbconnect.php'); 
?>

<html>
<head>
    <title>Arduino Temperature Log</title>
    <style type="text/css">
        .table_titles, .table_cells_odd, .table_cells_even {
                padding-right: 20px;
                padding-left: 20px;
                color: #000;
        }
        .table_titles {
            color: #FFF;
            background-color: #666;
        }
        .table_cells_odd {
            background-color: #CCC;
        }
        .table_cells_even {
            background-color: #FAFAFA;
        }
        table {
            border: 2px solid #333;
        }
        body { font-family: "Trebuchet MS", Arial; }
    </style>
</head>

    <body>
        <h1>Arduino Parameter Log</h1>
    <table border="0" cellspacing="0" cellpadding="4">
      <tr>
            <td class="table_titles">ID</td>
            <td class="table_titles">Date</td> 
            <td class="table_titles">Temperature</td>
            <td class="table_titles">Humidity</td>
            <td class="table_titles">Moisture</td>
          </tr>
<?php
    // Retrieve all records and display them
    $query = "SELECT * FROM parameters ";
    $query .= "ORDER BY ";
    $query .= "id ASC";
    
    //resource 
    $result = mysqli_query($connection, $query);
    //test if there is a query error
    //if result is true and successful row update(id)
    /*
    if($result && mysqli_affected_rows($connection) == 1){
        //Success 
        // redirect_to("somepage.php");
        echo "Success!";
    }else{
        //Failure
        // $message = "Subject update failed";
        die("Database query failed! " . mysqli_error($connection));     
    }
    */
    // Used for row color toggle
    $oddrow = true;

    // process every record
    while( $row = mysqli_fetch_array($result) )
    {
        if ($oddrow) 
        { 
            $css_class=' class="table_cells_odd"'; 
        }
        else
        { 
            $css_class=' class="table_cells_even"'; 
        }

        $oddrow = !$oddrow;

        echo '<tr>';
        echo '   <td'.$css_class.'>'.$row["id"].'</td>';
        echo '   <td'.$css_class.'>'.$row["date"].'</td>';
        echo '   <td'.$css_class.'>'.$row["tVal"].'</td>';
        echo '   <td'.$css_class.'>'.$row["hVal"].'</td>';
        echo '   <td'.$css_class.'>'.$row["mVal"].'</td>';
        echo '</tr>';
    }
?>
    </table>
    </body>
</html>