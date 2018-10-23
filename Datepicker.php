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
 


<Form Name ="form1" Method ="POST" >



<p>Date: <input type="text" VALUE ="" name ="datepicker1" id="datepicker"></p>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div>

<INPUT style="margin-right: 52px" TYPE = "Submit"  VALUE = "Generate Report" {margin:0 16px;}>

 </div>
 </FORM>
 
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
<h2 class="city">Summary report</h2>
  <table style="width:10%">
  <tr>
  </tr>
  </table>
 
 <?php
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
$servername = "localhost";
$username = "root";
$password = "Password123";
$database = "mysql";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
   mysqli_select_db($conn,"mysql") or die(mysql_error());
            $query1 = "SELECT * FROM QM";
			$query2 = "SELECT Clinics ,COUNT('CLINICS') AS COUNT FROM QM GROUP BY CLINICS;";
			$startdate ='2018-11-29';
			$enddate ='2018-09-26';
			
			//$CO= "select count(*) from(select COUNT('apttypecode') from qmy where apttypecode='CO') as CO";
			$FirstPatient= "SELECT max(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy";
			
			
			
			$query3= "select DISTINCT a.ownercodeevent,a.OwnerDescEvent, COUNT('OWNERCODEEVENT') AS COUNT,
			( select COUNT(*) from qmy d where d.ownercodeevent =a.ownercodeevent and apttypecode='CO' and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate') as CO,
			(SELECT max(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy b where b.ownercodeevent =a.ownercodeevent and apttypecode <>'CO' and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate') as LP ,
			(SELECT min(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy c where c.ownercodeevent =a.ownercodeevent and apttypecode <>'CO'and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate') as FP,
			(SELECT COUNT('apttypecode') from qmy  where apttypecode='CO'and DATE(startdatetime) >='$startdate' AND DATE(startdatetime) <= '$startdate') as COl,
			
			OwnerWaitingRoomEvent from qmy a where DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate' 
			group by ownercodeevent with rollup   ";
			
			
			
			
			$query4= "select SUM(count)as Total from (select DISTINCT OwnerDescEvent, COUNT('OwnerDescEvent') AS COUNT,OwnerWaitingRoomEvent from qmy where DATE(startdatetime) >= '$startdate'  AND DATE(startdatetime) <= '$startdate'  group by OwnerDescEvent order by OwnerWaitingRoomEvent )a ";
			
			
			
             $raw_results = mysqli_query($conn,"$query3") or die(mysqli_error($conn)); 
			 $raw_results1 = mysqli_query($conn,"$query4") or die(mysqli_error($conn)); 
			 
			 
			 
			 echo "<div class='col-md-4'>
			 <table class='table table-hover table-sm table-responsive table-bordered '>
			<tr>
			<th>Clinics</th>
			<th>Clinic Description</th>
			<th>Patients</th>
			<th>Clinics</th>
			
			<th>First Patient</th>
			<th>Last Patient</th>
			<th>Chart only</th>
			
			
			</div>
			</tr>";
            while($results = mysqli_fetch_assoc($raw_results)){
			echo "<tr>";
			echo "<td>".$results['OwnerWaitingRoomEvent']."</td>";
			   echo "<td>".$results['ownercodeevent']." </td>";
			   //echo "<td>".$results['Appointmentdate']."</td>";
			   echo "<td>".$results['OwnerDescEvent']." </td>";
			   echo "<td>".$results['COUNT']."</td>";
			  echo "<td>".$results['FP']."</td>";
			  echo "<td>".$results['LP']."</td>";
			 echo "<td>".$results['CO']."</td>";
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

 }
?>
</body>
</html>