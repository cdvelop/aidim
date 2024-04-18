<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Export HTML table to Excel / CSV / PDF / JSON / PNG / WORD / XML / TXT using jQuery</title><meta name="description" content="DataTables is a plug-in for the jQuery JavaScript library.">
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- export plug-in files start-->
       <!-- <script src="libs/jquery-1.11.1.min.js"></script>-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="tableExport.js"></script>
    <script type="text/javascript" src="jquery.base64.js"></script>
    <script type="text/javascript" src="jspdf/libs/sprintf.js"></script>
    <script type="text/javascript" src="jspdf/jspdf.js"></script>
    <script type="text/javascript" src="jspdf/libs/base64.js"></script>
    <script type="text/javascript" src="html2canvas.js"></script>
        <script type="text/javascript">
<!-- export plug-in files end-->
<!-- Toggle Button code start-->
            
        </script>
<!-- Toggle Button code end-->
</head>
<body style="margin:20px auto">
<div class="container">
<div class="row header" style="text-align:center;color:green">
  <h3>Export HTML table to Excel / Word / PDF / JSON / PNG / XML / CSV / TXT / SQL</h3>
        <button data-toggle="exportTable" id="exportButton" class="btn btn-primary">click here to Export Data</button><br/><br/>
       <br/>
</div>
<table id="myTable" class="table table-striped">
        <thead>
          <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Country</th>
            <th>Salary</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>001</td>
            <td>Rahul</td>
            <td>India</td>
            <td>20000</td>
          </tr>
          <tr>
            <td>002</td>
            <td>Charles</td>
            <td>United Kingdom</td>
            <td>28000</td>
          </tr>
          <tr>
            <td>003</td>
            <td>Menshril</td>
            <td>Australia</td>
            <td>70000</td>
          </tr>
		   <tr>
            <td>004</td>
            <td>Ganesh</td>
            <td>India</td>
            <td>18000</td>
          </tr>
          <tr>
            <td>005</td>
            <td>Maithili</td>
            <td>India</td>
            <td>12000</td>
          </tr>
          <tr>
            <td>006</td>
            <td>Pavan</td>
            <td>India</td>
            <td>50000</td>
          </tr>
		   <tr>
            <td>007</td>
            <td>Rakesh</td>
            <td>US</td>
            <td>75000</td>
          </tr>
          <tr>
            <td>008</td>
            <td>Mayur</td>
            <td>India</td>
            <td>100000</td>
          </tr>
          <tr>
            <td>009</td>
            <td>NiRRaNjan</td>
            <td>India</td>
            <td>85000</td>
          </tr>
		    <tr>
            <td>010</td>
            <td>Tanmay</td>
            <td>Austria</td>
            <td>30000</td>
          </tr>
          <tr>
            <td>011</td>
            <td>Sara</td>
            <td>India</td>
            <td>750000</td>
          </tr>
          <tr>
            <td>012</td>
            <td>JonRoot</td>
            <td>India</td>
            <td>65000</td>
          </tr>
        </tbody>
      </table>
	  </div>
</body>
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
</html>