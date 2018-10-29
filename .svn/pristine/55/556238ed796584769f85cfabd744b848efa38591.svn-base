<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<style>
.city {
    background-color: tomato;
    color: white;
    padding: 10px;
	tab1 { padding-left: 4em; }
    tab2 { padding-left: 8em; }
    tab3 { padding-left: 20em; }
} 
</style>
<h2 class="city">Outpatients summary report</h2>
  <table style="width:10%">
  <tr>
  </tr>
  </table>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mysql";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
   mysqli_select_db($conn,"pch") or die(mysql_error());
            $query1 = "SELECT * FROM QM";
			$query2 = "SELECT Clinics ,COUNT('CLINICS') AS COUNT FROM QM GROUP BY CLINICS;";
			$startdate ='2018-09-25';
			$enddate ='2018-09-26';
			$query3= "select DISTINCT ownercodeevent,OwnerDescEvent, COUNT('OWNERCODEEVENT') AS COUNT, OwnerWaitingRoomEvent from qmx where DATE(startdatetime) >= ".$startdate." AND DATE(startdatetime) <= '2018-09-26' group by OwnerWaitingRoomEvent ,OwnerDescEvent with rollup   ";
			$query4= "select SUM(count)as Total from (select DISTINCT OwnerDescEvent, COUNT('OwnerDescEvent') AS COUNT,OwnerWaitingRoomEvent from qmx where DATE(startdatetime) >= '2018-09-27' AND DATE(startdatetime) <= '2018-09-27' group by OwnerDescEvent order by OwnerWaitingRoomEvent )a ";
             $raw_results = mysqli_query($conn,"$query3") or die(mysqli_error($conn)); 
			 $raw_results1 = mysqli_query($conn,"$query4") or die(mysqli_error($conn)); 
			 echo "<div class='col-md-4'>
			 <table class='table table-hover table-sm table-responsive table-bordered '>
			<tr>
			<th>Clinics</th>
			<th>Clinic Description</th>
			<th>Patients</th>
			<th>Clinics</th>
			</div>
			</tr>";
            while($results = mysqli_fetch_assoc($raw_results)){
			echo "<tr>";
			echo "<td>".$results['OwnerWaitingRoomEvent']."</td>";
			   echo "<td>".$results['ownercodeevent']." </td>";
			   //echo "<td>".$results['Appointmentdate']."</td>";
			   echo "<td>".$results['OwnerDescEvent']." </td>";
			   echo "<td>".$results['COUNT']."</td>";
			   
			  // echo '<a href=pageyouwant.php?COUNT="'.$results['COUNT'].'"</a>';
			  
			  
			   echo "</tr>";
}



          while($results1 = mysqli_fetch_assoc($raw_results1)){
            //$results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
			echo "<tr>";
               //echo "<td>".$results['Clinics']." </td>";
			  // echo "<td>".$results1['Total']." </td>";
			   //echo "<td>".$results['Appointmentdate']."</td>";
			   echo "</tr>";
			   

}
?>
</body>
</html>