<?php
session_start();
if(isset($_SESSION['login'])) {
//echo "Your session is running " . $_SESSION['usernameS'];
}
else {echo "You are not logged in!" ;
header('Location: login.php');
}
?>
<html>
<head><title>Database Query Executer</title>
	<title>DBMS Final Project</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id = "containerOne">
	<h1 align = "center">Insert New Data</h1>
	<p align = "center"><a href="index.html" type = "submit" align = "center" ><b>HOME</b></a></p>	
</div>

<div id="containerDisplayResults" align = "center">
<b> ADD NEW GENE </b>

</div>
<br>
<br>

<div id="containerAddGene" align = "center">
<form id="addgene" action="runAddGeneSQL.php" method="get" align = "center">
Select Species: 
<?php
include 'dropdown.php';
?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Enter Gene Name:*  <input type="text" name="Name" size=15 required/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     Gene Type (ie Protein Coding):  <input Type="text" name="Type" size=15/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    Gene Structure:   <input type="text" name="Structure" size=15/>
		  Chromosome #:  <input type="text" name="Chromo" size=15 required/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Gene Sequence:  <input Type="text" name="Seq" size=15/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
		 
    <input type="submit" value="Add">
	
</form>
</div>
<br>
<br>

<div id="containerDisplayResults" align = "center">
<b> ADD NEW SPECIES </b>
</div>
<br>
<br>



<div id="containerAddSpecies" align = "center">
<form id="addspecies" action="runAddSpeciesSQL.php" method="get">

   Enter Species Name:* <input  type="text" name="Name" size=15 required>&nbsp;&nbsp;
   Available Genome? (Y/N): <input type="text" name="Genome" size=15>&nbsp;&nbsp;
	 If Y, Date Sequenced: (Y-D-M) <input type="text" name="Datea" size=15>&nbsp;&nbsp;
	  Genome Accuracy: <input  type="text" name="Accuracy" size=15>&nbsp;&nbsp;
	   Latin Name: <input type="text" name="Latin" size=15>&nbsp;&nbsp;
		Chromosome: <input type="text" name="Chromosome" size=15>&nbsp;&nbsp;
		
    <input type="submit" value="Add">
</form>
</div>
<br>
<br>
<br>
<br>
<br>
<form id = "logout" action="logout.php" method="post" align = "center">
		<input type="submit" value="Logout" name="submit"/>
</form>

<div id = "containerFooter">
	<h2 align = "center">Zach Kinney and Steven Anderson</h2>
</div>

      
</body></html>
