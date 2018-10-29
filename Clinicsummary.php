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
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
	
  } );
  </script>
  
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
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
   mysqli_select_db($conn,"mysql") or die(mysql_error());
   
  
            $query1 = "SELECT * FROM QM";
			//$query2 = "SELECT Clinics ,COUNT('CLINICS') AS COUNT FROM QM GROUP BY CLINICS;";
			
			$ReverseStartdate = $_GET["datepicker1"];
			$startdate=date("Y-m-d", strtotime($ReverseStartdate) );
			//$startdate ='2018-10-24';
			$timestamp = strtotime($startdate);
			$formattedDate = date('F d, Y', $timestamp);
			
			
			
			//$CO= "select count(*) from(select COUNT('apttypecode') from qmy where apttypecode='CO') as CO";
			$FirstPatient= "SELECT max(DATE_FORMAT(startdatetime, '%H:%i')) FROM qmy";
			
			$link_address1 = 'csv2sql.php';
			echo "<a class='fixed' href='".$link_address1."'>Admin</a>";
			
			"<td></td>";
			
			
			session_start();
			$_SESSION["date"] = $startdate;
			$_SESSION["favanimal"] = "cat";
			echo "Session variables are set.";
			
			
			
		
		//Morning
		
		$Clinicssummarymorning= " select DISTINCT ownerwaitingroomevent , count(OwnerWaitingRoomEvent) as uniqueCcount from qmy where DATE(startdatetime) = '$startdate' and apttypecode <>'CO' 
		and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59' 
		group by OwnerWaitingRoomEvent";
		
		//Afternoon
		
			$query2afternoon= " select DISTINCT ownerwaitingroomevent , count(OwnerWaitingRoomEvent) as uniqueCcount from qmy where DATE(startdatetime) = '$startdate' and apttypecode <>'CO' 
		 and DATE_FORMAT(startdatetime, '%H:%i')>='12:00' and DATE_FORMAT(startdatetime, '%H:%i') <='23:59'
		group by OwnerWaitingRoomEvent";
		
		
			
		//$query2a= "select count(ownerwaitingroomevent) as realccount from qmy z  where DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate'  and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' 
		//and DATE_FORMAT(startdatetime, '%H:%i') <='11:59' group by OwnerWaitingRoomEvent ,OwnerDescEvent with rollup   ";
			
		
			//Day appointments
			
			$query3= "select count(*) as Clinicscount1 from (select distinct OwnerWaitingRoomEvent from (select DISTINCT a.ownercodeevent,a.OwnerDescEvent, COUNT('OWNERCODEEVENT') AS COUNT,
			( select COUNT(*) from qmy d where d.ownercodeevent =a.ownercodeevent and apttypecode='CO' and DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate') as CO,
			
			(SELECT COUNT('apttypecode') from qmy  where apttypecode='CO'and DATE(startdatetime) >='$startdate' AND DATE(startdatetime) <= '$startdate') as COl,
			
			OwnerWaitingRoomEvent from qmy a where DATE(startdatetime) >= '$startdate' AND DATE(startdatetime) <= '$startdate' 
			group by OwnerWaitingRoomEvent ,OwnerDescEvent with rollup) as Clinicscount)as CC ";
			
			//Sum of all the appointments excluding CO appointments
			
			$query4= "select SUM(count)as Total from (select DISTINCT OwnerDescEvent, COUNT('OwnerDescEvent') AS COUNT,OwnerWaitingRoomEvent from qmy where DATE(startdatetime) >= '$startdate'  
			AND DATE(startdatetime) <= '$startdate' and apttypecode <>'CO' group by OwnerDescEvent order by OwnerWaitingRoomEvent )a ";
			
			//Sum of CO appointments
			
			$query5= "select SUM(count)as TotalCO from (select DISTINCT OwnerDescEvent, COUNT('OwnerDescEvent') AS COUNT,OwnerWaitingRoomEvent from qmy where DATE(startdatetime) >= '$startdate' 
			AND DATE(startdatetime) <= '$startdate' and apttypecode ='CO' group by OwnerDescEvent order by OwnerWaitingRoomEvent )b ";
			
			
			
             $raw_results = mysqli_query($conn,"$query3") or die(mysqli_error($conn)); 
			 $raw_results1 = mysqli_query($conn,"$query4") or die(mysqli_error($conn)); 
			 $raw_results2 = mysqli_query($conn,"$query5") or die(mysqli_error($conn)); 
			 $raw_results3 = mysqli_query($conn,"$Clinicssummarymorning") or die(mysqli_error($conn)); 
			 $raw_results3afternoon = mysqli_query($conn,"$query2afternoon") or die(mysqli_error($conn));
			//$raw_results4 = mysqli_query($conn,"$query2a") or die(mysqli_error($conn));
			 
			
			 
			 
			 echo "<div class='col-xs-3	'>
			 <table class='table table-hover table-sm table-responsive table-bordered '>
			  
			<tr>
			<th>Day</th>
			<th>Total Clinics</th>
			<th>Total appointments</th>
			
			<th>Total CO appointments</th>
			</div>
			</tr>";
			
			
			
			
			while($results2 = mysqli_fetch_assoc($raw_results2)){
			 while($results1 = mysqli_fetch_assoc($raw_results1)){
            while($results = mysqli_fetch_assoc($raw_results)){
			echo "<tr>";
			 
		
			echo "<td>".$formattedDate."</td>";	
				
			echo "<td>".$results['Clinicscount1']."</td>";
			echo "<td>".$results1['Total']." </td>";
			echo "<td>".$results2['TotalCO']." </td>";
					  
			  
			   echo "</tr>";
}
			 }
			}
			
			//Printing Morning Clinics
			
			  echo "<div class='col-xs-6'>
			 <table class='table table-hover table-sm table-responsive table-bordered '>
			  
			<tr>
			<th>Clinics</th>
			<th>Number of appointments</th>
		
			</div>
			</tr>";
			
			$Total= 0;
			while($results3 = mysqli_fetch_assoc($raw_results3)){
			
			
			echo "<tr>";
			 
			 // echo "<td>".$results."</td>";
			 
			 
			 
			//echo "<td>".$formattedDate."</td>";	
			//echo "<td>".$results['ownercodeevent']."</td>";	
					
			echo "<td>".$results3['ownerwaitingroomevent']."</td>";
			echo "<td>".$results3['uniqueCcount' ]."</td>";	
			
			 $Total = $Total + $results3['uniqueCcount'];
			
	
			
			  
			   echo " </tr>";
			
			
			}
	    		 echo"<td>Total Morning Clinics<br></td>" ;  	
				echo "<td>$Total</td>";	
				
				
				
				echo "<div class='col-xs-6'>
			 <table class='table table-hover table-sm table-responsive table-bordered '>
			  
			<tr>
			<th>Clinics</th>
			<th>Number of appointments</th>
		
			</div>
			</tr>";
			
				//Printing Afternoon Clinics
				
			$data = array();
			
			$Totalafternoon= 0;
			while($results3afternoon = mysqli_fetch_assoc($raw_results3afternoon)){
			
			
			echo "<tr>";
			echo "<td>".$results3afternoon ['ownerwaitingroomevent']."</td>";
			echo "<td>".$results3afternoon ['uniqueCcount' ]."</td>";	
			
			 $Totalafternoon = $Totalafternoon + $results3afternoon['uniqueCcount'];
			
	
	
		
			
		
			
			  
			   echo " </tr>";
			
			
			}
				echo"<td>Total Afternoon Clinics<br></td>" ;  	
				echo "<td>$Totalafternoon</td>";	
	    		
			/**
			$sqlquery="select DISTINCT ownerwaitingroomevent , count(OwnerWaitingRoomEvent) as uniqueCcount from qmy where DATE(startdatetime) = '$startdate' and apttypecode <>'CO' 
		and DATE_FORMAT(startdatetime, '%H:%i')>='00:00' and DATE_FORMAT(startdatetime, '%H:%i') <='11:59' 
		group by OwnerWaitingRoomEvent";
				
				$sql = mysqli_query($conn,$sqlquery)or die(mysqli_error($conn));
				$userinfo = array();

				while ($row_user = mysqli_fetch_assoc($sql))
				$userinfo[] = $row_user;
				
				foreach ($userinfo as $user) {
				echo "Id: {$user[ownerwaitingroomevent]}<br />"
				. "Name: {$user[uniqueCcount]}<br />"
				
				}	
				
		**/		
				
				
				
?>
<label for="one">Afternoon clinics summary</label>
</body>
</html>