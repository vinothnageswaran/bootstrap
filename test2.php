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
  
  <style>
a.fixed {
position: fixed;
right: 0;
top: 100;
width: 260px;
}
</style>
  
  <html>
<body>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mysql";
// Create connection

session_start();

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
			
			
			//$startdate ='2018-11-29';
			$enddate ='2018-09-26';
			
			$timestamp = strtotime($startdate);
			$formattedDate = date('F d, Y', $timestamp);
			
			//$CO= "select count(*) from(select COUNT('apttypecode') from qmy where apttypecode='CO') as CO";
			$FirstPatient= "SELECT max(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy";
			
			$link_address1 = 'csv2sql.php';
			
			echo "<a style='padding-right: 5px ' href='".$link_address1."'>Admin</a>";
			
			
			$Clinicssummarymorning= " select DISTINCT ownerwaitingroomevent , count(OwnerWaitingRoomEvent) as uniqueCcount from qmy where DATE(startdatetime) = '$startdate' and apttypecode <>'CO' 
			and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59' 
			group by OwnerWaitingRoomEvent";
		
			//Morning
			
			$query3= "select DISTINCT a.ownercodeevent,a.OwnerDescEvent, COUNT('OWNERCODEEVENT') AS COUNT,
			( select COUNT(*) from qmy d where d.ownercodeevent =a.ownercodeevent and apttypecode='CO' and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate') as CO,
			(SELECT max(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy b where b.ownercodeevent =a.ownercodeevent and apttypecode <>'CO' and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate'and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59') as LP ,
			(SELECT min(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy c where c.ownercodeevent =a.ownercodeevent and apttypecode <>'CO'and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate' and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59') as FP,
			(SELECT COUNT('apttypecode') from qmy  where apttypecode='CO'and DATE(startdatetime) >='$startdate' AND DATE(startdatetime) <= '$startdate'and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59') as COl,
			
			OwnerWaitingRoomEvent from qmy a where DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate'  and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59' and apttypecode<> 'CO'
			group by OwnerWaitingRoomEvent ,OwnerDescEvent    ";
			
			
			$query4= "select SUM(count)as Total from (select DISTINCT OwnerDescEvent, COUNT('OwnerDescEvent') AS COUNT,OwnerWaitingRoomEvent from qmy where DATE(startdatetime) >= '$startdate'  AND DATE(startdatetime) <= '$startdate' and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59' and apttypecode<>'CO' group by OwnerDescEvent order by OwnerWaitingRoomEvent )a ";
			
			
			
             $raw_results = mysqli_query($conn,"$query3") or die(mysqli_error($conn)); 
			 $raw_results1 = mysqli_query($conn,"$query4") or die(mysqli_error($conn)); 
			 $Clinicssummarymorning_rawresults = mysqli_query($conn,"$Clinicssummarymorning") or die(mysqli_error($conn));
			 
			 
			 echo "<div class='col-xs-4'>
			 
			
			 <table class='table table-hover table-sm table-responsive table-bordered '>
			  
			<tr>
			
			<div class='container'>
			<div class='row'>
				
				
				
			<th>$formattedDate </th>
			<th>Morning Clinics</th>
			
			 
			 
			</tr>";
			 
			 echo "<div class='col-xs-4'>
			 <table class='table table-hover table-sm table-responsive table-bordered table-striped  '>
			 
			 
			  
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
			$Total=0;
			
			while($Clinicssummarymorning_results = mysqli_fetch_assoc($Clinicssummarymorning_rawresults )){
				
			while($results1 = mysqli_fetch_assoc($raw_results1)){
			
			
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
			  $Total = $Total + $Clinicssummarymorning_results['uniqueCcount'];
			  
			   echo "</tr>";
}
			}
			}
			echo"<td></td>" ; 
			echo"<td></td>" ; 
			
			 
			echo"<td>Total Morning Clinics excluding CO<br></td>" ;  	
			echo "<td>$Total</td>";	


        
			   



//Afternoon


			$Clinicssummaryafternoon= " select DISTINCT ownerwaitingroomevent , count(OwnerWaitingRoomEvent) as uniqueCcount from qmy where DATE(startdatetime) = '$startdate' and apttypecode <>'CO' 
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
			 
			
			 <table class='table table-hover table-sm table-responsive table-bordered'>
			
			  
			<tr>
			
			<div class='container'>
			<div class='row'>
				
				
				
			<th>$formattedDate </th>
			<th>Afternoon Clinics</th>
			
			 
			 
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
		
			
			$Total=0;
			
			while($Clinicssummaryafternoon_results = mysqli_fetch_assoc($Clinicssummaryafternoon_rawresults )){
				
			while($results1 = mysqli_fetch_assoc($raw_results1a)){
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
			  
			   $Total = $Total + $Clinicssummaryafternoon_results['uniqueCcount'];
			  
			  
			   echo "</tr>";
}
			}
			}
			
		echo"<td></td>" ; 
			echo"<td></td>" ; 
			
			 
			echo"<td>Total afternoon Clinics excluding CO<br></td>" ;  	
			echo "<td>$Total</td>"

         

?>
</body>
</html>