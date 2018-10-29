<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
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
    <th>Clinics</th>
    <th>Appointments</th> 
    
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

  //  mysql_connect("localhost"
  
   
  
   mysqli_select_db($conn,"mysql") or die(mysql_error());
	
	        $cnt = mysqli_num_rows(mysqli_query($conn,"select count(CLINICS) FROM QM WHERE CLINICS ='CLINIC B'")) or die(mysqli_error($conn));
			
			//$row = mysql_fetch_array($raw_results);

			//$total = $row[0];
			
             
     
             $raw_results = mysqli_query($conn,"SELECT * FROM QM") or die(mysqli_error()); 
            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p><h3><td>".$results['Clinics']." <tab3>".$results['Appointmentdate']."</tab3>   </td> </h3></p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        
       
        
    
    
	

?>
	
</body>
</html>