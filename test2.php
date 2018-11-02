<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
	
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

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
 <html>
<body>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mysql";

echo "\t" ;
echo "\t" ;
echo "\t" ;
echo "\t" ;


session_start();



// Create connection			

$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
   mysqli_select_db($conn,"mysql") or die(mysql_error());
   
  
            $query1 = "SELECT * FROM QM";
			$query2 = "SELECT Clinics ,COUNT('CLINICS') AS COUNT FROM QM GROUP BY CLINICS;";
			
			//$ReverseStartdate = $_GET["datepicker1"];
			//$startdate=date("Y-m-d", strtotime($ReverseStartdate) );
			//$startdate ='2018-11-29';
			$enddate ='2018-09-26';
			
			
			$startdate=$_SESSION["date"];
			
			
			
			
			$timestamp = strtotime($startdate);
			$day = date('l', $timestamp);
			$formattedDate = date('F d, Y', $timestamp);
			
			
			$link_admin = 'csv2sql.php';
			$link_datepicker = 'Datepicker.php';
			$link_Clinicssummary= 'Clinicsummary.php';
			
			 echo "<div class='col-xs-4'>
			 <table class='table table-hover table-sm table-responsive  table-warning'>
			  <tr>
			<div class='container'>
			<div class='row'>
			<th>$formattedDate </th>
			<th>$day</th>
			<th>Morning outpatients Clinics</th>
			</tr>";
			
			
			echo "<br>";
			//links
	
			
			echo "<a href='".$link_datepicker."'>Home</a>";		
			echo str_repeat('&nbsp;', 5); 
		//	echo "<a href='".$link_Clinicssummary."'>Clinics Summary</a>";
		//	echo str_repeat('&nbsp;', 5); 
			echo "<a href='".$link_admin."'>Admin</a>";
			
			
			$Clinicssummarymorning= " select DISTINCT ownerwaitingroomevent , count(OwnerWaitingRoomEvent) as uniqueCcountm from qmy where DATE(startdatetime) = '$startdate' 
			and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59' and apttypecode <>'CO' 
			group by OwnerWaitingRoomEvent";
		
			//Morning
			
			$query3= "select DISTINCT a.ownercodeevent,a.OwnerDescEvent, COUNT('OWNERCODEEVENT') AS COUNT,
			( select COUNT(*) from qmy d where d.ownercodeevent =a.ownercodeevent and apttypecode='CO' and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate') as CO,
			(SELECT max(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy b where b.ownercodeevent =a.ownercodeevent and apttypecode <>'CO' and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate'and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59') as LP ,
			(SELECT min(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy c where c.ownercodeevent =a.ownercodeevent and apttypecode <>'CO'and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate' and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59') as FP,
			(SELECT COUNT('apttypecode') from qmy  where apttypecode='CO'and DATE(startdatetime) >='$startdate' AND DATE(startdatetime) <= '$startdate'and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59') as COl,
			
			OwnerWaitingRoomEvent from qmy a where DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate'  and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59' and apttypecode<> 'CO'
			group by OwnerWaitingRoomEvent ,OwnerDescEvent    ";
			
			//Total for morning clinics
			
			$query4= "select SUM(count)as Total from (select DISTINCT OwnerDescEvent, COUNT('OwnerDescEvent') AS COUNT,OwnerWaitingRoomEvent from qmy where DATE(startdatetime) >= '$startdate'  AND DATE(startdatetime) <= '$startdate' and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59' and apttypecode<>'CO' group by OwnerDescEvent order by OwnerWaitingRoomEvent )a ";
			
			
			
             $raw_results = mysqli_query($conn,"$query3") or die(mysqli_error($conn)); 
			 $raw_results1 = mysqli_query($conn,"$query4") or die(mysqli_error($conn)); 
			 $Clinicssummarymorning_rawresults = mysqli_query($conn,"$Clinicssummarymorning") or die(mysqli_error($conn));
			 
			 
			
			
			
			 //Column headers
			 
			 echo "<div class='col-xs-4'>
			 <table class='table table-hover table-sm table-responsive table-bordered table-striped   '>			  
			<tr>
			<th>Clinics</th>
			<th>Clinic Description</th>
			<th>Clinics</th>
			<th>Patients</th>
			
			<th>First Patient</th>
			<th>Last Patient</th>
			<th>Chart only</th>
			
			</div>
			</tr>";
			$Totalmorning=0;
			
			
			
				
					
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
			  
			 

			}
			
		while($Clinicssummarymorning_results = mysqli_fetch_assoc($Clinicssummarymorning_rawresults )){
				
			 $Totalmorning = $Totalmorning + $Clinicssummarymorning_results['uniqueCcountm'];
			  
			 echo "</tr>";
				
			}
			echo"<td></td>" ; 
			echo"<td></td>" ; 
			 
			echo"<td>Total Morning Clinics excluding CO<br></td>" ;  	
			echo "<td>$Totalmorning</td>";	



//Afternoon


			$Clinicssummaryafternoon= " select DISTINCT ownerwaitingroomevent , count(OwnerWaitingRoomEvent) as uniqueCcountf from qmy where DATE(startdatetime) = '$startdate' and apttypecode <>'CO' 
			and DATE_FORMAT(startdatetime, '%H:%i')>='12:00' and DATE_FORMAT(startdatetime, '%H:%i') <='23:59' 
			group by OwnerWaitingRoomEvent";
			
			

			$querya3= "select DISTINCT a.ownercodeevent,a.OwnerDescEvent, COUNT('OWNERCODEEVENT') AS COUNT,
			( select COUNT(*) from qmy d where d.ownercodeevent =a.ownercodeevent and apttypecode='CO' and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate') as CO,
			(SELECT max(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy b where b.ownercodeevent =a.ownercodeevent and apttypecode <>'CO' and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate'and DATE_FORMAT(startdatetime, '%H:%i')>='12:00' and DATE_FORMAT(startdatetime, '%H:%i') <='23:59') as LP ,
			(SELECT min(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy c where c.ownercodeevent =a.ownercodeevent and apttypecode <>'CO'and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate' and DATE_FORMAT(startdatetime, '%H:%i')>='12:00' and DATE_FORMAT(startdatetime, '%H:%i') <='23:59') as FP,
			(SELECT COUNT('apttypecode') from qmy  where apttypecode='CO'and DATE(startdatetime) >='$startdate' AND DATE(startdatetime) <= '$startdate'and DATE_FORMAT(startdatetime, '%H:%i')>='12:00' and DATE_FORMAT(startdatetime, '%H:%i') <='23:59') as COl,
			
			OwnerWaitingRoomEvent from qmy a where DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate'  and DATE_FORMAT(startdatetime, '%H:%i')>='12:00' and DATE_FORMAT(startdatetime, '%H:%i') <='23:59' and  apttypecode<> 'CO'
			group by OwnerWaitingRoomEvent ,OwnerDescEvent  ";
			
			
			
			$querya4= "select SUM(count)as Total from (select DISTINCT OwnerDescEvent, COUNT('OwnerDescEvent') AS COUNT,OwnerWaitingRoomEvent from qmy where DATE(startdatetime) >= '$startdate'  AND DATE(startdatetime) <= '$startdate' and DATE_FORMAT(startdatetime, '%H:%i')>='12:00' and DATE_FORMAT(startdatetime, '%H:%i') <='23:59' and apttypecode<>'CO' group by OwnerDescEvent order by OwnerWaitingRoomEvent )a ";
			
			
			
             $raw_resultsa = mysqli_query($conn,"$querya3") or die(mysqli_error($conn)); 
			 $raw_results1a = mysqli_query($conn,"$querya4") or die(mysqli_error($conn)); 
			 $Clinicssummaryafternoon_rawresults = mysqli_query($conn,"$Clinicssummaryafternoon") or die(mysqli_error($conn));
			 
			 
			 
			  echo "<div class='col-xs-12'>
			 
			
			 <table class='table table-hover table-sm table-responsive  table-warning'>
			
			  
			<tr>
			
			<div class='container'>
			<div class='row'>
				
				
				
			<th>$formattedDate </th>
			<th>$day</th>
			<th>Afternoon outpatients Clinics</th>
			
			 
			 
			</tr>";
			 
			 echo "<div class='col-xs-4'>
			 
				
			 <table class='table table-hover table-sm table-responsive table-bordered table-striped '>
			  
			<tr>
			
			<div class='container'>
			<div class='row'>		
			<th>Clinics</th>
			<th >Clinic Description</th>
			<th>Clinics</th>
			<th>Patients</th>
			
			<th>First Patient</th>
			<th>Last Patient</th>
			<th>Chart only</th>
			</div>
			</tr>";			
		
			
			$Totalafternoon=0;
			

			while($resultsa = mysqli_fetch_assoc($raw_resultsa)){
					
				
			echo "<tr>";
			echo "<td>".$resultsa['OwnerWaitingRoomEvent']."</td>";
			   echo "<td>".$resultsa['ownercodeevent']." </td>";
			   //echo "<td>".$results['Appointmentdate']."</td>";
			   echo "<td>".$resultsa['OwnerDescEvent']." </td>";
			   echo "<td>".$resultsa['COUNT']."</td>";
			  echo "<td>".$resultsa['FP']."</td>";
			  echo "<td>".$resultsa['LP']."</td>";
			 echo "<td>".$resultsa['CO']."</td>";
			  // echo '<a href=pageyouwant.php?COUNT="'.$results['COUNT'].'"</a>';
			  
			  
			  
			  
			   echo "</tr>";

			}
			
			while($Clinicssummaryafternoon_results = mysqli_fetch_assoc($Clinicssummaryafternoon_rawresults )){	
			
			 $Totalafternoon = $Totalafternoon + $Clinicssummaryafternoon_results['uniqueCcountf'];
			 
			
			}
			
		echo"<td></td>" ; 
			echo"<td></td>" ; 
			
			 
			echo"<td>Total afternoon Clinics excluding CO<br></td>" ;  	
			echo "<td>$Totalafternoon</td>"

         

?>
</body>
</html>