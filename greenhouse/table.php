<html>
<div id="table">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="sorttable.js" type="text/javascript"></script>
</head>
<body>

<div class="container">
  <h2>Database Table</h2>
  <a href="http://gh2016">(Home)</a>
  <p>This table will auto-update any upcomming data:</p>
  <table class="table-bordered sortable">
    <thead>
      <tr>
        <th>first_name</th>
        <th>last_name</th>
		<th>company_name</th>
		<th>address</th>
      </tr>
    </thead>
	
    <tbody> <tr>
     <td><span datafld='first_name'> </span></td>
     <td><span datafld='last_name'></span></td>
     <td><span datafld='company_name'> </span></td>
     <td><span datafld='address'> </span></td>
  </tbody>
  
  <object ID=us-500 classid="clsid:333C7BC4-460F-11D0-BC04-0080C7055A83">
  <param nAme="DataURL" value="us-500.csv">
  <param nAme="UseHeader" value="true">
</object>
  
  </table>
</div>

</div>
</html>