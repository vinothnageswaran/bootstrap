<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
	
  } );
  </script>
</head>
<body>


 
<Form Name ="form1" Method ="GET" ACTION = "Clinicsummary.php">



<style>
.title {
    background-color: tomato;
    color: white;
    padding: 10px;
	tab1 { padding-left: 4em; }
    tab2 { padding-left: 8em; }
    tab3 { padding-left: 20em; }
} 
</style>
<h2 class="title">PCH Outpatients summary report</h2>
<?php

$link_address1 = 'csv2sql.php';
echo str_repeat('&nbsp;', 450); 
echo "<a class='fixed' href='".$link_address1."'>Admin</a>";

?>


<p>Date<input type="text" VALUE ="" name ="datepicker1" id="datepicker" required></p>



<br>
<br>


<br>
<br>
<br>


<br>
<br>

<br>
<br>
<br>

<div style="position: relative;">
  


 <div class="col-xs-3">
 
 <div style="position: relative;">

 <div style="position: absolute; top: 0; right: 10;"> <INPUT  TYPE = "Submit"  VALUE = "Generate Report" /></div>


 </div>
 

 
 </FORM>
 
 
<br>
<br>
<br>
 
 <h2> Instructions</h2>

<br>

1.	Download the Event Export report from Queue manager and Save it. </br>
2.	Hit the button to run the macro on the spreadsheet, which will generate qmtoreport.csv in C:/temp folder</br>
3.	Go to admin console on the reporting tool and hit the upload button.</br>

<br>
<br>
<br>
 
</body>
</html>



